<template>
    <div>
       
  </div>
</template>

<script>
export default {
  
    created(){
        window.emitter.on('ring', () => this.ringing() )
    },
    methods:{
        ringing(){
            var audio = new Audio("http://ec2-34-201-68-96.compute-1.amazonaws.com:8000/storage/sound.mp3");
            audio.play();
        }
    }
}
</script>

<style>

</style>