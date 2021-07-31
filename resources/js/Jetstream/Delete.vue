<template>
    <button @click="submit" class="block w-full px-4 text-center py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">
        Delete
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