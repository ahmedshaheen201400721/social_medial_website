<template>
    <app-layout>
        <div class="flex-1"> 
      <div class="content w-5/6 mx-auto">
           {{tweet.body}} 
           <hr>
           <div v-if="tweet.replies.length>0">
                <div v-for="(reply,index) in tweet.replies" :key="index" class="m-4">
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
            
        },
        data(){
            return {

            }
        }
    }
</script>
