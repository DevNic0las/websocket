<template>
<form @submit.prevent="submit">
    <Input
    id="message"
    name="message"
    v-model="form.message"
    placeholder="Mensagem..."
    />
    <button type="submit">Enviar</button>
</form>
{{ user.id }}
</template>

<script setup>
const props = defineProps(['user'])
import { Input } from '@/components/ui/input';
import { useForm } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import './../echo'
import { ref } from 'vue';
const userId = props.user.id; // ID do usuário logado (exemplo)
const messages = ref([]);

const form = useForm({
    message: ''
})

const submit = () => {
    messages.value.push({ from: 'me', message: form.message }); // exibe no meu chat
    form.post(route('message')); // envia pro servidor
    form.reset();
}

onMounted(() => {
    window.Echo.private(`App.Models.User.${userId}`)
        .listen("MessagePrivate", (e) => {
            console.log("Recebida no canal privado:", e.message);
            messages.value.push({ from: e.idDestiny, message: e.message }); // exibe no chat recebido
        });


    });

</script>