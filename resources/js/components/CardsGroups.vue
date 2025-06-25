<template>
  <div class="group-card bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100 dark:border-gray-700 overflow-hidden max-w-md mx-auto w-full">
    <!-- Conteúdo do Card -->
    <div class="p-6 space-y-4">
      <!-- Nome do Grupo -->
      <div class="space-y-1">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
          {{ group_name }}
        </h3>
        <div class="h-px bg-gray-200 dark:bg-gray-700"></div>
      </div>

      <!-- Tags -->
      <div v-if="tags" class="space-y-2">
        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">TAGS</h4>
        <div class="flex flex-wrap gap-2">
          <span 
            v-for="(tag, index) in tags.split(',')" 
            :key="index"
            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200"
          >
            {{ tag.trim() }}
          </span>
        </div>
      </div>

      <!-- Descrição -->
      <div class="space-y-2">
        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">DESCRIÇÃO</h4>
        <p class="text-gray-700 dark:text-gray-300">
          {{ description }}
        </p>
      </div>

      <!-- Quantidade de Membros -->
      <div class="space-y-2">
        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">MEMBROS</h4>
        <p class="text-gray-900 dark:text-white font-medium">
          {{users_count}}/{{ amount_people }} membros participantes
        </p>
      </div>

      <!-- Botão de Ação -->
      <button @click="attachUserGroup" class="w-full mt-4 py-3 px-4 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-medium rounded-lg transition-all shadow-sm hover:shadow-md">
        Entrar no Grupo
      </button>
    </div>
  </div>
</template>

<script setup lang="ts">
import { DefineProps } from 'vue'
import { router } from '@inertiajs/vue3'
const props = defineProps({
ObjectListGroups:{
    type: Object,
    required: true,
}    
})
const {group_name,tags,description,amount_people,uuid,users_count} = props.ObjectListGroups
console.log(props.ObjectListGroups);

const attachUserGroup = ()=>{
router.post(route('group.attach', uuid));
}

</script>