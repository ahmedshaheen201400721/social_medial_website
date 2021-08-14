<template>
    <jet-dropdown align="left" width="96">
        <template #trigger>
                <span class="inline-flex rounded-md">
                    <button @click="count=0" type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                         <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <div class="w-4 h-4 rounded-full text-xs text-white bg-red-500 absolute top-1 -left-3">
                                {{count}}
                            </div>
                        </div>

                        <!-- <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg> -->
                        Notification
                    </button>
                </span>
        </template>

        <template #content>
            <!-- Account Management -->
                <div class="h-96 overflow-x-scroll">
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        notifcations
                    </div>
                    <div v-if="unreadnotification.length>0">
                        <jet-dropdown-link v-for="(notifcation,index) in unreadnotification" :key="index"  :href="notifcation.data.path">
                            <div class="flex w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-md">
                                <div class="w-2 bg-gray-800 dark:bg-gray-900"></div>

                                <div class="flex items-center px-2 py-3">
                                    <img class="object-cover w-10 h-10 rounded-full" alt="User avatar" :src="notifcation.data.photo">

                                    <div class="mx-3">
                                        <p class="text-gray-600 dark:text-gray-200">{{notifcation.data.user}} has replied on the tweet 
                                            <p class="text-blue-500 dark:text-blue-300 hover:text-blue-400 hover:underline">{{notifcation.data.tweet}}</p> .
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </jet-dropdown-link>
                    </div>
                    <div v-if="readnotification.length>0">
                        <jet-dropdown-link v-for="(notifcation,index) in readnotification" :key="index"  :href="notifcation.data.path">
                            <div class="flex w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-md bg-gray-100">
                                <div class="w-2 bg-gray-800 dark:bg-gray-900"></div>

                                <div class="flex items-center px-2 py-3">
                                    <img class="object-cover w-10 h-10 rounded-full" alt="User avatar" :src="notifcation.data.photo">

                                    <div class="mx-3">
                                        <p class="text-gray-600 dark:text-gray-200">{{notifcation.data.user}} has replied on the tweet 
                                            <p class="text-blue-500 dark:text-blue-300 hover:text-blue-400 hover:underline"> {{notifcation.data.tweet}} </p> . 
                                       </p>
                                    </div>
                                </div>
                            </div>
                        </jet-dropdown-link>    
                    </div>
                </div>
        </template>
    </jet-dropdown>


</template>

<script>
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    export default {
        components:{
            JetDropdown,
            JetDropdownLink
        },
        name: "bell",
        // computed:{
        //     count(){
        //         return this.unreadnotification.length
        //     },
        // },
        data(){
          return {
              unreadnotification:[],
              readnotification:[],
              count:0,
          }
        },
        created() {
            axios.get('/notifications/'+this.$page.props.user.id)
                .then(data=>{
                    this.readnotification=data.data.read
                    this.unreadnotification=data.data.unread
                    this.count=data.data.unread.length
                })
        },
        mounted() {
            window.Echo.private('App.Models.User.' + this.$page.props.user.id)
                .notification((notification) => {
                    console.log(notification);
                    this.count++;
                    this.unreadnotification.unshift(notification)
                });
        }
    }
</script>

<style scoped>


</style>
