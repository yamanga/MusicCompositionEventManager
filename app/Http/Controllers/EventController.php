<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\EventParticipant;

class EventController extends Controller
{
    public function create(){
        return view('eventcreate');
    }

    public function store(Request $request){
        $request->validate([
            'title'=>'required|max:200|unique:events',
            'detail'=>'required|max:10000',
            'participate'=>'required|date_format:Y-m-d\TH:i|after:now',
            'submit'=>'required|date_format:Y-m-d\TH:i|after:participate',
        ]);

        Event::create([
            'title'=>$request['title'],
            'detail'=>$request['detail'],
            'participate'=>$request['participate'],
            'submit'=>$request['submit'],
            'organizer_id'=>Auth::id(),
            'status'=>'participate'
        ]);

        return redirect()->route('mypage');
    }

    public function show(string $id){
        $eventinfo=Event::findOrFail($id);

        return view('event',compact('eventinfo'));
    }

    public function participate(string $id,Request $request){
        $event=Event::findOrFail($id);
        if($event->status!='participate'){
            return redirect()->route('event.show',$id);
        }
        $event->participants()->sync(Auth::user()->id,false);
        return redirect()->route('event.show',$id);
    }

    public function manage(string $id){
        $eventinfo=Event::findOrFail($id);
        if($eventinfo->organizer_id!=Auth::user()->id){
            return back();
        }
        return view('manage',compact('eventinfo'));
    }

    public function cancel(string $id,Request $request){
        $event=Event::findOrFail($id);
        if($event->organizer_id!=Auth::user()->id){
            return back();
        }
        if($event->status=='cancelled' || $event->status=='finished'){
            return back();
        }
        $event->status='cancelled';
        $event->save();
        return redirect()->route('event.manage',$id);
    }

    public function search(Request $request){
        if(!array_key_exists('keyword',$request->query())){
            return view('searchevent');
        }
        $keyword=$request->input('keyword');
        $query=Event::query();
        if($keyword!=NULL){
            $keywords=$this->getKeywordArray($keyword);
            $this->keywordSearch($query,$keywords);
        }
        foreach(Event::STATUS_LIST as $status){
            if($request->input($status)!=TRUE){
                $query->where('status','!=',$status);
            }
        }
        $events=$query->orderBy('created_at','desc')->paginate(10);
        return view('searchevent',compact('events'));
    }

    private function getKeywordArray(string $keyword){
        $keyword_unify_space=mb_convert_kana($keyword,'s');
        $keyword_array=preg_split('/[\s]+/',$keyword_unify_space);
        return $keyword_array;
    }
    private function keywordSearch($query,array $keywords){
        $query->where(function($q)use($keywords){
            foreach($keywords as $keyword){
                $q->orWhere('title','like','%'.addcslashes($keyword,'%_\\').'%')
                ->orWhere('detail','like','%'.addcslashes($keyword,'%_\\').'%');
            }
        });
    }
}
