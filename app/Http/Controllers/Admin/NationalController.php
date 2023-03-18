<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\NationalTeam;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class NationalController extends Controller
{
    use GeneralTrait ;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $national = NationalTeam::all();

        return view('admin.national.index', compact('national'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $national = new NationalTeam();

        return view('admin.national.create', compact('national'));
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


       $team = NationalTeam::create($input);
       $team->Conversation()->create();
        return redirect()->route('natio-teams.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
       $messages = Message::with('User' , 'Conversation.National')->where('conversation_id' , $id)->latest()->paginate(15);

       return view('admin.national.show', compact('messages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $national = NationalTeam::findOrFail($id);
        return view('admin.national.edit', compact('national'));
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
        
        $national = NationalTeam::findOrfail($id);
        $input = $request->all();
        if($request->image){
            
            $input['image'] =  $this->imageStore($request , $input , 'image' , 'users/teams'); 
        }else{
            $input['image'] = null ;
        }
        $national->update($input);

        return redirect()->route('natio-teams.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $national = NationalTeam::findOrfail($id);

        $national->delete();

        return redirect()->back();
    }


    
    public function MessageDestroy($id)
    {
        $local = Message::findOrfail($id);

        $local->delete();

        return redirect()->back();
    }
}
