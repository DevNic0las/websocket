<template>
<div>
    <Groups v-for="item in ArrayListGroups" :key="item.id" :groups="item"/>
</div>

</template>


<script setup lang="ts">
import { onMounted,ref } from 'vue';
import Groups from '@/components/Groups.vue';
import ListGroups from '@/components/ListGroups.vue';
import Button from '@/components/ui/button/Button.vue';
import type { SharedData } from '@/types/index';
import { Link, router, usePage } from '@inertiajs/vue3';
const page = usePage<SharedData>()
const ArrayListGroups = ref()

onMounted(()=>{
ArrayListGroups.value = page.props.groups
console.log(ArrayListGroups.value);
})
</script>