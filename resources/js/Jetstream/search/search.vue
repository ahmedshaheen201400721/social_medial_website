<template>
    <div>
    <input type="text" @input="getFriends" v-model="search" name="q" class="rounded-full w-full  border-2 border-gray-300">
    <div v-show="open" class="fixed inset-0 z-10" @click="open = false"></div>
   
    <div class="relative">

        <div class="w-56 md:w-96 absolute  z-50 top-0 h-96  bg-white " v-show="users.length>0 && open" >

                <div class="block px-4 py-2 text-xs text-gray-400">
                        Frinds
                </div>

                <div v-for="(user,index) in users" :key="index">
                    <Link :href="route('profil.show',user)" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition" >
                        <div class="flex justify-between items-center">
                            <img :src="user.avatar" class="w-12 h-12 rounded-full" alt="">
                            <div>{{user.name}}</div>
                        </div>
                    </Link>
                </div>
        </div>
    </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
export default {
    components:{
        Link
    },
    data(){
        return {
            search:"",
            users:[],
            open:false,
        }
    },
    methods:{
        getFriends(){
            if(!this.open){this.open=true}
            console.log(this.open)
            axios.post('/search',{q:this.search}).then(res=>{
                // this.users=res.dat
                console.log(res)
                this.users=res.data
            }).catch(er=>console.log(er))
        }
    }
}
</script>

<style>

</style>