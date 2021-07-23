<template>

<div class="flex mt-8 border-2 border-gray-100 p-4 rounded-lg">
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
            <Like :tweet="tweet"></Like>

            <p>{{tweet.created_at}}</p>
        </div>

    </div>
</div>
</template>

<script>
    import Like from '@/Jetstream/Like'
    import { Link } from '@inertiajs/inertia-vue3'
export default {
    props:{
        tweet:Object,
        user:Object,
    },
    components:{
        Like,
        Link
    }
}
</script>