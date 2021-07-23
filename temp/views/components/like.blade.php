@props(['user','tweet'])
    {{-- <p x-text="count+' likes'"></p> --}}
{{$tweet->id}}
<div class="flex justify-between">

    <form >
        <button class="p-2 ml-2 bg-blue-500 shadow text-white rounded-full" 
                        x-text='like? "dislike":"like" '
                        @click.prevent="submit(tweet)">
        </button>
    </form>

</div>

<script>
    function app(){ 
        return {
            like:@json($tweet->likes_count>0 ),

            url:@json( route('like.store',$tweet) ),

            tweet:@json($tweet->body),
            id:@json($tweet->id),

            number: @json($tweet->likes_count),
            submit(tweet){
                // this.toggleCount();
                // this.id=@json($tweet->id)
                console.log(this.body)
                // this.toggle();
                window.axios.post("/tweet/"+tweet.id+"/likes/create").then(function (response) {
                    console.log(response.data);
                })
            },
            toggle(){
                this.like=!this.like
            },
            // toggleCount(){
            //     this.like ? this.count--:this.count++
            // }
        };
     }
</script>
