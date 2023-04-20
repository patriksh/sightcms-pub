<script setup>
import { computed } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head } from '@inertiajs/inertia-vue3';
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid';
import PageTitle from '@/Components/PageTitle.vue';

// TODO: Fetch events dynamically.

const props = defineProps({
    events: Object
});

// Format events for FullCalendar.
const formattedEvents = computed(() => {
    return props.events.map((event) => {
        return {
            slug: event.slug,
            title: event.title,
            start: new Date(event.date_from),
            end: event.date_to ? new Date(event.date_to) : undefined
        }
    })
});

// Setup FullCalendar options.
const calendarOptions = {
    plugins: [dayGridPlugin],
    initialView: 'dayGridMonth',
    height: 'auto',
    weekends: false,
    events: formattedEvents.value,
    eventClick: (event) => Inertia.visit(`event/${event.event.extendedProps.slug}`)
}
</script>

<template>
    <HeadMeta title="Events" />

    <Layout>
        <section class="p-4 py-6 mx-auto max-w-screen-xl md:p-8 lg:p-10" id="calendar">
            <PageTitle>Events</PageTitle>
            <FullCalendar :options='calendarOptions' />
        </section>
    </Layout>
</template>

<style scoped>
/* Use accent (Tailwind) colors for FullCalendar. */
#calendar {
    --fc-button-bg-color: var(--color-700);
    --fc-button-border-color: var(--color-700);
    --fc-button-hover-bg-color: var(--color-600);
    --fc-button-hover-border-color: var(--color-600);
    --fc-button-active-bg-color: var(--color-600);
    --fc-button-active-border-color: var(--color-600);
}
</style>