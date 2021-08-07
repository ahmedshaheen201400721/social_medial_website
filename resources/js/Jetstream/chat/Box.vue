<template>
        <div  v-if="friend && !hide" class="w-80 h-96 bg-white rounded shadow-2xl fixed bottom-4 right-32 z-50 ">
            <nav class="w-full h-10 bg-gray-900 rounded-tr rounded-tl flex justify-between items-center">
                <div class="flex justify-center items-center"> 
                    <i @click="hide=true" class="cursor-pointer mdi mdi-arrow-left font-normal text-gray-300 ml-1"></i> 
                   <inertia-link :href="friend.path" class="flex justify-center items-center">
                     <img :src="friend.avatar" class="rounded-full ml-1" width="25" height="25"> 
                     <span class="text-xs font-medium text-gray-300 ml-1">{{friend.name}}</span> 
                   </inertia-link>
                </div>
                <!-- <div class=" hidden flex items-center"> <i class="mdi mdi-video text-gray-300 mr-4"></i> <i class="mdi mdi-phone text-gray-300 mr-2"></i> <i class="mdi mdi-dots-vertical text-gray-300 mr-2"></i> </div> -->
                <div @click="hide=true" class="cursor-pointer mr-4">&#10060;</div>
            </nav>

            <div class="overflow-auto px-1 py-1" style="height: 19rem;" id="journal-scroll">
                
                <!-- <div class="flex justify-center"> <span class="text-gray-500 text-xs pt-4" style="font-size: 8px;">Call started at 02:33 am</span> </div> -->
                <!-- <div class="flex justify-center"> <span class="text-gray-500 text-xs" style="font-size: 8px;">Call ended at 02:33 am</span> </div> -->
                
                <div v-for="(messag,index) in messages" :key="index">
                    <div v-if="messag.sender_id==$page.props.user.id" class="flex justify-end pt-2 pl-10"> <span class="bg-green-900 h-auto text-gray-200 text-xs font-normal rounded-sm px-1 p-1 items-end flex justify-end " style="font-size: 10px;">{{messag.body}}<span class="text-gray-400 pl-1" style="font-size: 8px;">{{messag.created_at}}</span></span> </div>
                    <div v-else class="flex items-center pr-10 pt-2"> <img :src="friend.avatar" class="rounded-full shadow-xl" width="15" height="15"> <span class="flex ml-1 h-auto bg-gray-900 text-gray-200 text-xs font-normal rounded-sm px-1 p-1 items-end" style="font-size: 10px;">{{messag.body}}<span class="text-gray-400 pl-1" style="font-size: 8px;">{{messag.created_at}}</span></span> </div>               
                </div>
                <div class=" " id="chatmsg"> </div>
            </div>

            <div class="flex justify-between items-center p-1 ">
                <div class="relative">
                <!-- <i class="mdi mdi-emoticon-excited-outline absolute top-1 left-1 text-gray-400" style="font-size: 17px !important;font-weight: bold;"></i>  -->
                <input name="message" @keydown.enter="send" v-model="message" type="text" class="rounded-full pl-6 pr-12 py-2 focus:outline-none h-auto placeholder-gray-100 bg-gray-900 text-white" style="font-size: 11px;width: 250px;" placeholder="Type a message..." id="typemsg"> 
                    <!-- <i class="mdi mdi-paperclip absolute right-8 top-1 transform -rotate-45 text-gray-400"></i> <i class="mdi mdi-camera absolute right-2 top-1 text-gray-400"></i>  -->
                </div>

                <!-- <div class="w-7 h-7 rounded-full bg-blue-300 text-center items-center flex justify-center hover:bg-gray-900 hover:text-white"> <i class="mdi mdi-microphone "></i> </div> -->
                <div  class="w-7 h-7 rounded-full bg-blue-300 text-center items-center flex justify-center"> 
                    <button  class="w-7 h-7 rounded-full text-center items-center flex justify-center 
                    focus:outline-none hover:bg-gray-900 hover:text-white" @click="send()">
                        <i class="mdi mdi-send "></i>
                    </button> 
                </div>
            </div>
        </div>
</template>

<script>
export default {
    created(){
        window.emitter.on('showBox', (friend) => {
            this.show(friend)
            axios.get("/messages/"+friend.id).then(res=>{
            this.conversation=res.data.conversation    
            this.messages=res.data.messages    
            this.hide=false
            })
        } )
    },
    mounted(){
         window.Echo.private('App.Models.User.' + this.$page.props.user.id).listen("MessageCreated",res=>{
             this.messages.push(res.message)
         })
    },
    methods:{
        show(friend){
            this.friend=friend
        },
        send(){
            // console.log(this.message)
            axios.post(route("messages.store",this.conversation),{'body':this.message,'sender_id':this.user.id,'reciever_id':this.friend.id})
            .then(res=>console.log(res))   
            this.messages.push({'body':this.message,'sender_id':this.user.id,'created_at':"1 second ago"})
            this.message=""
        }
    },
    data(){
        return {
            user:this.$page.props.user,
            friend:null,
            hide:false,
            message:"",
            messages:[],
            conversation:null,
        }
    }    
}
</script>

<style>

</style>