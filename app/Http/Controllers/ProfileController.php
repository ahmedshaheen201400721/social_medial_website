<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function show(User $user)
    {
        $tweets=$user->tweets()->get();
        return inertia('profile/index',compact('tweets',));
    }

    public function edit(User $user)
    {
        $this->authorize('update',$user);
        $friends=auth()->user()->followers()->get();
        return view('profile.edit',compact('friends'));
    }

    public function update(UserRequest $request)
    {
        // dd($request->username);
        $avatar=$this->saveImg($request->avatar,'avatar');
        $cover=$this->saveImg($request->cover,'cover');

        $user = User::where('id',user()->id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'avatar'=>$avatar,
            'cover'=>$cover,
        ]);
            return redirect(route('profile.show',user()));

    }

    public function saveImg($img,$where)
    {
        if($img){
            $url=$img->store("/{$where}s");
            return asset("/storage/$url");
        }
        return user()->$where;
    }   
}
