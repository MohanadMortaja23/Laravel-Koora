<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GlobalTeam;
use App\Models\Message;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class GlobalController extends Controller
{
    use GeneralTrait ;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $global = GlobalTeam::latest()->paginate(5);

        return view('admin.global.index', [
            'global' => $global,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $global = new GlobalTeam();

        return view('admin.global.create', compact('global'));
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


        $team =GlobalTeam::create($input);

        $team->Conversation()->create();
        return redirect()->route('glob-teams.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $messages = Message::with('User' , 'Conversation.Global')->where('conversation_id' , $id)->latest()->paginate(15);
        return view('admin.global.show', compact('messages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $global = GlobalTeam::findOrFail($id);
        return view('admin.global.edit', compact('global'));
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
        $global = GlobalTeam::findOrfail($id);

        $input = $request->all();

        if($request->image){
            
            $input['image'] =  $this->imageStore($request , $input , 'image' , 'users/teams'); 
        }else{
            $input['image'] = null ;
        }


        $global->update($input);

        return redirect()->route('glob-teams.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $global = GlobalTeam::findOrfail($id);
        $global->Conversation->Messages()->delete();
        $global->Conversation()->delete();
        $global->delete();

        return redirect()->route('glob-teams.index');
    }

    
    public function MessageDestroy($id)
    {
        $local = Message::findOrfail($id);

        $local->delete();

        return redirect()->back();
    }
}
