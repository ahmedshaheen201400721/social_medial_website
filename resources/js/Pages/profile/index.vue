<template>
    <app-layout>
        <div class="flex-1"> 
      <div class="content w-5/6 mx-auto">
      
         <Profile-header :user="user" :can="can" :follow="follow"></Profile-header>

        <div v-if="tweets.length>0">
            <Tweet v-for="(tweet,index) in tweets" :key="index" :user="tweet.user" :tweet="tweet"></Tweet>  
        </div>
       <div v-else>No Tweets Yet</div>
            
      </div>
   </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Tweet from '@/Jetstream/Tweet'
    import ProfileHeader from '@/Jetstream/ProfileHeader'
    export default {
        components: {
            AppLayout,
            ProfileHeader,
            Tweet,
        },
        props:{
            tweets:Object,
            can:Boolean,
            follow:Boolean,
            user:Object,
        },
        methods:{
            
        },
        data(){
            return {

            }
        }
    }
</script>
