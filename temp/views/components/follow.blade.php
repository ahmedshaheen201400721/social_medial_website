@props(['user'])

<form  x-data="app()" x-init="console.log(this.follow)">
    <button class="p-2 ml-2 bg-blue-500 shadow text-white rounded-full" 
                    x-text='follow? "unfollow Me":"Follow Me" '
                    @click.prevent="submit">
    </button>
</form>
<script>
    function app(){ 
        return {
            follow:@json(user()->isfollowing($user) ),
            url:@json( route('follow.store',$user) ),
            submit(){
                this.toggle();
                window.axios.post(this.url).then(function (response) {
                    console.log(response.data);
                })
            },
            toggle(){
                this.follow=!this.follow
            },
        };
     }
</script>
