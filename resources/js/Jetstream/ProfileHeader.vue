<template>
    <div>
    <div class="relative">
        <div v-if="can">
            <input type="file"  ref="coverfile" @change="uploadCover" id="file" cover hidden name="file" accept="image/*" >
            <button v-if="!response" @click="$refs.coverfile.click()"  class="absolute bg-white font-black p-2 rounded bottom-10 left-10"> change cover</button>
            <button v-if="response" @click="saveCover" class="absolute bg-white font-black p-2 rounded bottom-10 left-10"> save change </button>
       </div>
       <img :src="cover"  class="w-full h-56 rounded-xl ">
       <img :src="avatar"  class="w-36 h-36 rounded-full absolute transform bottom-0 translate-y-1/2 -translate-x-1/2" style="left:50% " alt="">
    </div>
    
    
    <div class=" flex justify-between my-4  relative">
        <div>
           <div class="text-xl font-bold">  {{user.name}}</div>
        <div>Joined {{user.created_at}}</div>
        </div>
       
        <div class="flex justify-between items-center">
            <!-- <x-follow :user="$page.props.user" v-if="can"></x-follow> -->

        <Link class="p-2 ml-2 bg-blue-50 rounded-full"  v-if="can" :href="route('profile.show')">Edit Profile</Link>
        </div>
    </div>
    
    <div class="mt-8 mb-2">
        <div class="tex-2xl font-bold">Description</div>
        {{ user.description }}
    </div>
</div>
</template>


<script>
    import {Link} from "@inertiajs/inertia-vue3"
import { Method } from '@inertiajs/inertia'

export default {

    props:['can','user'],
    components:{Link},
    data(){
        return{
            response:false,
            cover:this.user.cover,
            uploadedCover:null,
            avatar:this.user.avatar,
        }
    },

   methods:{
    persist(image){
       

    },
    uploadCover(e){
        const image = e.target.files[0];
        this.uploadedCover=image
        const reader = new FileReader();
        reader.readAsDataURL(image);
        reader.onload = e =>{
            this.cover = e.target.result;
            this.response=true;
    };
   },
   saveCover(){
      let data = new FormData();
        let settings = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }

        data.append("cover", this.uploadedCover);
        axios.post(route('profil.cover',this.user),data,settings)
        .then(response=>{
           window.flash('you have updated your cover','green')
           this.response=false
       }).catch(e=>console.log(e))
   }

   }
}
</script>