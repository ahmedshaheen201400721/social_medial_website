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
        $can=auth()->user()->can('update',$user);
        $tweets=$user->tweets()->get();
        return inertia('profile/index',compact('user','tweets','can'));
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
        // if($img){
            $url=$img->store("/{$where}s");
            return asset("/storage/$url");
        // }
        // return auth()->user()->$where;
    }  
    
    public function updateCover(Request $request,User $user)
    {
        // return $request->hasFile('cover')?"It's a File":"No! It's not a File";
        // return $request->all();
        // return $request->cover;
        $request->validate(['cover'=>['required','image']]);
        $cover=$this->saveImg($request->cover,'cover');
        auth()->user()->update(['cover'=>$cover]);

        return $cover;
    }
}
