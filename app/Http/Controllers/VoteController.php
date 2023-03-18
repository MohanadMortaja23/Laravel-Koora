<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Vote;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use App\Models\Post;

class VoteController extends Controller
{

    use ApiTrait ;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
            'option_id'=> 'required' ,
        ]);

        $user = auth('sanctum')->user() ;

        $allOptions = Post::whereHas('Options' , function($query) use($request){
                return $query->where('id' , $request->option_id);
            })->with('Options')->first()->options()->pluck('id')->toArray();

        $exists = Vote::where('user_id' , $user->id)->whereIn('option_id' , $allOptions )->exists();
        
     
    
        if($exists)
            return $this->FailedApi('لقد قمت بالتصويت من قبل على هذا المنشور');
        else
        {
            $vote = Vote::create([
                'user_id'=> $user->id ,
                'option_id'=> $request->option_id ,
            ]);
            return $this->SuccessApi(new PostResource($vote->Option->Post));
        }
           

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
