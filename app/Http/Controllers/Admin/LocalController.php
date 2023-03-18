<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\LocalTeam;
use App\Models\Message;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class LocalController extends Controller
{
    use GeneralTrait ;
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $local = LocalTeam::latest()->paginate(5);

        return view('admin.local.index', compact('local'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $local = new LocalTeam();

        return view('admin.local.create', compact('local'));
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
            'name'=> 'required|string' ,
            'image'=> 'required',
        ] , [
            'name.required'=> 'اسم الفريق مطلوب' ,
            'image.required'=> ' الصورة مطلوبة'
        ]);
        $input = $request->all();
        if($request->image){
            
            $input['image'] =  $this->imageStore($request , $input , 'image' , 'users/teams'); 
        }else{
            $input['image'] = null ;
        }
        $team = LocalTeam::create($input);
        $team->Conversation()->create();
        return redirect()->route('locl-teams.index');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $local = Conversation::with(['Messages.User' => function($q){
        //     $q->orderBy('created_at' , 'DESC');
        // }])->where('team_id' , $id)->where('team_type' , LocalTeam::class)->first();


       $messages = Message::with('User' , 'Conversation.Local')->where('conversation_id' , $id)->latest()->paginate(15);

        return view('admin.local.show', compact('messages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $local = LocalTeam::findOrFail($id);
        return view('admin.local.edit', compact('local'));
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
            'name'=> 'required|string' ,
           
        ] , [
            'name.required'=> 'اسم الفريق مطلوب' ,
          
        ]);
        
        
        $local = LocalTeam::findOrfail($id);

        $input = $request->all();

        if($request->image){
            
            $input['image'] =  $this->imageStore($request , $input , 'image' , 'users/teams'); 
        }else{
            $input['image'] = null ;
        }


        $local->update($input);

        return redirect()->route('locl-teams.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $local = LocalTeam::findOrfail($id);

        $local->delete();

        return redirect()->route('locl-teams.index');
    }


    public function MessageDestroy($id)
    {
        $local = Message::findOrfail($id);

        $local->delete();

        return redirect()->back();
    }
}
