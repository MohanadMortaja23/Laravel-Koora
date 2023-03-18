<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Post;
use App\Models\User;
use App\Notifications\PostNotification;
use App\Traits\FcmTrait;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rules\RequiredIf;

class PostController extends Controller
{
    use GeneralTrait , FcmTrait ;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();

        return view('admin.posts.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();

        return view('admin.posts.create', compact('post'));
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
            'details'=> 'required' ,
            'image'=> new RequiredIf($request->option1 == null) ,
            'option1'=> new RequiredIf($request->image == null) ,
            'option2'=> new RequiredIf($request->option1 != null) ,
        ] , 
        [
            'details.required'=> 'محتوى المنشور مطلوب' ,
            'image.required'=> ' الصورة مطلوبة' ,
            'option1.required'=> 'الخيار الاول مطلوب' ,
            'option2.required'=> 'الخيار الثاني مطلوب' ,
        ] 
    );


        $input = $request->all();
        
        if($request->image){
            
            $input['image'] =  $this->imageStore($request , $input , 'image' , 'users/posts'); 
        }else{
            $input['image'] = null ;
        }

        $post = Post::create([
            'image'=>  $input['image'] ,
            'details'=> $input['details'],
            'owner' => $input['owner'],
            'link' => $input['link'],
        ]);
       
        if($request->type == 2)
        {
            $input['option1'] =  $this->imageStore($request , $input , 'option1' , 'options/posts'); 
            $input['option2'] =  $this->imageStore($request , $input , 'option2' , 'options/posts'); 

            $post->Options()->create([
                'image' => $input['option1'] 
            ]);

            $post->Options()->create([
                'image' => $input['option2'] 
            ]);
        }
        $postnot = new PostNotification($post);
        $users = User::where('status', 1)->get(); 
        Notification::send($users , $postnot);
        foreach($users as $user)
        {
            $this->sendFcmNotifications($user->device_token ,$post);
        }
       
        return redirect()->route('posts.index');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post'));
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
        $request->validate([
            'details'=> 'required' ,
            // 'image'=> new RequiredIf($request->option1 == null) ,
        ]);
        $post = Post::findOrfail($id);
        $input = $request->all();

        if($request->image){
            
            $input['image'] =  $this->imageStore($request , $input , 'image' , 'users/posts'); 
        }else{
            $input['image'] = null ;
        }
     
        $post->update([
            'image'=>  $input['image'] ,
            'details'=> $input['details'],
            'owner' => $input['owner'],
            'link' => $input['link'],
        ]);
       
        if($request->type == 2)
        {
            $input['option1'] =  $this->imageStore($request , $input , 'option1' , 'options/posts'); 
            $input['option2'] =  $this->imageStore($request , $input , 'option2' , 'options/posts'); 

            $post->Options()->update([
                'image' => $input['option1'] 
            ]);

            $post->Options()->update([
                'image' => $input['option2'] 
            ]);
        }
       


        return redirect()->route('posts.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrfail($id);
        if($post->Options){
            $post->Options()->delete() ;
        }
        if($post->Comments){
            $post->Comments()->delete() ;
        }
        $post->delete();
        return redirect()->back();
    }
}

