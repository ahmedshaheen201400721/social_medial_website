<template>
  <div
    :class="level"
    class="py-4 px-8 text-center fixed bottom-10 right-20 "
    v-text="msg"
    v-if="msg"
  >
      
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
            return "bg-"+this.color+"-400"
        }
    },
    mounted(){
        window.emitter.on('flash', (object) => this.flashing(object) )
    },
    methods:{
        flashing(object){
            this.msg=object.msg+object.color;
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