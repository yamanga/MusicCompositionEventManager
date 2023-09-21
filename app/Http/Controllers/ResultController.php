<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\Result;

class ResultController extends Controller
{
    public function store(string $id, Request $request){
        $event=Event::findOrFail($id);
        if($event->organizer_id!=Auth::user()->id){
            return back();
        }
        switch($request['result_type']){
            case 'link':
                $request->validate([
                    'link'=>'required|url'
                ]);
                Result::create([
                    'link'=>$request['link'],
                    'event_id'=>$event->id
                ]);
            case 'table':
                $event->result_type=$request['result_type'];
                $event->status='finished';
                $event->save();
                return redirect()->route('event.manage',$id);
            default:
                return back()->withInput();
        }
    }
}
