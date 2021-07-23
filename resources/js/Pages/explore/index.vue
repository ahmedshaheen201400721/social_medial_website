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
        props:{
            notFollowers:Object,
        },
        methods:{
            
        },
        data(){
            return {

            }
        }
    }
</script>
