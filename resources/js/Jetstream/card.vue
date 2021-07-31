

<template>

<div :class="{'hidden':tohide}" class="flex mt-8 border-2 border-gray-100 p-4 rounded-lg" >
    <Link :href="user.path" class="w-1/12">
        <img :src="user.avatar" alt="" class="w-12 h-12 rounded-full"> 
     </Link> 
     
    <div class="w-11/12">
        <Link :href="user.path"> <p class="text-lg font-bold">{{user.name}}</p> </Link>
        
          <p class="border-b-2 border-gray-200 p-4 mb-4">
            <Link :href="tweet.path">
              {{tweet.body}}
            </Link>
          </p>  
        
        <div class=" flex justify-between items-center mt-4">
            <Like :object="tweet" model="tweet"></Like>

            <p>{{tweet.created_at}}</p>
            <Delete :url="route('tweets.delete',tweet)"  v-if="tweet.can" @delete="hide"></Delete>
        </div>
        <div class=" flex justify-between items-center mt-2">
            <p>{{tweet.replies_count}} replies</p>

            <p>{{tweet.likes_count}} likes</p>
        </div>

    </div>
</div>
</template>

<script>
    import Like from '@/Jetstream/Like'
    import Delete from '@/Jetstream/Delete'
    import { Link } from '@inertiajs/inertia-vue3'
import { computed } from 'vue'
export default {
    props:{
        tweet:Object,
        user:Object,
    },
    components:{
        Delete,
        Like,
        Link
    },
    methods:{
        hide(){
            this.delete=true
        }
    },
    data(){
        return {
            delete:false,
        }
    },
    computed:{
        tohide(){
            return this.delete
        }
    }
}
</script>

