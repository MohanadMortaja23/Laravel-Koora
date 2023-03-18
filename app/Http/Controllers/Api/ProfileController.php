<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    use ApiTrait , GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $user = Auth::guard('sanctum')->id();
        return $this->SuccessApi( new UserResource(User::with('Blocked')->where('id' , $user)->first())  ,  'Profile Return Successfully' );
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
            'first_name'=> 'nullable|max:50' ,
            'last_name'=> 'nullable|max:50' ,
            'image' => 'nullable|file|mimes:png,jpg',
            'email'=>'nullable|unique:users,email,' . Auth::guard('sanctum')->id() , 
        ]);

      
       
        $user = User::where('id', Auth::guard('sanctum')->id())->first();
      
        $input = $request->all();
        if($request->image){
            $input['image'] =  $this->imageStore($request , $input , 'image' , 'users/avatars'); 
        }
        $user->name = $request->first_name . ' ' . $request->last_name ;
        if($request->image){
        $user->image = $input['image'] ;
        }
        $user->email = $request->email ;
        $user->save();
        
        return $this->SuccessApi($user);
     
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
    public function update(Request $request)
    {
        
      
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
    
    
     public function updatePassword(Request $request)
    {
        $request->validate([
           'password' => 'required|min:4|max:16|confirmed',
        ]);
        $user = Auth::guard('sanctum')->user() ;
        $user->update([
            'password' => Hash::make($request->password)
        ]);
         return $this->SuccessApi($user , 'تم تغيير كلمة المرور بنجاح');
     
    }
    
     public function DeleteAccount()
    {
        $user = User::where('id', Auth::guard('sanctum')->id())->first();
        $user->delete();
        return $this->SuccessApi(null , 'Account Deleted Successfully');
    }
    
    
}
