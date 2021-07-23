<template>
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100
     dark:bg-gray-900 sm:items-center sm:pt-0 text-dark">        
     <div class="bg-red-200" >{{ $page.props.users[0].id }}</div>

        <!-- <div v-for="(user,index) in users" :key="index">
            <div class="flex justify-between items-center block">
                <div> {{user.name}}</div>
                <div> {{user.id}}</div>
                <div><img :src="user.profile_photo_url" alt=""></div>

            </div>
        </div> -->
        <div  class="bg-green-200 p-4 rounded-full text-xl m-4 text-center" @click="vi">Home</div>

    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

    export default {
        components:{
            Link
        },
        props:{
            users:Object,
            // meta:String,
        },
        methods:{
            vi(){
                this.$inertia.get("/")
            }
        },
        mounted(){
            console.log(this.$page)
        }
    }
</script>
