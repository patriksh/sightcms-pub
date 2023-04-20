<script setup lang="ts">
import { Gastro } from '@/types/gastro';
import GastroListItem from '@/components/GastroListItem.vue';

defineProps({
    gastros: {
        type: Array as () => Gastro[],
        required: true
    },
    loading: {
        type: Boolean,
        default: false
    }
});
</script>

<template>
    <template v-if="!loading">
        <GastroListItem v-for="gastro in gastros" :key="gastro._id" :gastro="gastro" />
    </template>
    <template v-else>
        <GastroListItem v-for="index in 6" :key="index" />
    </template>
</template>