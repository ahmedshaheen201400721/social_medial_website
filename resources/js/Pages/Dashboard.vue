<template>
    <app-layout>
        <tweet-form @newTweet="addTweet" ></tweet-form>

        
        <div v-if="tweets.length>0"  class=" mt-6">
            <Tweet v-for="(tweet,index) in tweets" :key="index" :tweet="tweet" :user="tweet.user" ></Tweet>    
        </div>
        <div v-else>      No tweets yet   </div>
    </app-layout>
</template>

<script>

            // listElm.addEventListener('scroll', e => {
            //     // if(listElm.scrollTop + listElm.clientHeight >= listElm.scrollHeight) {
            //     //     this.loadMore();
            //     // }
            //     console.log(listElm.scrollTop , listElm.clientHeight , listElm.scrollHeight)
            // });
    import AppLayout from '@/Layouts/AppLayout'
    import TweetForm from '@/Jetstream/TweetForm'
    import Tweet from '@/Jetstream/Tweet'
    import {Link} from "@inertiajs/inertia-vue3"
    // import axios from 'axios'
    export default {
        components: {
            AppLayout,
            TweetForm,
            Tweet,
            Link,
        },
        props:{
            friends:Object,
        },
        methods:{
            addTweet(Tweet){
                this.tweets.push(Tweet)
            },
            getTweets(){
               let append=window.location.search?window.location.search+"&page="+this.page:"?page="+this.page
                axios("/api/timeline"+append).then(res=>{
                return res.data
                }).then(res=>{
                    this.tweets.push(...res.data)
                    this.page++
                    if(res.data.length>0){this.readyToConsumeTweets=true}
                }).catch(e=>this.readyToConsumeTweets=false)
            }
        },
       
        mounted(){
            this.getTweets()
             window.onscroll = () => {
            let bottomOfWindow = document.documentElement.scrollTop + window.innerHeight > document.documentElement.offsetHeight-400;
           if (bottomOfWindow && this.readyToConsumeTweets) {
                this.readyToConsumeTweets=false
                this.getTweets()
             }
            
            };
        },
        data(){
            return {
                url:window.location.href,
                tweets:[],
                page:1,
                readyToConsumeTweets:false,
            }
        }
    }
</script>
