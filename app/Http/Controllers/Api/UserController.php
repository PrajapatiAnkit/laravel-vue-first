<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Response;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function saveUser(UserRequest $userRequest)
    {
        if (isset($userRequest->userId)){
            $user = User::findOrFail($userRequest->userId);
        }else{
            $user = new User();
        }
        $user->name = $userRequest->name;
        $user->email = $userRequest->email;
        $user->contact = $userRequest->contact;
        if ($userRequest->password != ""){
            $user->password = bcrypt($userRequest->password);
        }
        $user->save();
        return Response::json(['success' => true,'message' => 'User created']);
    }
    public function getUsers()
    {
        $users = User::latest()->paginate(10);
        return $users;
    }
    public function getUserInfo($userId)
    {
        $user = User::findOrFail($userId);
        return Response::json(['success' => true,'data' => $user]);
    }
    public function deleteUser(Request $request)
    {
        User::where('id',$request->userId)->delete();
        return Response::json(['success' => true,'message' => 'User deleted']);
    }
}
