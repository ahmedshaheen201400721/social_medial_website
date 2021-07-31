<template>
    <ul class="ml-10">
        <li class="text-lg font-bold mb-4"> <Link :href="route('tweets.index')">Home</Link> </li>
        <li class="text-lg font-bold mb-4"><Link :href="route('explore.index')"> Explore </Link> </li> 
        <li class="text-lg font-bold mb-4">Notification</li>
        <li class="text-lg font-bold mb-4">  <Link :href="route('profil.show',$page.props.user)"> Profile</Link>  </li>
    </ul>
</template>
<script>
import {Link} from "@inertiajs/inertia-vue3"
export default {
    // name:nav,
    components:{
        Link
    }
}
</script>