<template>
    <div class="flex flex-col gap-6">
        <div>
            <h2>Adicione um amigo</h2>
        </div>
        <div>
            <form @submit.prevent="submit">
                <Input placeholder="Nome do usuário" v-model="form.friendName" />
                <Button :disabled="!isEnable">Enivar convite</Button>
            </form>
        </div>
    </div>
</template>

<script setup>
import Input from '@/components/ui/input/Input.vue';
import Button from '@/components/ui/button/Button.vue';
import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
const form = useForm({
    friendName: '',
});
const isEnable = computed(()=>form.friendName.length > 0)
const submit = () => {
    try {
        form.post(route('friend.invite'));
    } catch (e) {
        console.log(e);
    }
};
</script>
