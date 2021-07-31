<template>
<div class="bg-white p-2 rounded-lg " v-if="!hide">
    <div class=" flex justify-between items-center" >
            <div class="flex items-center">
                <img class="mr-4 shadow sm:w-10 sm:h-10 w-12 h-12 rounded-full" :src="reply.user.avatar" alt="Avatar" />
                <h1 class="text-xl font-medium text-gray-700">{{reply.user.name}}</h1>
            </div>

            <div v-if="reply.can" class="relative">
                <jet-dropdown align="right" width="48">
                    <template #trigger>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                             <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                        </svg>
                    </template>
                    <template #content>
                        <Delete :url="route('replies.delete',[reply])" v-if="reply.can"   @delete="deleteReply"></Delete>
                        <div  @click="showForm" class="block cursor-pointer text-center w-full px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">Edit</div>
                    </template>
                </jet-dropdown>
            </div>
    </div>

    <div class="my-2">
            <div v-if="updateForm">
                <div class="bg-grey-lighter flex flex-between py-3 -mx-3 p-2">
                    <textarea @keydown="updated=false" name="body" v-model='body' class="appearance-none resize-y w-full mx-2 h-10 rounded-full border bg-white px-2 pt-2 text-xs"></textarea>
                </div>

                <div class="flex items-center">
                    <div @click="UpdateReply" class="text-blue-400 underline cursor-pointer">Update a comment</div>
                    <div @click="updateForm=false" class="text-red-600 mx-2 underline cursor-pointer">cancel</div>

                </div>
            </div>
          <p v-else class="text-gray-600">{{body}}</p>
    </div>
    
    <div class="flex justify-between items-center">
            <div>{{reply.created_at}}</div>
            <div>
                 <Like @click="toggle" :object="reply" model="reply"></Like>
                 <div>{{likes}} Likes</div>
            </div>
    </div>

</div>
</template>

<script>
    import Delete from '@/Jetstream/Delete'
    import Like from '@/Jetstream/Like'
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'


export default {
 props:['reply',],
 data(){
     return {
         hide:false,
         likes:this.reply.likes_count,
         liked:this.reply.is_liked,
         updateForm:false,
         body:this.reply.body,
         sent:false,
     }
 },
 methods:{
     toggle(){
         if(this.liked){this.likes--;this.liked=!this.liked}
         else{this.likes++;this.liked=!this.liked}
     },
     showForm(){
         this.updateForm=true
     },
      UpdateReply(){
        if(!this.sent && this.body){
                this.sent=true   
                window.axios.post(this.route('replies.update',this.reply),{
                body:this.body
            }).then((response) =>{
                    this.updateForm=false
                    window.flash("the reply has been updated successfully" ,'green')
                    this.sent=false;
            }).catch((error)=>{
                    this.sent=false;
                    flash(error.response.data.errors.body[0],'red')
            })
            }
        },
        deleteReply(){
            window.flash("the reply has been deleted successfully" ,'red')
            this.hide=true
        }
 },

 components: {
            JetDropdown,
            JetDropdownLink,
            Delete,
            Like
        },
}
</script>

<style>

</style>