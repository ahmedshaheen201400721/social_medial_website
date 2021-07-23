<template>
    <div>
    <div class="relative">
       <img :src="user.cover"  class="w-full h-56 rounded-xl ">
       <img :src="user.avatar"  class="w-36 h-36 rounded-full absolute transform bottom-0 translate-y-1/2 -translate-x-1/2" style="left:50% " alt="">
    </div>
    
    
    <div class=" flex justify-between my-4  relative">
        <div>
           <div class="text-xl font-bold">  {{user.name}}</div>
        <div>Joined {{user.created_at}}</div>
        </div>
       
        <div class="flex justify-between items-center">
           

        <a class="p-2 ml-2 bg-blue-50 rounded-full" :href="route('profil.edit',user)">Edit Profile</a>
        </div>
    </div>
    <div class="mt-8">
        {{ user.description }}
    </div>
</div>
</template>


<script>
export default {
    data(){
        return{
            user:this.$page.props.user
        }
    }
}
</script>