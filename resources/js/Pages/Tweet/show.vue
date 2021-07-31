<template>
    <app-layout>
        <div class="flex-1"> 
      <div class="content w-5/6 mx-auto">
      <div class="flex justify-around items-center my-2">
          <div class="font-bold text-2xl" title="subscribe to get notified when this tweet gets a comment">Tweet Subscription </div>
           <subscribe :is_subscribed="tweet.is_subscribed" ></subscribe>
      </div>

          <Tweet :tweet="tweet" :user="tweet.user"></Tweet>
           <div class="bg-grey-lighter flex flex-between py-3 -mx-3 p-2">
                <img class="w-8 h-8 rounded-full" :src="$page.props.user.avatar" alt="">
                <textarea name="body" v-model='body' class="appearance-none resize-y h-10 w-full mx-2 rounded-full border bg-white px-2 pt-2 text-xs"></textarea>
            </div>

            <div class="flex justify-between items-center">
                <div @click="submit" class="text-blue-400 underline cursor-pointer">make a comment</div>
            </div>
           

           <div v-if="tweet.replies.length>0" class="bg-gray-50 p-4 border-2 border-gray-300 rounded-xl mt-6">
               <div class="px-4 text-center text-3xl">Replies</div>
                <div v-for="(reply,index) in replies" :key="index" class="m-4">
                    <Reply :reply="reply" ></Reply>
                </div>

          </div>
         <div v-else>No replies Yet</div>

      </div>
   </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Like from '@/Jetstream/Like'
    import Delete from '@/Jetstream/Delete'
    import Tweet from '@/Jetstream/Tweet'
    import Reply from '@/Jetstream/Reply'
    import subscribe from '@/Jetstream/subscribe'


    export default {
        components: {
            subscribe,
            Reply,
            Tweet,
            Delete,
            AppLayout,
            Like
        },
        props:{
            tweet:Object,
            
        },
        methods:{
             submit(){
            if(!this.sent && this.body){
                    this.sent=true   
                    window.axios.post(this.route('replies.store',this.tweet),{
                    body:this.body
                }).then(response =>{
                        this.body=""
                        window.flash("the reply has been created successfully" ,'green')
                        console.log(response.data,response)
                        this.replies.push(response.data)
                        this.sent=false;
                }).catch((error)=>{
                        this.sent=false;
                      flash(error.response.data.errors.body[0],'red')
                })
               }
            }
        },
        data(){
            return {
                replies:this.tweet.replies,
                body:"",
                errors:"",
                sent:false  ,
            }
        },
        updated(){
            this.replies=this.replies
        }
    }
</script>
