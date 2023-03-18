<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\PostReaction;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class ReactionController extends Controller
{

    use ApiTrait ;

    public function PostReaction(Request $request)
    {
        $request->validate([
            'post_id' => 'required',
            'reaction_id' => 'required',
        ]);

        $user = auth('sanctum')->user();
        $exists = PostReaction::where('user_id', $user->id)
        ->where('reaction_id', $request->reaction_id)
        ->where('post_id', $request->post_id)
        ->exists();
        
        if ($exists){
            $reaction = PostReaction::where('user_id' , $user->id)->where('post_id' , $request->post_id)->first();
            $reaction->delete();
            return $this->SuccessApi(new PostResource(Post::find($request->post_id)) , 'لقد قمت بازالة الاعجاب');
        }
        else {
            PostReaction::create([
                'user_id' => $user->id,
                'reaction_id' => $request->reaction_id,
                'post_id' => $request->post_id ,
            ]);
            return $this->SuccessApi(new PostResource(Post::find($request->post_id)) , 'لقد قمت بالاعجاب بالخبر');
        }
    }

    // public function store(Request $request)
    // {



    // }

    // public function store(Request $request)
    // {



    // }


}
