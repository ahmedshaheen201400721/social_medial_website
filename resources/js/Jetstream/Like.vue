<template>
    <div class="flex justify-between">
    <form >
        <button class="p-2 ml-2 shadow text-white rounded-full" 
                        @click.prevent="submit(object)">
            <svg  v-if="like"  class="h-8 w-8 text-blue-800"  viewBox="0 0 24 24"  fill="blue"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3" /></svg>
            <svg  v-else class="h-8 w-8 text-blue-300"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3" /></svg>
        </button>
    </form>
</div>
</template>

<script>
export default {
    props:{
        object:Object,
        model:String,
    },
    data(){
        return {
            like:this.object.is_liked

        }
    },
    methods:{
         toggle(){
                this.like=!this.like
        },
        submit(object){
             window.axios.post(route('like.store'),{model:this.model,id:object.id}).then(function (response) {
                    console.log(response.data);
                })
            this.toggle();
        }
    },
}
</script>

