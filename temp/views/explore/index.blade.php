<x-layout :friends="$friends">    
    <div class="flex-1"> 
       <div class="content w-5/6 mx-auto">
          {{-- <x-tweet-form></x-tweet-form>
          @forelse ($tweets as $item)
          <x-post :user="auth()->user()" :body="$item->body"></x-post>    
          @empty
             No tweets yet 
          @endforelse --}}
          @verbatim
            <div x-data="app()" x-init="window.axios.get('http://twitty.test/notFriends?page=2').then(response=>{users=response.data.data})">
               <template x-for="(user,index) in users" :key="index" >
                <div class="mb-6 border border-gray-100 rounded-xl p-4">
                  <a :href="'/profile/'+user.username" class="flex justify-between">
                     <span x-text='user.name'> </span>
                     <img :src="user.avatar" alt="" class="w-16 h-16">
                  </a>
                </div>
               </template>
            </div>
          @endverbatim
          
          {{-- {{dd( (collect($notFollowers->items(2))))->pluck('name') }} --}}

          {{-- {{ $notFollowers->links( ) }}
          {{ $notFollowers->getPageName( ) }} --}}
       </div>
    </div>   
    <script>
            function app(){
                return {
                  users:[],
                }
            }
    </script>
 </x-layout>