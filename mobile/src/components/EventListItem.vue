<script setup lang="ts">
import { IonCard, IonCardHeader, IonCardTitle, IonCardSubtitle, IonCardContent, IonIcon, IonSkeletonText } from '@ionic/vue';
import { calendarClearOutline, calendarOutline, alarmOutline } from 'ionicons/icons';
import { useRouter } from 'vue-router';
import { Event } from '@/types/event';
import { isSameDay, dateToLocaleString, dateToLocaleDateString, dateToLocaleTimeString } from '@/utils/date';

const props = defineProps({
    event: {
        type: Object as () => Event
    }
});

const router = useRouter();
const openEvent = () => props.event ? router.push({ name: 'tabs.events.show', params: { slug: props.event.slug }}) : null;
</script>

<template>
    <ion-card v-if="event" @click="openEvent">
        <img v-if="event.image_url" :src="event.image_url" class="img" />
        <ion-card-header>
            <ion-card-title>
                {{ event.title }}
            </ion-card-title>
        </ion-card-header>

        <ion-card-content>                
            <div class="dates">
                <!-- Date display for when the event lasts longer than a day.-->
                <template v-if="event.date_to !== null && !isSameDay(new Date(event.date_from), new Date(event.date_to))">
                    <div class="date">
                        <ion-icon :icon="calendarClearOutline" slot="start" />
                        {{ $t('from') }}: {{ dateToLocaleString(new Date(event.date_from)) }}
                    </div>
                    <div class="date">
                        <ion-icon :icon="calendarOutline" slot="start" />
                        {{ $t('to') }}: {{ dateToLocaleString(new Date(event.date_to)) }}
                    </div>
                </template>
                <template v-else>
                    <!-- Date display for when the event lasts less than a day. -->
                    <div class="date">
                        <ion-icon :icon="calendarOutline" slot="start" />
                        {{ $t('from') }}: {{ dateToLocaleDateString(new Date(event.date_from)) }}
                    </div>
                    <div class="date">
                        <ion-icon :icon="alarmOutline" slot="start" />
                        {{ dateToLocaleTimeString(new Date(event.date_from)) }}
                        <template v-if="event.date_to !== null"> {{ $t('to').toLowerCase() }} {{ dateToLocaleTimeString(new Date(event.date_to)) }}</template>
                    </div>
                </template>
            </div>
            
            {{ event.location }}
        </ion-card-content>
    </ion-card>
    <!-- skeleton -->
    <ion-card v-else>
        <div class="img" style="height: 200px; background: var(--ion-color-light);" />
        <ion-card-header>
            <ion-card-title>
                <ion-skeleton-text style="height: 36px" animated />
            </ion-card-title>
        </ion-card-header>

        <ion-card-content>
            <ion-skeleton-text />
            <ion-skeleton-text />
            <ion-skeleton-text />
            <ion-card-subtitle>
                <ion-skeleton-text style="width: 130px" />
            </ion-card-subtitle>
        </ion-card-content>
    </ion-card>
</template>

<style scoped lang="scss">
.dates {
    margin-bottom: 12px;

    .date {
        display: flex;
        gap: 8px;
        align-items: center;

        ion-icon {
            color: var(--ion-color-primary);
        }
    }
}
</style>