<template>
    <app-layout>
        <div class="flex-1"> 
      <div class="content w-5/6 mx-auto">
           {{tweet.body}} 
           <hr>
           <div class="bg-grey-lighter flex flex-between py-3 -mx-3 p-2">
                <img class="w-8 h-8 rounded-full" :src="$page.props.user.avatar" alt="">
                <textarea name="body" v-model='body' placeholder="Write a comment..." class="appearance-none w-full mx-2 bg-grey-lighter rounded-full border bg-white h-8 px-2 pt-2 text-xs"></textarea>
            </div>
            <div @click="submit" class="text-blue-400 underline cursor-pointer">make a comment</div>
           <div v-if="tweet.replies.length>0">
                <div v-for="(reply,index) in replies" :key="index" class="m-4">
                    {{reply.body}}
                </div>  
          </div>
         <div v-else>No replies Yet</div>

      </div>
   </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    export default {
        components: {
            AppLayout,
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
                }).then((response) =>{
                        this.body=""
                        console.log(response.data)
                        // this.$emit("newTweet",response.data)
                        this.replies.unshift(response.data)
                        this.sent=false;
                })
            }
        }
        },
        data(){
            return {
                replies:this.tweet.replies,
                body:"",
                sent:false  
            }
        }
    }
</script>
