<template>
            <div class=" mb-8 w-full flex flex-col items-center py-16 md:py-12 bg-gradient-to-r from-blue-200 to-indigo-600 rounded-lg">
                <div class="w-full flex items-center justify-center">
                    <div class="flex flex-col items-center">
                        <inertia-link :href="route('profil.show',friend)">
                            <img tabindex="0" class="focus:outline-none" :src="friend.avatar" alt="man avatar" />
                            <p tabindex="0" class="focus:outline-none mt-2 text-xs sm:text-sm md:text-base font-semibold text-center text-white">Ricardo Boveta</p>
                        </inertia-link>
                    </div>
                </div>
                <div class="flex items-center mt-7">
                  {{friend.description}}
                </div>
            </div>    
</template>

<script>
export default {
    props:{
        friend:Object
    }
}
</script>