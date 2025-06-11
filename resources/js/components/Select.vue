<template>
    <Select>
        <SelectTrigger>
            <SelectValue placeholder="..." />
        </SelectTrigger>
        <SelectContent>
            <SelectGroup>
                <SelectLabel>Mais opções</SelectLabel>
                <SelectItem value="Nao pertubar">Não pertubar</SelectItem>
                 <SelectItem value="Disponível">Disponível</SelectItem>
            </SelectGroup>
        </SelectContent>
    </Select>
</template>

<script setup>
import { Select, SelectContent, SelectGroup, SelectItem, SelectLabel, SelectTrigger, SelectValue } from '@/components/ui/select';

</script>
