<x-app-layout >
   <div class="container mx-auto">
      <div class='flex mt-8'>
         <div class="w-1/7 "> 
            <x-nav></x-nav>
         </div>

         <div class="flex-1"> 
            <div class="content w-5/6 mx-auto">
            <x-tweet-form></x-tweet-form>
            @forelse ($tweets as $item)
            <x-post :avatar="auth()->user()->avatar()" :name="auth()->user()->name" :body="$item->body"></x-post>    
            @empty
               No tweets yet 
            @endforelse
            
            </div>
         </div>

         <div class="w-1/5"> 
            <x-friend :friends="$friends">

            </x-friend>
         </div>
     </div>
   </div>
</x-app-layout>
