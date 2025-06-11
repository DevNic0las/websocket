<template>

<Content>
<Link :href="route('message.show',name)">
<div>
  <!-- Usuário -->
  <div class="flex items-center justify-between">
    <div class="flex items-center space-x-3">
      <div>
        <p class="text-white font-semibold">{{ name }}</p>
        <p class="text-xs text-red-500">Não perturbar</p>
      </div>
    </div>
    <div class="text-gray-400">💬</div>
    <div>
      <Select></Select>
    </div>
  </div>
</div>
</Link>
</Content>


</template>


<script setup>
import Select from './Select.vue';
import { onMounted } from 'vue';
import {Link} from '@inertiajs/vue3';
import '../echo'
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import Chat from '@/pages/Chat.vue';
import Content from './Content.vue';
import Icon from './Icon.vue';
const props = defineProps({
    usersId:{
        type: Object
    },
    userIsLogin:{
        type: Number
    }
})
const {id,name} = props.usersId //outros usuarios
const {userIsLogin} = props //usuarii logado

onMounted(() => {
    window.Echo.private(`App.Models.User.${userIsLogin}`).listen('MessagePrivate', (e) => {
        console.log(e.message);
    });
});
</script>