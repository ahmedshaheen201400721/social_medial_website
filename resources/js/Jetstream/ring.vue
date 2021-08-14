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
            var audio = new Audio("https://socialwebsite.ddns.net/storage/sound.mp3");
            audio.play();
        }
    }
}
</script>

<style>

</style>