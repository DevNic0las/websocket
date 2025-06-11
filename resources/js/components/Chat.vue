<template>
    <div class="flex h-screen flex-col">
        <!-- Área de mensagens -->
        <main class="flex-1 overflow-y-auto p-4">
            <slot></slot>
            <!-- Mensagens renderizadas aqui -->
        </main>
        <div v-if="statusTyping">
            <strong
                ><p>{{ statusTyping }}</p></strong
            >
        </div>
        <!-- Input fixo no rodapé -->
        <InputMessage @send-message="submit" @is-digit="handleIsDigit" :user="props.user" />
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import InputMessage from './InputMessage.vue';
const statusisDigit = ref('');
const props = defineProps({
    idDestiny: {
        type: Number,
        required: true,
    },
    user: {
        type: String,
        required: true,
    },
    statusTyping:{
      type: String,
    
    }
});
const {statusTyping} = props
const emit = defineEmits(['add-message']);

const form = useForm({
    message: '',
    idSendMessage: null,
});

// Evento de digitação

const handleIsDigit = (status) => {
    if (status) {
      window.Echo.private(`App.Models.User.${props.idDestiny}`)
      .whisper('typing',{
        typing: `${props.user} está digitando...`
      })
    }
    return 'error';
};

// Envia mensagem
const submit = (message) => {
    form.message = message;
    form.idSendMessage = props.idDestiny;

    emit('add-message', form.message);
    form.post(route('message'));
    form.reset();
};
</script>
