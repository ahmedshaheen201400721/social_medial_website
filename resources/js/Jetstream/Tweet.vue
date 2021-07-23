<template>
<div class="flex mt-8 border-2 border-gray-100 p-4 rounded-lg">
    <a :href="user.path" class="w-1/12"> <img :src="user.avatar" alt="" class="w-12 h-12 rounded-full"> </a> 
    <div class="w-11/12">
        <a :href="user.path"> <p class="text-lg font-bold">{{user.name}}</p> </a>
        <p class="border-b-2 border-gray-200 p-4 mb-4">{{tweet.body}}</p>     
        
        <div class=" flex justify-between items-center mt-4">
            <Like :tweet="tweet"></Like>

            <p>{{tweet.created_at}}</p>
        </div>

    </div>
</div>
</template>

<script>
    import Like from '@/Jetstream/Like'
export default {
    props:{
        tweet:Object,
        user:Object,
    },
    components:{
        Like
    }
}
</script>