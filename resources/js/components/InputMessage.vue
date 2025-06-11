<template>
  <div class="w-full border-t border-gray-200 bg-white p-4">
    <form @submit.prevent="submitMessage" class="flex items-center gap-2">
      <Input 
        placeholder="Mensagem..." 
        v-model="form.message" 
        id="message" 
        name="message"
        class="flex-1"
      />
      <Button class="px-4 py-2">Enviar</Button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { computed, watch } from 'vue';
import Button from './ui/button/Button.vue';
import Input from './ui/input/Input.vue';
const props= defineProps(['user']);
const emit = defineEmits(['send-message', 'is-digit']);

const form = useForm({
  message: '',
});

// Computa o status de digitação
const isDigit = computed(() => form.message.length > 0);
watch(isDigit, (value) => {
  emit('is-digit', value);
});

// Envia a mensagem
const submitMessage = () => {
  if (form.message.trim()) {
    emit('send-message', form.message);
    emit('is-digit', ''); // Reseta status de digitação
    form.reset();
  }
};
</script>
