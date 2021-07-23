
  <x-layout :friends="$friends">    
   <div class="flex-1"> 
      <div class="content w-5/6 mx-auto">
      
         <x-profileHeader :user="$user"></x-profileHeader>

         @forelse ($tweets as $tweet)
            <x-post  :user="$user" :tweet="$tweet"></x-post>    
         @empty
            No tweets yet 
         @endforelse
            
      </div>
   </div>
  </x-layout>