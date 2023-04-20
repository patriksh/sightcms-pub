<template>
    <ion-page>
        <ion-tabs>
            <ion-router-outlet></ion-router-outlet>
            <ion-tab-bar slot="bottom" ref="tabBar">
                <ion-tab-button tab="articles" href="/tabs/articles" ref="tabButtonArticles">
                    <ion-icon :icon="newspaperOutline" />
                    <ion-label>{{ $t('menu.articles') }}</ion-label>
                </ion-tab-button>

                <ion-tab-button tab="events" href="/tabs/events" ref="tabButtonEvents">
                    <ion-icon :icon="calendarOutline" />
                    <ion-label>{{ $t('menu.events') }}</ion-label>
                </ion-tab-button>

                <ion-tab-button tab="more" href="/tabs/more" ref="tabButtonMore">
                    <ion-icon :icon="appsOutline" />
                    <ion-label>{{ $t('menu.more') }}</ion-label>
                </ion-tab-button>
            </ion-tab-bar>
        </ion-tabs>
    </ion-page>
</template>

<script setup lang="ts">
import { IonTabBar, IonTabButton, IonTabs, IonLabel, IonIcon, IonPage, IonRouterOutlet } from '@ionic/vue';
import { newspaperOutline, calendarOutline, appsOutline } from 'ionicons/icons';
import { ref, nextTick } from 'vue';
import { useRouter } from 'vue-router';
import { App } from '@capacitor/app';
import { parseDeeplink } from '@/deeplinks';

const tabBar = ref();
const tabButtonArticles = ref();
const tabButtonEvents = ref();
const tabButtonMore = ref();
const router = useRouter();

const handleDeeplink = (url: string) => {
    // Wait for the next tick to make sure the tab bar is rendered.
    nextTick(() => {
        // Parse the deeplink
        const result = parseDeeplink(url);
        if(result) {
            // Check if the deeplink is for a different tab.
            const selectedTab = tabBar.value?.tabState?.activeTab;
            if(selectedTab !== result.tab) {
                // Switch to the correct tab.
                switch(result.tab) {
                    case 'article':
                        tabButtonArticles.value.$el.click();
                        break;
                    case 'event':
                        tabButtonEvents.value.$el.click();
                        break;
                    case 'more':
                        tabButtonMore.value.$el.click();
                        break;
                }
            }
            // Wait for the next tick to make sure the tab is rendered, then navigate to the deeplink.
            nextTick(() => {
                router.push(result.route);
            });
        }
    });
};

// Handle deeplinks when the app is opened from a deeplink.
App.getLaunchUrl().then((data) => {
    if(data) {
        handleDeeplink(data.url);
    }
});

// Handle deeplinks when the app is already open and a deeplink is opened.
App.addListener('appUrlOpen', (data) => {
    handleDeeplink(data.url);
});
</script>
