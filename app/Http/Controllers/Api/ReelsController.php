<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\RealResource;
use App\Models\RealReaction;
use App\Models\Reals;
use App\Traits\ApiTrait;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReelsController extends Controller
{
    use ApiTrait , GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts =  RealResource::collection(Reals::withCount('Reactions')->latest()->paginate(5))->resource;
        return $this->SuccessApi($posts);
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
            'video' => 'required|file',
           
        ]);
        $user = Auth::guard('sanctum')->user();
        $request->merge([
            'user_id' => $user->id,
        ]);

        $input = $request->all();
        if($request->video){
            $input['video'] =  $this->imageStore($request , $input , 'video' , 'users/reals'); 
        }
        $comments = Reals::create($input);

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
      
        return $this->SuccessApi(CommentResource::collection(Reals::with(['User'])->where('id' , $id)->first()->comments()->latest()->paginate(15))->resource);
      
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


    public function AddLike(Request $request)
    {
        $request->validate([
            'real_id' => 'required|numeric|exists:reals,id',
        ]);
        $user = Auth::guard('sanctum')->user();

        $request->merge([
            'user_id' => $user->id,
            'reaction_id'=> 1 ,
        ]);

        $has_like = RealReaction::where('user_id' , $user->id)->where('real_id' , $request->real_id)->exists();
        if($has_like)
        {
            $real = RealReaction::where('user_id' , $user->id)->where('real_id' , $request->real_id)->first();
            $real->delete();
            return $this->SuccessApi(new RealResource(Reals::find($request->real_id)) , 'لقد قمت بازالة الاعجاب');
        }else{
            $reaction = RealReaction::create($request->all());
        }

        return $this->SuccessApi(new RealResource(Reals::find($request->real_id)));
    }
}
