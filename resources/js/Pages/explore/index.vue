<template>
    <app-layout>
       <div v-if="notFollowers.length>0">
           <add-friend v-for="(friend,index) in notFollowers" :key="index" :friend="friend" ></add-friend>
       </div>
       <div v-else>No suggestions Right Now</div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import AddFriend from '@/Jetstream/AddFriend'
    export default {
        components: {
            AppLayout,
            AddFriend,
        },
         methods:{
            
            addUsers(){
               let append="?page="+this.page
                axios("/api/explore"+append).then(res=>{
                return res.data
                }).then(res=>{
                    this.notFollowers.push(...res.data)
                    this.page++
                    if(res.data.length>0){this.readyToConsumeUsers=true}
                }).catch(e=>this.readyToConsumeUsers=false)
            }
        },
       
        created(){
            this.addUsers()
             window.onscroll = () => {
            let bottomOfWindow = document.documentElement.scrollTop + window.innerHeight > document.documentElement.offsetHeight-400;
           if (bottomOfWindow && this.readyToConsumeUsers) {
                this.readyToConsumeUsers=false
                this.addUsers()
             }
            
            };
        },
        data(){
            return {
                notFollowers:[],
                readyToConsumeUsers:false,
                page:1,
            }
        }
    }
</script>
