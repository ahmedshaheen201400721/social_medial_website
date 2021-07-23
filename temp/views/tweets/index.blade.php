<x-layout :friends="$friends">    
   <div class="flex-1"> 
      <div class="content w-5/6 mx-auto">
         <x-tweet-form></x-tweet-form>
         <x-tweets :tweets="$tweets">

         </x-tweets>
         {{-- @forelse ($tweets as $tweet)
         <x-post :user="$tweet->user" :tweet="$tweet"></x-post>    
         @empty
            No tweets yet 
         @endforelse --}}
      
      </div>
   </div>   
</x-layout>