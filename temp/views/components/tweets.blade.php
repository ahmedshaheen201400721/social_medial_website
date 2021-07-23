@props(['tweets'])
@verbatim
<div x-data="app()" >

    <template x-for="(tweet,index) in tweets" :key="index">
        <div class="flex mt-8 border-2 border-gray-100 p-4 rounded-lg">
            <a :href="'/profile/'+tweet.user.username" class="w-1/12"> <img :src="tweet.user.avatar" alt="" class="w-12 h-12 rounded-full"> </a> 
            <div class="w-11/12">
                <a :href="'/profile/'+tweet.user.username"> <p class="text-lg font-bold" x-text="tweet.user.name"></p> </a>
                <p class="border-b-2 border-gray-200 p-4 mb-4" x-text="tweet.body"></p>     
                
                <div class=" flex justify-between items-center mt-4">
                    <form >
                        <button class="p-2 ml-2 bg-blue-500 shadow text-white rounded-full" 
                                        x-text='tweet.likes_count>0? "dislike":"like" '
                                        @click.prevent="submit(tweet)">
                        </button>
                    </form>
                </div>
        
            </div>
        </div>

    </template>
</div>
@endverbatim
{{-- <x-like :user="$user" tweet="{{tweet}}"></x-like> --}}
        
            {{-- <p>{{$tweet->created_at->diffForHumans()}}</p> --}}

<script>
    function app() {
        return {
            tweets:@json($tweets),
            submit(tweet){
                window.axios.post("/tweet/"+tweet.id+"/likes/create").then(function (response) {
                    console.log(response.data);
                })
            }
        }
      }
</script>