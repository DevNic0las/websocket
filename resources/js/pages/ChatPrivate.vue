<template>
    <div>
        <ListMessages v-for="(item, index) in arrayConversasion" :key="index" :messages="item" />
    </div>
    <div>
        <Chat :id-destiny="props.userDestiny?.id" :user="name" :statusMessages="statusTyping" />
    </div>
</template>

<script setup lang="ts">
import ListMessages from '@/components/ListMessages.vue';
import type { SharedData } from '@/types';
import { usePage } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import Chat from '../components/Chat.vue';
const props = defineProps({
    userDestiny: {
        type: Object,
    },
});
const page = usePage<SharedData>();
const { id, name } = page.props.auth.user;
const arrayConversasion = ref<any[]>([]);
const statusTyping = ref('');
onMounted(() => {
    if (window.Echo) {
        window.Echo.private(`App.Models.User.${id}`).listen('MessagePrivate', (e: any) => {
            console.log('Mensagem recebida:', e.message);
            if (e.message) {
                arrayConversasion.value.push(e.message);
            }
        });
        window.Echo.private(`App.Models.User.${id}`).listenForWhisper('typing', (e: any) => {
            statusTyping.value = e.typing;
        });
    } else {
        console.error('Echo não foi inicializado');
    }
});
</script>
