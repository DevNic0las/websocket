<template>
<div>
    {{ group_name }}
    {{ tags }}
    {{ description }}
    {{ amount_people }}
</div>
</template>

<script setup lang="ts">
const props = defineProps({
ObjectListGroups:{
    type: Object,
    required: true,
}    
})
const {group_name,tags,description,amount_people} = props.ObjectListGroups
</script>