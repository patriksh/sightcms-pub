<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { onIonViewWillEnter, toastController, IonCardTitle, IonCardSubtitle, IonCardContent, IonButtons, IonBackButton, IonButton, IonIcon } from '@ionic/vue';
import { shareSocialOutline } from 'ionicons/icons';
import to from 'await-to-js';
import { useI18n } from 'vue-i18n';
import { Share } from '@capacitor/share';
import { Attraction } from '@/types/attraction';
import { getAttraction } from '@/http/attraction';
import TabPageLayout from '@/layouts/TabPageLayout.vue';

const { t } = useI18n();
const route = useRoute();

const attractionSlug = ref<string>(route.params.slug as string);
const attraction = ref<Attraction|null>();
const attractionLoading = ref(false); // Used for showing skeleton loaders.
const canShare = ref(false);

// Fetch the attraction from the backend.
const fetchAttraction = async () => {
    attractionLoading.value = true;
    const [error, attractionResponse] = await to(getAttraction(attractionSlug.value));
    attractionLoading.value = false;

    if(error) {
        attraction.value = null;
        toastController.create({
            message: t('attraction_page.failed_to_load'),
            duration: 2000,
            color: 'danger',
        }).then(toast => toast.present());
    } else {
        attraction.value = attractionResponse.attraction;
    }
};

// Check is navigator.share available.
const checkCanShare = async () => {
    canShare.value = (await Share.canShare()).value;
};

// Share the attraction.
const share = async () => {
    if(!attraction.value) return;

    await Share.share({
        title: attraction.value.name,
        url: attraction.value.url || '',
        dialogTitle: t('share_with_friends'),
    });
}

onMounted(() => {
    checkCanShare();
});

// Fetch the attraction each time the page is visited, since Ionic caches views so onMounted isn't called every time.
onIonViewWillEnter(() => {
    attractionSlug.value = route.params.slug as string;
    fetchAttraction();
});
</script>

<template>
    <TabPageLayout :title="attraction?.name || $t('attraction_page.attraction')">
        <template #toolbar-start>
            <ion-buttons slot="start">
                <ion-back-button default-href="/" />
            </ion-buttons>
        </template>
        <template v-if="canShare" #toolbar-end>
            <ion-buttons slot="end">
                <ion-button @click="share">
                    <ion-icon :icon="shareSocialOutline" />
                </ion-button>
            </ion-buttons>
        </template>
        <div v-if="attraction">
            <img v-if="attraction.image_url" :src="attraction.image_url" />
            <div class="container">
                <ion-card-title>{{ attraction.name }}</ion-card-title>
                <ion-card-subtitle>{{ attraction.location }}</ion-card-subtitle>
                <div class="separator" />
                <ion-card-content>
                    <div class="content" v-html="attraction.content" />
                </ion-card-content>
                <div class="separator" />
                <ion-card-content class="buttons">
                    <ion-button :href="`https://www.google.com/maps/dir/${encodeURIComponent(attraction.location)}`" target="_blank" fill="outline" expand="block">
                        {{ $t('get_directions') }}
                    </ion-button>
                    <ion-button v-if="attraction.website_link" :href="attraction.website_link" target="_blank" fill="outline" expand="block">
                        {{ $t('view_website') }}
                    </ion-button>
                </ion-card-content>
            </div>
        </div>
    </TabPageLayout>
</template>

<style scoped lang="scss">
.container {
    padding: 16px;

    ion-card-title {
        margin-bottom: 8px;
    }

    ion-card-content {
        padding: 0;

        .content {
            ::v-deep img {
                height: auto;
            }
        }
    }

    .buttons {
        display: flex;
        gap: 8px;

        ion-button {
            flex: 1;
        }
    }
}

.separator {
    margin: 12px 0;
}
</style>