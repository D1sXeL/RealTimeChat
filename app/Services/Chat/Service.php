<?php

namespace App\Services\Chat;

use Illuminate\Support\Facades\Cookie;
use App\Models\ChatMessage;

Class Service
{
    public function showChat(){
        $name = Cookie::get('name');
        Cookie::queue("name", $name, 10080);

        if($name == "")
            return view('chat.input');

        $data = ChatMessage::get();
        $countNote = ChatMessage::where('user', '=', $name)->get();

        $countNote = $countNote->isNotEmpty() == 1 ? 1 : 0;

        return view('chat.chat', ["dataMessages"=>$data, 'nameUser'=>$name, 'countNote'=>$countNote]);
    }

    public function createName($req){
        $data = ChatMessage::where('user', $req->input('name'))->get();

        if($data){
            Cookie::queue("name", $req->input('name'), 10080);
        
            return redirect()->route('chat');
        }
        else{
            return view('chat.input', ['error'=>"Данный никнейм занят"]);
        }

    }
}