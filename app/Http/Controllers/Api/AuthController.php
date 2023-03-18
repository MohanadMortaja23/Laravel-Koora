<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiTrait;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
class AuthController extends Controller
{
    use GeneralTrait, ApiTrait;
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Login(Request $request)
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required'],
            'device_name' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            $errors = new MessageBag(['password' => ['Email and/or password invalid.']]);
            return Response()->json([
                'message' => 'Invalid username and password combination'
            ], 401);
        }

        if ($user->email_verified_at == null) {
            $errors = new MessageBag(['password' => ['Email and/or password invalid.']]);
            return Response()->json([
                'message' => 'حسابك غير مفعل ، يرجى تاكيده من خلال البريد الالكتروني الخاص بك'
            ], 401);
        }



        $token = $user->createToken($request->device_name);
        $accessToken = PersonalAccessToken::findToken($token->plainTextToken);
        return Response()->Json([
            'status' => true,
            'code' => 200,
            'message' => 'login successfully',
            'user' => new UserResource($user->setAttribute('token', $token->plainTextToken)),
        ], 200);
    }

    public function socialLogin(Request $request)
    {


        $validate = $request->validate([
            'provider' => ['required', 'string', Rule::in(['facebook', 'google'])],
            'access_token' => 'nullable|string',
            'device_token' => 'nullable|string',
        ]);


        $user = User::where('provider_type', $request->provider)->where('provider_id', $request->id)->first();

        // if there is no record with these data, create a new user
        if (!$user) {
            $user = User::create([
                'name' => $request->name,
                'email' => ($request->email ?? null),
                'device_token' => $request->device_token,
                'provider_id' => $request->id,
                'image' => ($request->image ?? null),
                'provider_type' => $request->provider,
                'status' => 1,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => Hash::make('123456'),
                'local_id' => 1,
            ]);
        }

        $token = $user->createToken('postman');
        $accessToken = PersonalAccessToken::findToken($token->plainTextToken);

        return Response()->Json([
            'status' => true,
            'code' => 200,
            'message' => 'login successfully',
            'user' => new UserResource($user->setAttribute('token', $token->plainTextToken)),
        ], 200);
    }


    public function Register(Request $request)
    {


        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [

            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|max:16|confirmed',
        ], [
            'email.unique' => 'هذا البريد الالكتروني موجود'
        ]);

        if ($validator->fails()) {
            return $this->FailedValidationResponse($validator->errors());
        }


        $request->merge([
            'password' => Hash::make($request->password),
            'local_id' => 1,
        ]);

        // $user = User::create($request->except('password_confirmation'));

        $user = User::create($request->except('password_confirmation'))->sendEmailVerificationNotification();
        return $this->SuccessApi($user, 'User Created Successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Information(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            // 'image' => 'required|file|mimes:png,jpg|size:2048',

        ]);


        $request->merge([
            'name' => $request->first_name . ' ' . $request->last_name,
        ]);
        $user = User::where('id', Auth::guard('sanctum')->id())->first();
        $input = $request->all();
        if ($request->image) {
            $input['image'] =  $this->imageStore($request, $input, 'image', 'users/avatars');
        }
        $user->name = $request->first_name . ' ' . $request->last_name;
        if ($request->image) {
            $user->image = $input['image'];
        }
        $user->save();

        return $this->SuccessApi($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::guard('sanctum')->user();

        //Rovoke (delete) all users tokens
        //$user->tokens()->delete();

        //Revoke current access Token
        $user->currentAccessToken()->delete();

        return 123;
    }


    public function ResetPassword(Request $request)
    {
        $request->validate([
            'email' => 'nullable|exists:users,email'
        ]);
        return $this->SuccessApi(null, 'لقد قمنا بارسال رسالة الى ايميلك تحتوي كود تغيير كلمة المرور');
    }


    public function verify($user_id)
    {

        $user = User::findOrFail($user_id);
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }


        return redirect()->to('https://play.google.com/store/apps/details?id=com.KooraZone.networkUpp');
    }



    public function RefreshDeviceToken(Request $request)
    {
        $request->validate([
            'device_token' => 'required|string',
        ]);

        $user = User::where('id', Auth::guard('sanctum')->id())->first();

        if ($user) {
            $user->update([
                'device_token' => $request->device_token,
            ]);
        } else {
            return $this->FaildResponse('User Not Found', 404);
        }
        return $this->SuccessApi(null, 'Device Token Updated Successfully');
    }


    public function AutoRegister(Request $request)
    {

        $guest = User::latest()->first();

        $user = User::create([
            'name' => $request->name,
            'email' => Str::random(8) . $guest->id + 1 . '@koorazone.com',
            'device_token' => $request->device_token,
            'image' => ($request->image ?? null),
            'status' => 1,
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('123456'),
            'local_id' => 1,
        ]);

        $token = $user->createToken('postman');
        $accessToken = PersonalAccessToken::findToken($token->plainTextToken);

        return Response()->Json([
            'status' => true,
            'code' => 200,
            'message' => 'login successfully',
            'user' => new UserResource($user->setAttribute('token', $token->plainTextToken)),
        ], 200);
    }
}
