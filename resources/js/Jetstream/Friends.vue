<template>
<div class="bg-gray-100 rounded">
    
    <div class="my-4 p-4 text-xl font-bold bg-blue-100"> Friends</div>
    
    <ul class="px-4" v-if="friends.length>0">
        <li v-for="(friend,index) in friends" :key="index" class="flex items-center mt-2">
            <inertia-link :href="friend.path" class="">
                <img :src="friend.avatar" alt="" class="w-12 mr-6 h-12 rounded-full">
            </inertia-link>
            
            <p class="text-sm cursor-pointer" @click="showBox(friend)">{{friend.name}}</p>
        </li>
    </ul>
    <div v-else>
        NO Friends yet
    </div>

</div>
</template>

<script>
export default {
    props:{
        friends:Object,
    },
    methods:{
        showBox(friend){
            window.showBox(friend)
        }
    }
}
</script>