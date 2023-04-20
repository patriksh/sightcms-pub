<script setup lang="ts">
import { ref, onMounted, computed } from 'vue';
import { useRoute } from 'vue-router';
import { onIonViewWillEnter, toastController, IonCardTitle, IonCardSubtitle, IonCardContent, IonButtons, IonBackButton, IonButton, IonIcon, IonPicker } from '@ionic/vue';
import { shareSocialOutline, calendarClearOutline, calendarOutline, alarmOutline, notificationsOutline, notificationsOffOutline } from 'ionicons/icons';
import to from 'await-to-js';
import { Share } from '@capacitor/share';
import { LocalNotifications, Attachment } from '@capacitor/local-notifications';
import { useI18n } from 'vue-i18n';
import { Event } from '@/types/event';
import { getEvent } from '@/http/event';
import { isSameDay, dateToLocaleString, dateToLocaleDateString, dateToLocaleTimeString } from '@/utils/date';
import TabPageLayout from '@/layouts/TabPageLayout.vue';

const route = useRoute();
const { t } = useI18n();

const eventSlug = ref<string>(route.params.slug as string);
const event = ref<Event|null>();
const eventLoading = ref(false); // Used for showing skeleton loaders.
const canShare = ref(false);

// Fetch the event from the backend.
const fetchEvent = async () => {
    eventLoading.value = true;
    const [error, eventResponse] = await to(getEvent(eventSlug.value));
    eventLoading.value = false;

    if(error) {
        event.value = null;
        toastController.create({
            message: t('event_page.failed_to_load'),
            duration: 2000,
            color: 'danger',
        }).then(toast => toast.present());
    } else {
        event.value = eventResponse.event;
    }
};

// Check is navigator.share available.
const checkCanShare = async () => {
    canShare.value = (await Share.canShare()).value;
};

// Share the event.
const share = async () => {
    if(!event.value) return;

    await Share.share({
        title: event.value.title,
        url: event.value.url || '',
        dialogTitle: t('share_with_friends'),
    });
}

const notificationEnabled = ref(false);

const checkNotificationEnabled = async () => {
    if(!event.value?.date_from) return;

    const notifications = await LocalNotifications.getPending();

    notificationEnabled.value = notifications.notifications.some(notification => {
        return notification.title === event.value?.title && notification.body === event.value?.location;
    });
}

const isNotificationPickerOpen = ref(false);

const notificationPickerColumns = ref([
    {
        name: 'notifications',
        options: [
            {
                text: t('event_page.notifications.half_hour_before'),
                value: 30
            },
            {
                text: t('event_page.notifications.one_hour_before'),
                value: 60
            },
            {
                text: t('event_page.notifications.two_hours_before'),
                value: 120
            },
            {
                text: t('event_page.notifications.one_day_before'),
                value: 1440
            },
            {
                text: t('event_page.notifications.two_days_before'),
                value: 2880
            },
            {
                text: t('event_page.notifications.one_week_before'),
                value: 10080
            }
        ]
    }
]);

const notificationPickerButtons = ref([
    {
        text: t('cancel'),
        role: 'cancel'
    },
    {
        text: t('confirm'),
        handler: async (value: any) => {
            if(value?.notifications?.value && event.value?.date_from) {
                const minutesBefore = value.notifications.value;
                const eventTime = new Date(event.value?.date_from);

                let attachments: Attachment[]|undefined;

                if(event.value.image_url) {
                    attachments = [{
                        id: 'image',
                        url: event.value.image_url
                    }];
                }

                console.log(await LocalNotifications.schedule({
                    notifications: [
                        {
                            title: event.value.title,
                            body: event.value.location,
                            id: Math.ceil(new Date().getTime() / 1000), // temporary
                            schedule: {
                                at: new Date(eventTime.getTime() - minutesBefore * 60000)
                            },
                            attachments: attachments,
                            smallIcon: 'ic_notification',
                        }
                    ]
                }));

                notificationEnabled.value = true;

                toastController.create({
                    message: t('event_page.notifications.scheduled'),
                    duration: 2000,
                }).then(toast => toast.present());
            }
        }
    }
]);

const removeNotification = async () => {
    if(!event.value?.date_from) return;

    const notifications = await LocalNotifications.getPending();

    const notification = notifications.notifications.find(notification => {
        return notification.title === event.value?.title && notification.body === event.value?.location;
    });

    if(notification) {
        await LocalNotifications.cancel({ notifications: [notification] });
        notificationEnabled.value = false;
        toastController.create({
            message: t('event_page.notifications.removed'),
            duration: 2000,
        }).then(toast => toast.present());
    }
}

onMounted(() => {
    checkCanShare();
    checkNotificationEnabled();
});

// Fetch the event each time the page is visited, since Ionic caches views so onMounted isn't called every time.
onIonViewWillEnter(() => {
    eventSlug.value = route.params.slug as string;
    fetchEvent();
});
</script>

<template>
    <TabPageLayout :title="event?.title || t('event_page.event')">
        <template #toolbar-start>
            <ion-buttons slot="start">
                <ion-back-button default-href="/" />
            </ion-buttons>
        </template>
        <template v-if="canShare" #toolbar-end>
            <ion-buttons slot="end">
                <ion-button v-if="event?.date_from" @click="notificationEnabled ? removeNotification() : isNotificationPickerOpen = true">
                    <ion-icon :icon="notificationEnabled ? notificationsOffOutline : notificationsOutline" />
                </ion-button>
                <ion-button @click="share">
                    <ion-icon :icon="shareSocialOutline" />
                </ion-button>
            </ion-buttons>
        </template>
        <div v-if="event">
            <img v-if="event.image_url" :src="event.image_url" />
            <div class="container">
                <ion-card-title>{{ event.title }}</ion-card-title>
                <ion-card-subtitle>{{ event.location }}</ion-card-subtitle>
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
                            <template v-if="event.date_to !== null"> to {{ dateToLocaleTimeString(new Date(event.date_to)) }}</template>
                        </div>
                    </template>
                </div>
                <div class="separator" />
                <ion-card-content>
                    <div class="content" v-html="event.content" />
                </ion-card-content>
                <div class="separator" />
                <ion-card-content v-if="event.logo_url || event.website_link">
                    <ion-button v-if="event.website_link" :href="event.website_link" target="_blank" fill="outline" expand="block">
                        {{ $t('view_website') }}
                    </ion-button>
                    <img v-if="event.logo_url" :src="event.logo_url" />
                </ion-card-content>
            </div>
        </div>

        <ion-picker :is-open="isNotificationPickerOpen" @didDismiss="isNotificationPickerOpen = false" :columns="notificationPickerColumns" :buttons="notificationPickerButtons" />
    </TabPageLayout>
</template>

<style scoped lang="scss">
.container {
    padding: 16px;

    ion-card-title {
        margin-bottom: 8px;
    }

    .dates {
        margin: 12px 0;

        .date {
            display: flex;
            gap: 8px;
            align-items: center;
            font-size: 14px;
            margin-bottom: 8px;

            ion-icon {
                color: var(--ion-color-primary);
            }
        }
    }

    ion-card-content {
        padding: 0;

        .content {
            ::v-deep img {
                height: auto;
            }
        }
    }
}

.separator {
    margin: 12px 0;
}
</style>