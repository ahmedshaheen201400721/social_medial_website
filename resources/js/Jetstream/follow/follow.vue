<template>
  <form >
    <button class="p-2 ml-2 bg-blue-500 shadow text-white rounded-full" 
                    v-text='follow? "unfollow Me":"Follow Me" '
                    @click.prevent="submit"> 
    </button>
</form>
</template>

<script>
export default {
    props:['user','following'],
    data(){
        return {
            url:route('follow.store',this.user),
            follow:this.following
        }
    },
    methods:{
        submit(){
                this.toggle();
                window.axios.post(this.url).then(function (response) {
                    console.log(response.data);
                })
            },
        toggle(){
            this.follow=!this.follow
        },
    }
}
</script>

<style>

</style>


