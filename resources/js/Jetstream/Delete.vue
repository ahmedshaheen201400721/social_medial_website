<template>
    <button @click="submit" class="p-4 bg-red-300 m-2 rounded-lg">
        delete
    </button>
</template>

<script>
export default {
  props:['url'],  
  methods:{
      submit(){
          window.axios.delete(this.url).then(response=>{
              console.log(response.data)
              this.$emit('delete')
              })
      }
  },
}
</script>