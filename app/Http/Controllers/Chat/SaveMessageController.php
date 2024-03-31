<?php

namespace App\Http\Controllers\Chat;

use Illuminate\Http\Request;
use App\Models\ChatMessage;

class SaveMessageController extends BaseController
{
    public function index(Request $req){
        $req->validate([
            'message' => 'required|max:255',
            'name' => 'required',
        ]);

        ChatMessage::create(['user'=>$req->name, "message"=>$req->message]);

        return response()->json(['success'=>'Успешно!']);
    }
}
