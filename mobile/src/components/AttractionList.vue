<script setup lang="ts">
import { Attraction } from '@/types/attraction';
import AttractionListItem from '@/components/AttractionListItem.vue';

defineProps({
    attractions: {
        type: Array as () => Attraction[],
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
        <AttractionListItem v-for="attraction in attractions" :key="attraction._id" :attraction="attraction" />
    </template>
    <template v-else>
        <AttractionListItem v-for="index in 6" :key="index" />
    </template>
</template>