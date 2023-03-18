<?php

namespace App\Http\Controllers\Api;

use App\Events\GlobalEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Models\Conversation;
use App\Models\LocalTeam;
use App\Models\Message;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\Message as MessageEvent ;
use App\Models\GlobalTeam;
use App\Traits\GeneralTrait;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class GlobalTeamController extends Controller
{
    use ApiTrait , GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::guard('sanctum')->user() ;
        $blocked =  $user->Blocked;
        $messages =   Message::whereHas('Conversation' , function($query){
            $query->where('team_id' , Auth::guard('sanctum')->user()->global_id)
            ->where('team_type' , GlobalTeam::class);
        })->whereNotIn('user_id' , Arr::pluck($blocked ?? [] , 'id'))->latest()->paginate(8);

    
        return $this->SuccessApi(MessageResource::collection($messages)->resource);
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
            'message'=> Rule::requiredIf(!$request->image),
            'image'=> Rule::requiredIf(!$request->message) ,
        ]);
        $user = Auth::guard('sanctum')->user();
        $request->merge([
            'user_id' => $user->id,
            'conversation_id'=> Conversation::where('team_id' , Auth::guard('sanctum')->user()->global_id)->where('team_type' , GlobalTeam::class)
            ->first()->id
        ]);

        $input = $request->all();
        if($request->image){
            
            $input['image'] =  $this->imageStore($request , $input , 'image' , 'users/messsages'); 
        }else{
            $input['image'] = null ;
        }


       
        event( new GlobalEvent($user , $request->message ,  $input['image'] ) );

        $messages = Message::create($input);
        return $this->SuccessApi( new MessageResource($messages));
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
