<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { toastController, IonInfiniteScroll, IonInfiniteScrollContent, InfiniteScrollCustomEvent } from '@ionic/vue';
import to from 'await-to-js';
import { useI18n } from 'vue-i18n';
import { Event } from '@/types/event';
import { getEvents } from '@/http/event';
import TabPageLayout from '@/layouts/TabPageLayout.vue';
import CategoryChips from '@/components/CategoryChips.vue';
import EventList from '@/components/EventList.vue';
import { Category } from '@/types/category';

const { t } = useI18n();

// Reuse the Category type for filtering events based on the time frame.
const eventTypes: Category[] = [
    {
        slug: 'upcoming',
        name: t('events_page.upcoming')
    },
    {
        slug: 'past',
        name: t('events_page.past')
    },
    {
        slug: 'week',
        name: t('events_page.this_week')
    },
    {
        slug: 'month',
        name: t('events_page.this_month')
    }
];

const activeType = ref<string | undefined>();
const events = ref<Event[]>([]);
const eventsLoading = ref(false); // Used for showing skeleton loaders.
const eventPage = ref(0);
const eventTotal = ref(0);

// Fetch events from the backend.
const fetchEvents = async () => {
    eventsLoading.value = true;
    const [error, eventResponse] = await to(getEvents(activeType.value));
    eventsLoading.value = false;

    if(error) {
        events.value = [];
    } else {
        events.value = eventResponse.events.data;
        eventPage.value = eventResponse.events.current_page;
        eventTotal.value = eventResponse.events.total;
    }
};

const onChangeType = async (slug?: string) => {
    activeType.value = slug || undefined;
    fetchEvents();
};

// Fetch more events when the user scrolls to the bottom of the page.
const onInfiniteScroll = async (e: InfiniteScrollCustomEvent) => {
    if(events.value.length < eventTotal.value) {
        eventPage.value += 1;

        const [error, eventResponse] = await to(getEvents(activeType.value, eventPage.value));

        if(error) {
            eventPage.value -= 1;
            return toastController.create({
                message: t('events_page.failed_to_load'),
                duration: 2000,
                color: 'danger'
            }).then(toast => toast.present());
        } else {
            events.value = [...events.value, ...eventResponse.events.data];
        }
    }

    e.target.complete();
};

onMounted(() => {
    fetchEvents();
});
</script>

<template>
    <TabPageLayout :title="$t('events_page.events')">
        <CategoryChips :categories="eventTypes" :active-slug="activeType" @change="onChangeType" />
        <div class="separator" />
        <EventList :events="events" :loading="eventsLoading" />
        <ion-infinite-scroll @ionInfinite="onInfiniteScroll">
            <ion-infinite-scroll-content></ion-infinite-scroll-content>
        </ion-infinite-scroll>
    </TabPageLayout>
</template>

<style scoped lang="scss">
.separator {
    margin: 12px 10px 18px 10px;
}

.ios {
    .separator {
        margin: 16px;
    }
}
</style>