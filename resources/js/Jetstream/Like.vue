<template>
    <div class="flex justify-between">
    <form >
        <button class="p-2 ml-2  shadow text-white rounded-full" 
                        @click.prevent="submit(tweet)">
            <svg  v-if="like"  class="h-8 w-8 text-blue-500"  viewBox="0 0 24 24"  fill="blue"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3" /></svg>
            <svg  v-else class="h-8 w-8 text-blue-100"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3" /></svg>
        </button>
    </form>
</div>
</template>

<script>
export default {
    props:{
        tweet:Object,
    },
    data(){
        return {
            like:this.tweet.likes_count>0
        }
    },
    methods:{
         toggle(){
                this.like=!this.like
        },
        submit(tweet){
             window.axios.post("/tweet/"+tweet.id+"/likes/create").then(function (response) {
                    console.log(response.data);
                })
            this.toggle();
        }
    },
}
</script>

