@props(['user'])
<div>
    {{-- profile img --}}
    <div class="relative">
       <img src="{{$user->cover()}}"  class="w-full h-56 rounded-xl "alt="">
       <img src="{{$user->avatar()}}"  class="w-36 h-36 rounded-full absolute transform bottom-0 translate-y-1/2 -translate-x-1/2" style="left:50% " alt="">
    </div>
    
    
    <div class=" flex justify-between my-4  relative">
        <div>
           <div class="text-xl font-bold">  {{$user->name}}</div>
        <div>Joined {{$user->created_at->diffForHumans()}}</div>
        </div>
       
        <div class="flex justify-between items-center">
            @cannot('update',$user)
            <x-follow :user="$user"></x-follow>
            @endcannot

            @can('update',$user)
        <a class="p-2 ml-2 bg-blue-50 rounded-full" href="{{route('profile.edit',$user)}}">Edit Profile</a>
            @endcan
        </div>
    </div>
    {{-- description --}}
    <div class="mt-8">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quo voluptatem officia modi magni consectetur cumque voluptatibus corporis eos ratione dicta. Voluptates modi magnam temporibus ut sapiente cupiditate magni maiores ipsa.
    </div>
</div>