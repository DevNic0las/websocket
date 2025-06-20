<template>
<slot :request="receivedFriendRequests"></slot>
</template>

<script setup lang="ts">
const props = defineProps({
    receivedFriendRequests:{
        type: Object
    },
    sentFriendRequests:{
        type: Object
    }
})
</script>