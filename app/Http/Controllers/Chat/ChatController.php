<?php

namespace App\Http\Controllers\Chat;

use Illuminate\Http\Request;
use App\Models\ChatMessages;

class ChatController extends BaseController
{
    function index(){
        return $this->service->showChat();
    }
    
    public function update(Request $req){
        return $this->service->createName($req);
    }
}
