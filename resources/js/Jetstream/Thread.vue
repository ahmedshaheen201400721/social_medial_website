<template>
          <div class="mb-8">
            <div class=" text-3xl text-center border-2 border-gray-200 flex justify-between items-center">
                <div class="p-4  font-bold text-gray-700 border-r-2 border-gray-200 w-1/2">Thread Name</div>
                <Link :href="route('threads.show',thread)" class="text-2xl font-bold w-1/2 text-gray-700 dark:text-white hover:text-gray-600 dark:hover:text-gray-200 hover:underline"> {{thread.name.toUpperCase()}} </Link>
            </div>
             <div class=" text-3xl text-center border-2 border-gray-200 flex justify-between items-center">
                <div class="p-4  font-bold text-gray-700 border-r-2 border-gray-200 w-1/2">Owner</div>
                 <div class="flex items-center justify-center w-1/2">
                    <img class="object-cover w-10 h-10 mr-4 rounded-full" :src="user.avatar" alt="avatar">
                    <Link :href="user.path" class="font-bold text-gray-700 cursor-pointer w-1/2 dark:text-gray-200 hover:underline">{{user.name}}</Link>
                </div>
            </div>

             <div class=" text-3xl text-center border-2 border-gray-200 flex justify-between items-center">
                <div class="p-4  font-bold text-gray-700 border-r-2 border-gray-200 w-1/2">Tweets Number</div>
                <div class="font-bold text-gray-700 w-1/2" >{{thread.tweets_count}}</div>
            </div>
        </div>

</template>

<script>
    import {Link} from "@inertiajs/inertia-vue3"
export default {
    props:['thread'],
    components: {
            Link,
        },
        data(){
            return {
                user:this.thread.user?this.thread.user:this.$page.props.user,
            }
        }
}
</script>

<style>

</style>