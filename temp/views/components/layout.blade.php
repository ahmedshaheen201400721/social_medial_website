@props(['friends'])
<x-app-layout >
    <div class="container mx-auto">
       <div class='flex mt-8'>
          <div class="w-1/7 "> 
             <x-nav></x-nav>
          </div>
 
         {{$slot}}
          <div class="w-1/5"> 
             <x-friend :friends="$friends">
 
             </x-friend>
          </div>
      </div>
    </div>
 </x-app-layout>
 