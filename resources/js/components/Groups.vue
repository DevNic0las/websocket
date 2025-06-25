<template>
      <div class="p-6 space-y-6">


    <div class="space-y-4">
      <div
        class="bg-white shadow rounded-xl p-4 border border-gray-200"
      >
        <h2 class="text-xl font-semibold text-gray-800 mb-2">
          {{ props.groups.group_name }}
        </h2>

        <div v-if="props.groups.users?.length" class="space-y-1">
          <div
            v-for="user in props.groups.users"
            :key="user.id"
            class="flex items-center gap-2 text-sm text-gray-700"
          >
            <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 10a4 4 0 100-8 4 4 0 000 8zm0 2c-5.333 0-8 2.667-8 4v2h16v-2c0-1.333-2.667-4-8-4z" />
            </svg>
           <p v-if="props.groups.user_id== user.id"> {{ user.name }} Admin</p>
           <p v-else>{{ user.name }}</p>
          </div>
          <Button @click="showChatInGroup(props.groups.uuid)">Abrir chat</Button>
        </div>

        <div v-else class="text-gray-400 text-sm italic">
          Nenhum usuário neste grupo.
        </div>
      </div>
    </div>
    </div>
  

</template>
<script setup>
import ListGroups from './ListGroups.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
const props = defineProps({
    groups: {
        type: Object,
        required: true
    }
})
console.log(props.groups);
const showChatInGroup = (uuid)=>{
router.get(`/group/${uuid}`)
}
</script>