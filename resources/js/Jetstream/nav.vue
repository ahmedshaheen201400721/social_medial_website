<template>
    <ul class="ml-10">
        <li class="text-lg font-bold mb-4"> <a :href="route('tweets.index')">Home</a> </li>
        <li class="text-lg font-bold mb-4"><a :href="route('explore.index')"> Explore </a> </li> 
        <li class="text-lg font-bold mb-4">Notification</li>
        <li class="text-lg font-bold mb-4">Messages</li> 
        <li class="text-lg font-bold mb-4">  <a :href="route('profil.show',$page.props.user)"> Profile</a>  </li>
    </ul>
</template>
<script>
export default {
    // name:nav,
}
</script>