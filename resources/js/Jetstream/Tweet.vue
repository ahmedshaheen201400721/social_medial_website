<template>
  
    <div v-if="!deleted"  class="max-w-2xl mb-4 hover:shadow-xl px-8 py-4 border-2 border-gray-200 mx-auto bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <img class="object-cover w-10 h-10 mr-4 rounded-full" :src="user.avatar" alt="avatar">
                <Link :href="user.path" class="font-bold text-gray-700 cursor-pointer dark:text-gray-200 hover:underline">{{tweet.user.name}}</Link>
            </div>

            <div class="flex">
                <span class=" mr-2 text-sm font-light text-gray-600 dark:text-gray-400">{{tweet.created_at}}</span>
                <div v-if="tweet.can" class="relative">
                    <jet-dropdown align="right" width="48">
                        <template #trigger>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                            </svg>
                        </template>
                        <template #content>
                            <Delete :url="route('tweets.delete',[tweet])" v-if="tweet.can"   @delete="hide"></Delete>
                            <div  @click="showForm" class="block cursor-pointer text-center w-full px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">Edit</div>
                        </template>
                    </jet-dropdown>
                </div>
            </div>
        
           
        </div>

        <div class="mt-2">
          
             <div v-if="updateForm">

                <div class="bg-grey-lighter flex flex-between py-3 -mx-3 p-2">
                    <textarea type="text" name="body" v-model="body"
                    class="appearance-none resize-y w-full mx-2 rounded-full border bg-white px-2 pt-2 text-xs"></textarea>
                   
                </div>


                <div class="flex  items-center">
                    <div @click="UpdateTweet" class="text-blue-400 underline cursor-pointer">Update a tweet</div>
                    <div @click="updateForm=false" class="text-red-600 mx-2 underline cursor-pointer">cancel</div>
                </div>
            </div>

            <p v-else class="mt-2 text-gray-600 dark:text-gray-300 rounded border border-gray-50">
                    {{body}}
            </p>
        </div>
        

         <div class=" flex justify-between items-center mt-2">
            <p class="font-bold" >{{count}} likes</p>

            <p class="font-bold">{{tweet.replies_count}} comments</p>

        </div>

        <div class="flex items-center justify-between mt-4">
            <Like @click="toggle" :object="tweet" model="tweet"></Like>

            <Link :href="tweet.path" class="text-blue-600 dark:text-blue-400 hover:underline">Make a Comment</Link>
        </div>
    </div>
</template>


<script>
    import Like from '@/Jetstream/Like'
    import Delete from '@/Jetstream/Delete'
    import { Link } from '@inertiajs/inertia-vue3'
    import { computed } from 'vue'
     import JetDropdown from '@/Jetstream/Dropdown'
export default {
    props:{
        tweet:Object,
        user:Object,
    },
    components:{
        Delete,
        Like,
        Link,
        JetDropdown
    },
    methods:{
        hide(){
            this.deleted=true
        },
         toggle(){
            this.clicked=!this.clicked;
            console.log(this.clicked)
            if(this.clicked){this.count++}
            else{this.count--}
        },
        showForm(){
            this.updateForm=true
        },
        UpdateTweet(){
            if(!this.sent){
                this.sent=true   
                window.axios.post(this.route('tweets.update',this.tweet),{
                body:this.body,
            }).then((response) =>{
                    window.flash("tweet has been updated successfully" ,'green')
                    this.sent=false;
                    this.updateForm=false
                    this.body=response.data.body


            }).catch((error)=>{
                    this.sent=false;
                    flash(error.response.data.errors.body[0],'red')
            })
        }
        }
    },
   
    data(){
        return {
            deleted:false,
            count:this.tweet.likes_count,
            clicked:false,
            updateForm:false,
            body:this.tweet.body,
            sent:false,
            
        }
    },
    
}
</script>