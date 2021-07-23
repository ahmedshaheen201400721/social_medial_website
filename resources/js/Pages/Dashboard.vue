<template>
    <app-layout>
        <tweet-form @newTweet="addTweet"></tweet-form>
        <div v-if="tweets.length>0">
            <Tweet v-for="(tweet,index) in displayedTweets" :key="index" :tweet="tweet" :user="tweet.user" ></Tweet>    
        </div>
        <div v-else>      No tweets yet   </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import TweetForm from '@/Jetstream/TweetForm'
    import Tweet from '@/Jetstream/Tweet'
    export default {
        components: {
            AppLayout,
            TweetForm,
            Tweet,
        },
        props:{
            friends:Object,
            tweets:Object,
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
