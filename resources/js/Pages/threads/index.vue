<template>
     <app-layout>
        
         <div class="p-4 mb-4 text-center text-3xl " >Your Threads</div>
        <div v-if="threads.length>0">
              <Thread v-for="(thread,index) in threads" :key="index" :thread='thread' ></Thread>
        </div>
    </app-layout>
</template>

<script>
  import AppLayout from '@/Layouts/AppLayout'
    import Thread from '@/Jetstream/Thread'
    export default {
        components: {
            AppLayout,
            Thread,
        },
        props:{
            // friends:Object,
            threads:Object,
        },
       
    }
</script>

