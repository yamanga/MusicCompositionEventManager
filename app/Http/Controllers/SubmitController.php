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
        $eventinfo=Event::find($id);
        return view('submit',compact('eventinfo'));
    }

    public function store(string $id, Request $request){
        $request->validate([
            'link'=>'required|url'
        ]);
        if(Event::find(id)->participants->doesntContain('id',Auth::user()->id)){
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
