<template>
  <div>
    <Link :href="route('message.all')">Voltar</Link>
  </div>
  <div class="flex flex-col gap-6">
    <!-- Adicionar amigo -->
    <div>
      <h2 class="text-xl font-bold">Adicione um amigo</h2>
      <form @submit.prevent="submit" class="flex gap-4 items-center">
        <Input
          placeholder="Nome do usuário"
          v-model="form.friendName"
        />
        <Button :disabled="!isEnable">Enviar convite</Button>
      </form>
    </div>

    <!-- Navegação -->
    <div class="flex gap-4">
      <Link :href="route('peding')" class="text-blue-500">Pedidos pendentes</Link>
      <Link :href="route('sent')" class="text-blue-500">Pedidos enviados</Link>
    </div>

    <!-- Pedidos recebidos -->
    <div>
      <h3 class="text-lg font-semibold">Pedidos recebidos</h3>
      <ShowFriendsRequests
        v-for="item in receivedFriendRequests"
        :key="item.id"
        :receivedFriendRequests="item"
      >
        <template #default="{ request }">
          <div class="mx-32 flex items-center justify-between border p-4 rounded">
            <p>{{ request.name }}</p>
            
            <Button @click="acceptedFriend(item.name)">Aceitar</Button>
            
          </div>
        </template>
      </ShowFriendsRequests>
    </div>

    <!-- Pedidos enviados -->
    <div>
      <h3 class="text-lg font-semibold">Pedidos enviados</h3>
      <ShowFriendsRequests
        v-for="item in sentFriendRequests"
        :key="item.id"
        :receivedFriendRequests="item"
      >
        <template #default="{ request }">
          <div class="mx-32 flex items-center justify-between border p-4 rounded">
            <p>{{ request.name }}</p>
            <span class="text-gray-500">Enviado</span>
          </div>
        </template>
      </ShowFriendsRequests>
    </div>
  </div>
</template>

<script setup lang="ts">
import ShowFriendsRequests from '@/components/ShowFriendsRequests.vue';
import Button from '@/components/ui/button/Button.vue';
import Input from '@/components/ui/input/Input.vue';
import type { SharedData } from '@/types/index';
import { Link, router, useForm, usePage } from '@inertiajs/vue3';

import { computed } from 'vue';
const page = usePage<SharedData>();
const receivedFriendRequests = page.props.receivedFriendRequests;
const sentFriendRequests = page.props.sentFriendRequests;

const form = useForm({
    friendName: '',
});
const isEnable = computed(() => form.friendName.length > 0);
const submit = () => {
    try {
        form.post(route('friend.invite'));
    } catch (e) {
        console.log(e);
    }
};
const acceptedFriend = (name:string)=>{
  router.post(route("accepted",name));
}
</script>
