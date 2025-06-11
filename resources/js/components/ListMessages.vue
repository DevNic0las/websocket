<template>
  <div class="flex flex-col gap-2 px-4 py-2 border-2">
      <p>{{ messages }}</p>
  </div>
</template>

<script setup>
const props = defineProps({
    messages:{
        type: Array,
    
    }
})
</script>