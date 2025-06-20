<template>
<AppSidebarLayout>
<main>
    <div>
        <Content>
          <div class="p-12 flex flex-col gap-2 px-4 py-2 ">

            <Teste v-for="item in listFriends" :key="item.id" :usersId="item" :userIsLogin="user.id" />
          </div>
        </Content>
    </div>
</main>
</AppSidebarLayout>




</template>

<script setup lang="ts">
import Content from '@/components/Content.vue';
import AppSidebarLayout from '@/layouts/app/AppSidebarLayout.vue';
import Chat from '@/components/Chat.vue';
import Teste from '@/components/teste.vue';
import type { SharedData } from '@/types/index';
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
const page = usePage<SharedData>();
const friendsThisUser = page.props.friendsThisUser;
const listFriends = ref();
const {user} = page.props.auth
listFriends.value = friendsThisUser;
console.log(listFriends.value);

</script>