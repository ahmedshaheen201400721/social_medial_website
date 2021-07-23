<div class="p-6 border-2  border-blue-200 rounded-lg">
<form action="{{route('tweets.store')}}" method="POST" class="">
   @csrf
    <textarea class="rounded-xl w-full border-0 border-b-2"  required  placeholder="what's in your mind" name="body" ></textarea>
    <div class="flex justify-between mt-4 p-4">
       <img src="{{user()->avatar()}}" alt="" class="w-12 mr-6 h-12 rounded-full">

       <input class="bg-blue-500 rounded-full text-white p-3 block" type="submit" value="make a tweet">
    </div>
 </form>
 @if(session('msg'))
       <div class="text-green-300 p-4 ">{{session('msg')}}</div>
 @endif
 @error('body')
       <div class="text-red-300 p-4 ">{{$message}}</div>
 @enderror
 </div>