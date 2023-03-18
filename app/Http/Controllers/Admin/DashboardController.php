<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\GlobalTeam;
use App\Models\LocalTeam;
use App\Models\Message;
use App\Models\NationalTeam;
use App\Models\Post;
use App\Models\RealReaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::count();
        $locals = LocalTeam::count();
        $globals = GlobalTeam::count();
        $nationals = NationalTeam::count();
        $users = User::count();
        $reals = NationalTeam::count();

        $msgs = Message::count();
        $comments = Comment::count();
        $reals_reactions = RealReaction::count();
        return view('admin.index' , compact('posts' , 'comments','locals' ,'nationals' , 'globals' , 'users' , 'reals' , 'msgs' , 'reals_reactions'));
    }

}
