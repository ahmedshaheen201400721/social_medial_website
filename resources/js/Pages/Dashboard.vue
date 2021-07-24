<template>
    <app-layout>
        <tweet-form @newTweet="addTweet" :threads="threads"></tweet-form>

        <div class="border-2 border-gray-200 p-4 m-4">
            <div class="my-4">your threads</div>
            <ul class="flex flex-wrap">
                <Link :href="route('tweets.index',{'thread':thread.name})" v-for="(thread,index) in threads"
                :key="index" class="m-4 p-2 rounded-full bg-gray-50 text-center "> {{thread.name}}
                </Link>
            </ul>
        </div>
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
    import {Link} from "@inertiajs/inertia-vue3"
    export default {
        components: {
            AppLayout,
            TweetForm,
            Tweet,
            Link,
        },
        props:{
            friends:Object,
            tweets:Object,
            threads:Object,
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
                url:window.location.href,
            }
        }
    }
</script>
