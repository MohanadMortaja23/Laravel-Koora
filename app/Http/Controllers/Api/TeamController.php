<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\TeamResource;
use App\Models\Conversation;
use App\Models\GlobalTeam;
use App\Models\LocalTeam;
use App\Models\NationalTeam;
use App\Models\User;
use App\Traits\ApiTrait;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    use GeneralTrait, ApiTrait;
    public function Local()
    {
        $teams =  TeamResource::collection(LocalTeam::Active()->paginate(12))->resource;
        return $this->SuccessApi($teams);
    }

    public function Global()
    {
        $teams =  TeamResource::collection(GlobalTeam::Active()->paginate(12))->resource;
        return $this->SuccessApi($teams);
    }

    public function National()
    {
        $teams =  TeamResource::collection(NationalTeam::Active()->paginate(12))->resource;
        return $this->SuccessApi($teams);
    }


    public function Suggest(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|file',
        ]);
        
        $request->merge(['status' => 0]);
        if ($request->type == 'local') {

            $input = $request->except('type');
            if ($request->image) {
                $input['image'] =  $this->imageStore($request, $input, 'image', 'users/avatars');
            }
            $team = LocalTeam::create($input);
            $conversation = Conversation::create([
                'status' => 1,
                'team_id' => $team->id,
                'team_type' => LocalTeam::class,
            ]);
            
        } else if ($request->type == 'global') {

            $input = $request->except('type');
            if ($request->image) {
                $input['image'] =  $this->imageStore($request, $input, 'image', 'users/avatars');
            }
            $team =  GlobalTeam::create($input);

            $conversation = Conversation::create([
                'status' => 1,
                'team_id' => $team->id,
                'team_type' => GlobalTeam::class,
            ]);
        } else {
            $input = $request->except('type');
            if ($request->image) {
                $input['image'] =  $this->imageStore($request, $input, 'image', 'users/avatars');
            }
            $team =  NationalTeam::create($input);

            $conversation = Conversation::create([
                'status' => 1,
                'team_id' => $team->id,
                'team_type' => NationalTeam::class,
            ]);
        }



        return $this->SuccessApi($team);
    }



    public function SelectLocalTeam(Request $request)
    {
        $user = User::find(Auth::guard('sanctum')->id());
        $user->local_id = $request->team_id;
        $user->save();
        return $this->SuccessApi([]);
    }


    public function SelectGlobalTeam(Request $request)
    {
        $user = User::find(Auth::guard('sanctum')->id());
        $user->global_id = $request->team_id;
        $user->save();
        return $this->SuccessApi([]);
    }


    public function SelectNationalTeam(Request $request)
    {
        $user = User::find(Auth::guard('sanctum')->id());
        $user->national_id = $request->team_id;
        $user->save();
        return $this->SuccessApi([]);
    }


    public function SelectedTeams()
    {
        $user = User::with(['Global', 'Local', 'National'])->where('id', Auth::guard('sanctum')->id())->first();

        return $user;
        $teams =  TeamResource::collection(NationalTeam::Active()->paginate(7))->resource;
        return $this->SuccessApi($teams);
    }
}
