<script setup lang="ts">
import { Page } from '@/types/page';
import PageListItem from '@/components/PageListItem.vue';

defineProps({
    pages: {
        type: Array as () => Page[],
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
        <PageListItem v-for="page in pages" :key="page._id" :page="page" />
    </template>
    <template v-else>
        <PageListItem v-for="index in 6" :key="index" />
    </template>
</template>