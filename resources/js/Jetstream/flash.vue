<template>
    <div>
        <div
            class="py-4 px-8 bg-green-400 text-center fixed bottom-10 right-20 "
            v-text="msg"
            v-if="msg && level"
        >
        </div>

        <div
            class="py-4 px-8 bg-red-400 text-center fixed bottom-10 right-20 "
            v-text="msg"
            v-if="msg && !level"
        >
            
        </div>
  </div>
</template>

<script>
export default {
    data(){
        return {
            msg:"",
            color:"",
        }
    },
    computed:{
        level(){
            return this.color=="green"
        }
    },
    created(){
        window.emitter.on('flash', (object) => this.flashing(object) )
    },
    methods:{
        flashing(object){
            this.msg=object.msg;
            this.color=object.color
            setTimeout(()=>{
                this.msg=""
            },5000)
        }
    }
}
</script>

<style>

</style>