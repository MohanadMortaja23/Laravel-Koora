<?php 

namespace App\Traits ;

use App\Models\Sector;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
trait ApiTrait {


    public function SuccessApi($user = null  , $msg = 'Data Updated Successfully')
    {
        return Response()->Json([
            'status' => true,
            'code' => 200,
            'message' => $msg ,
            'data' => $user ?? null ,
        ], 200);

    }


    public function FailedApi($msg)
    {
        return Response()->Json([
            'status' => false,
            'code' => 422,
            'message' => $msg ,
            'data' => '' ,
        ], 422);

    }


    function FailedValidationResponse($errors): JsonResponse
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'code' => 422,
            'message' => $errors->first(),
            'item' => $errors->jsonSerialize(),
        ], 422));
    }


}