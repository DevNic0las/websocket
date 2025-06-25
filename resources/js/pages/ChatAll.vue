<template>
    <Chat />
</template>

<script setup lang=ts>
import Chat from '@/components/Chat.vue';
import { usePage } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import type { SharedData } from '@/types/index';
const page = usePage<SharedData>()
const id = page.props.groups
const arrayConversasion = ref([]);

onMounted(() => {
    if (window.Echo) {
        window.Echo.channel(`group.${id}`).listen('MessagePublic', (e) => {
            if (e.message) {
                arrayConversasion.value.push(e.messageAll);
            }
        });
    }
});
</script>
