<script setup lang="ts">
import { Event } from '@/types/event';
import EventListItem from '@/components/EventListItem.vue';

defineProps({
    events: {
        type: Array as () => Event[],
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
        <EventListItem v-for="event in events" :key="event._id" :event="event" />
    </template>
    <template v-else>
        <EventListItem v-for="index in 6" :key="index" />
    </template>
</template>