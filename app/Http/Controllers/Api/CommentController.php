<?php

namespace App\Http\Controllers\Api;

use App\Events\Comment as EventsComment;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Reals;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    use ApiTrait ;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $comments =  CommentResource::collection(Comment::with(['User'])->Active()->paginate(8))->resource;
        return $this->SuccessApi($comments);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'comment' => 'required',
            'post_id' => 'required',
            'type'=> 'required' ,
        ]);
        $user = Auth::guard('sanctum')->user();
        $request->merge([
            'user_id' => $user->id,
            'post_type' => $request->type == 'post' ? Post::class : Reals::class , 
        ]);

        event(new EventsComment($user, $request));
        $comments = Comment::create($request->except('type'));
        
        
        $user->points = $user->points + 1 ;
        $user->save();
        return $this->SuccessApi();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comments =  CommentResource::collection(Comment::with(['User'])->where('post_id' , $id )->paginate(8))->resource;
        return $this->SuccessApi($comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



}
