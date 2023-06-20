<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Submit;
use Illuminate\Support\Facades\Auth;

class SubmitController extends Controller
{
    //
    public function create(string $id){
        $event=Event::findOrFail($id);
        if($event->status!='submit' && $event->status!='participate'){
            return back();
        }
        if($event->participants->doesntContain('id',Auth::user()->id)){
            return back();
        }
        if($event->submits->contains('id',Auth::user()->id)){
            return back();
        }
        return view('submit',compact('eventinfo'));
    }

    public function store(string $id, Request $request){
        $event=Event::findOrFail($id);
        if($event->status!='submit' && $event->status!='participate'){
            return back();
        }
        $request->validate([
            'link'=>'required|url'
        ]);
        if($event->participants->doesntContain('id',Auth::user()->id)){
            return back();
        }
        Submit::create([
            'link'=>$request['link'],
            'event_id'=>$id,
            'participant_id'=>Auth::user()->id
        ]);

        return redirect()->route('event.show',$id);
    }
}
