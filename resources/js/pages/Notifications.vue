<template>
<div v-for="(item,index) in arrayNotifications" :key="index">
     <p>{{ item.data }}</p>
</div>
</template>

<script setup lang="ts">
import { router, usePage } from '@inertiajs/vue3';
import { onMounted,ref } from 'vue';
import type { SharedData } from '@/types/index';
const page = usePage<SharedData>()
const arrayNotifications = ref()
onMounted(()=>{
    router.get("/notify",{},{
        onSuccess: ()=>console.log("sucesso"),
        preserveState: true
        
    })
})
arrayNotifications.value = page.props.notify


</script>