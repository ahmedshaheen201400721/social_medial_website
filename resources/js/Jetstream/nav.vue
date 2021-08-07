<template>
    <ul class="ml-10">
        <li class="text-lg font-bold mb-4"> <Link :href="route('tweets.index')">Home</Link> </li>
        <li class="text-lg font-bold mb-4"><Link :href="route('explore.index')"> Explore Followers </Link> </li> 
        <li class="text-lg font-bold mb-4"> <bell></bell> </li>
        <li class="text-lg font-bold mb-4">  <Link :href="route('profil.show',$page.props.user)"> Profile</Link>  </li>
    </ul>
</template>
<script>
import {Link} from "@inertiajs/inertia-vue3"
import bell from '@/Jetstream/notifications/bell'

export default {
    // name:nav,
    data(){
        return {
            userId:this.$page.props.user.id,
        }
    },
    components:{
        Link,
        bell
        
    },
    mounted(){
        Echo.private('App.Models.User.' + this.userId)
        .notification((notification) => {
            console.log(notification);
        });
    }
}
</script>