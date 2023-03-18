<?php

namespace App\Http\Controllers;

use App\Models\GlobalTeam;
use App\Models\LocalTeam;
use App\Models\NationalTeam;
use Illuminate\Http\Request;

class PendingTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $global = GlobalTeam::where('status' , 0)->get();
        $local = LocalTeam::where('status' , 0)->get();

        $LG =  $local->concat($global);
        $nation = NationalTeam::where('status' , 0)->get();

        $all =  $LG->concat($nation);
       
        return view('admin.suggestteams.index', [
            'all' => $all,
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
        GlobalTeam::create($request->all());

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
        $global = GlobalTeam::findOrfail($id);

        $input = $request->all();

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

        $global->delete();

        return redirect()->route('glob-teams.index');
    }

   

    public function status(Request $request)
    {
        $id = $request->get('id');
        if($request->get('type') == 'GlobalTeam')
        {
            $info = GlobalTeam::find($id);

        }
        else if($request->get('type') == 'LocalTeam')
        {
            $info = LocalTeam::find($id);
        }
        else
        {
            $info = NationalTeam::find($id);
        }
        return updateModelStatus($info);
    }



    public function refuse(Request $request)
    {
        $id = $request->get('id');
        if($request->get('type') == 'GlobalTeam')
        {
            $info = GlobalTeam::find($id);
        }
        else if($request->get('type') == 'LocalTeam')
        {
            $info = LocalTeam::find($id);
        }
        else
        {
            $info = NationalTeam::find($id);
        }
        $info->delete();
        
        return redirect()->back();
    }
}
