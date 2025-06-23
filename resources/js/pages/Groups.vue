<template>
    <AppSidebarLayout>
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <!-- Cabeçalho -->
            <div class="mb-8 flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Grupos</h1>
                    <p class="mt-1 text-gray-500 dark:text-gray-400">Encontre ou crie comunidades para colaboração</p>
                </div>

                <!-- Botão de Criar Grupo -->
                <Dialog>
                    <DialogTrigger as-child>
                        <button
                            class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 px-5 py-2.5 text-white shadow-lg transition-all hover:from-blue-700 hover:to-indigo-700 hover:shadow-xl focus:ring-4 focus:ring-blue-300/20"
                        >
                            <PlusIcon class="h-5 w-5" />
                            Criar Grupo
                        </button>
                    </DialogTrigger>

                    <DialogContent class="overflow-hidden rounded-2xl border-0 bg-white shadow-2xl dark:bg-gray-800">
                        <DialogHeader class="px-6 pt-6">
                            <DialogTitle class="text-2xl font-bold text-gray-900 dark:text-white">Criar Novo Grupo</DialogTitle>
                            <DialogDescription class="text-gray-500 dark:text-gray-400">
                                Preencha os dados para criar um novo grupo de colaboração.
                            </DialogDescription>
                        </DialogHeader>
                        <form @submit.prevent="sendForm">
                            <div class="space-y-4 px-6">
                                <div>
                                    <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Nome do grupo</label>
                                    <input
                                        v-model="form.group_name"
                                        type="text"
                                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:focus:ring-blue-500/50"
                                        placeholder="Ex: Desenvolvedores Front-end"
                                    />
                                </div>

                                <div>
                                    <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Tags</label>
                                    <input
                                        v-model="form.tags"
                                        type="text"
                                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:focus:ring-blue-500/50"
                                        placeholder="Ex: estudo, frontend, react"
                                    />
                                </div>

                                <div>
                                    <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Descrição</label>
                                    <textarea
                                        v-model="form.description"
                                        rows="3"
                                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:focus:ring-blue-500/50"
                                        placeholder="Descreva o propósito do grupo"
                                    ></textarea>
                                </div>

                                <div>
                                    <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">Limite de membros</label>
                                    <input
                                        v-model.number="form.amount_people"
                                        type="number"
                                        min="1"
                                        class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:focus:ring-blue-500/50"
                                        placeholder="Ex: 10"
                                    />
                                </div>
                            </div>
                            
                            <DialogFooter class="bg-gray-50 px-6 pt-4 pb-6 dark:bg-gray-700/50">
                            <div class="flex justify-end gap-3">
                                <button
                                    class="rounded-lg bg-gray-100 px-5 py-2.5 text-gray-700 transition hover:bg-gray-200 focus:ring-2 focus:ring-gray-300/50 dark:bg-gray-600 dark:text-gray-300 dark:hover:bg-gray-500"
                                    @click=""
                                >
                                    Cancelar
                                </button>
                                <button
                                    class="rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 px-5 py-2.5 text-white shadow-md transition hover:from-blue-700 hover:to-indigo-700 focus:ring-2 focus:ring-blue-500/50"
                                   
                                >
                                    Criar Grupo
                                </button>
                            </div>
                        </DialogFooter>
                    </form>
                    </DialogContent>
                </Dialog>
            </div>

            <!-- Barra de Pesquisa -->
            <div class="relative mb-8">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <SearchIcon class="h-5 w-5 text-gray-400" />
                </div>
                <input
                    v-model="search"
                    type="text"
                    placeholder="Pesquisar grupos por nome, tags ou descrição..."
                    class="w-full rounded-xl border border-gray-300 bg-white py-3 pr-4 pl-10 shadow-sm transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:focus:ring-blue-500/50"
                />
            </div>

            <!-- Lista de Grupos -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                <CardsGroups v-for="item in ArrayListgroups" :key="item.id" :ObjectListGroups="item" />
            </div>
        </div>
    </AppSidebarLayout>
</template>

<script setup lang="ts">
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import CardsGroups from '@/components/CardsGroups.vue';
import AppSidebarLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { SharedData } from '@/types/index';
import { usePage, router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
const page = usePage<SharedData>();
const ArrayListgroups = ref(page.props.groups);
console.log(ArrayListgroups.value);

const form = useForm({
    group_name: '',
    tags: '',
    description: '',
    amount_people: null,
});
const sendForm = () => {
return form.post(route("group.store"));
};
</script>
