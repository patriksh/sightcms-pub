<script setup lang="ts">
import { AudioTour } from '@/types/audioTour';
import AudioTourListItem from '@/components/AudioTourListItem.vue';

defineProps({
    audioTours: {
        type: Array as () => AudioTour[],
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
        <AudioTourListItem v-for="audioTour in audioTours" :key="audioTour._id" :audioTour="audioTour" />
    </template>
    <template v-else>
        <AudioTourListItem v-for="index in 6" :key="index" />
    </template>
</template>