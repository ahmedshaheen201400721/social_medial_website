<template>
     <app-layout>
        
        <Thread :thread='thread'></Thread>

        <div v-if="tweets.length>0">
            <Tweet v-for="(tweet,index) in displayedTweets" :key="index" :tweet="tweet" :user="tweet.user" ></Tweet>    
        </div>
    </app-layout>
</template>

<script>
  import AppLayout from '@/Layouts/AppLayout'
    import TweetForm from '@/Jetstream/TweetForm'
    import Tweet from '@/Jetstream/Tweet'
    import Thread from '@/Jetstream/Thread'
    import {Link} from "@inertiajs/inertia-vue3"
    export default {
        components: {
            AppLayout,
            Thread,
            TweetForm,
            Tweet,
            Link,
        },
        props:{
            friends:Object,
            tweets:Object,
            thread:Object,
        },
    
        methods:{
            addTweet(Tweet){
                console.log(this.$page.props.friends)
                this.displayedTweets.unshift(Tweet)
            }
        },
        data(){
            return {
                displayedTweets: this.tweets,
            }
        }
    }
</script>

