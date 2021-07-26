<template>
    <div class="p-6 border-2  border-blue-200 rounded-lg">
        <form :action="route('tweets.store')" @submit.prevent="submit" class="">
            <textarea class="rounded-xl w-full border-0 border-b-2" v-model="body" required  placeholder="what's in your mind" name="body" ></textarea>
            <select name="thread" v-model="thread" id="" class="w-full">
                <option :value="thread.id" v-for="(thread,index) in threads " :key="index"> {{thread.name}}</option>
            </select>
            <div class="flex justify-between mt-4 p-4">
            <img :src="$page.props.user.avatar" alt="" class="w-12 mr-6 h-12 rounded-full">
            <input class="bg-blue-500 rounded-full text-white p-3 block" type="submit" value="make a tweet">
            </div>
        </form>
 <!-- @if(session('msg'))
       <div class="text-green-300 p-4 ">{{session('msg')}}</div>
 @endif
 @error('body')
       <div class="text-red-300 p-4 ">{{$message}}</div>
 @enderror -->
 </div>
</template>

<script>
export default {
    data(){
        return {
            body:"",
            thread:"",
            sent:false
        }
    },
    props:['threads'],
    methods:{
        submit(){
            if(!this.sent){
                    this.sent=true   
                    window.axios.post(this.route('tweets.store'),{
                    body:this.body,
                    thread:this.thread
                }).then((response) =>{
                        this.body=""
                        this.$emit("newTweet",response.data)
                        window.flash("tweet has been created successfully" ,'green')
                        this.sent=false;
                }).catch((error)=>{
                        this.sent=false;
                    //   window.flash(errors,'red')
                    //   console.log($page.props)
                })
            }
        }
    }
}
</script>