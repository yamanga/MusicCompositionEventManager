<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

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
            'organizer_id'=>Auth::id()
        ]);

        return redirect()->route('mypage');
    }

    public function show(string $id){
        $eventinfo=Event::find($id);

        return view('event',compact('eventinfo'));
    }
}
