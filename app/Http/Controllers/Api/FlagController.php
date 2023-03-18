<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Flag;
use App\Models\Message;
use App\Models\User;
use App\Models\UsersBlocked;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class FlagController extends Controller
{
    use ApiTrait;
    public function Report(Request $request)
    {
        $request->validate([
            'desc'=> 'required' ,
            'type'=> 'required|in:comment,message' ,
        ]);
        $user = auth('sanctum')->user();
        $flag = Flag::create([
            'desc'=> $request->desc ,
            'user_id'=> $user->id ,
            'content_type'=> $request->type == 'comment' ? Comment::class : Message::class ,
            'content_id'=> $request->content_id ,
        ]);
        return $this->SuccessApi($flag , 'تم الابلاغ بنجاح ');
    }


    public function BlockUser(Request $request)
    {
        $user = auth('sanctum')->user();
        UsersBlocked::create([
            'user_id'=> $user->id ,
            'user_bloked'=> $request->id ,
        ]);
        return $this->SuccessApi(null , 'تم الحظر بنجاح ');

    }
}
