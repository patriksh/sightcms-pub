<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { onIonViewWillEnter, toastController, IonCardTitle, IonCardContent, IonButtons, IonBackButton, IonButton, IonIcon } from '@ionic/vue';
import { shareSocialOutline } from 'ionicons/icons';
import to from 'await-to-js';
import { useI18n } from 'vue-i18n';
import { Share } from '@capacitor/share';
import { AudioTour } from '@/types/audioTour';
import { getAudioTour } from '@/http/audioTour';
import TabPageLayout from '@/layouts/TabPageLayout.vue';

const { t } = useI18n();
const route = useRoute();

const audioTourSlug = ref<string>(route.params.slug as string);
const audioTour = ref<AudioTour|null>();
const audioTourLoading = ref(false); // Used for showing skeleton loaders.
const canShare = ref(false);

// Fetch the audioTour from the backend.
const fetchAudioTour = async () => {
    audioTourLoading.value = true;
    const [error, audioTourResponse] = await to(getAudioTour(audioTourSlug.value));
    audioTourLoading.value = false;

    if(error) {
        audioTour.value = null;
        toastController.create({
            message: t('audio_tour_page.failed_to_load'),
            duration: 2000,
            color: 'danger',
        }).then(toast => toast.present());
    } else {
        audioTour.value = audioTourResponse.audioTour;
    }
};

const audioTourMime = computed(() => {
    if(!audioTour.value || !audioTour.value.file_url) return '';
    return audioTour.value.file_url.split('.').pop() === 'mp3' ? 'audio/mpeg' : 'audio/wav';
});

const audioTourDownloadName = computed(() => {
    if(!audioTour.value || !audioTour.value.file_url) return '';
    // encode the title to remove spaces and special characters as URL
    return `tour-${encodeURIComponent(audioTour.value.title)}.${audioTour.value.file_url.split('.').pop()}`;
});

// Check is navigator.share available.
const checkCanShare = async () => {
    canShare.value = (await Share.canShare()).value;
};

// Share the audioTour.
const share = async () => {
    if(!audioTour.value) return;

    await Share.share({
        title: audioTour.value.title,
        url: audioTour.value.url || '',
        dialogTitle: t('share_with_friends'),
    });
}

onMounted(() => {
    checkCanShare();
});

// Fetch the audioTour each time the page is visited, since Ionic caches views so onMounted isn't called every time.
onIonViewWillEnter(() => {
    audioTourSlug.value = route.params.slug as string;
    fetchAudioTour();
});
</script>

<template>
    <TabPageLayout :title="audioTour?.title || $t('audio_tour_page.audio_tour')">
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
        <div v-if="audioTour">
            <img v-if="audioTour.image_url" :src="audioTour.image_url" />
            <div class="container">
                <ion-card-title>{{ audioTour.title }}</ion-card-title>
                <div class="separator" />
                <ion-card-content>
                    <audio controls>
                        <source :src="audioTour.file_url" :type="audioTourMime" />
                        {{ $t('your_browser_does_not_support_the_audio_tag') }}
                    </audio>
                    <div class="content" v-html="audioTour.content" />
                </ion-card-content>
                <div class="separator" />
                <ion-card-content class="buttons">
                    <ion-button v-if="audioTour.file_url" :href="audioTour.file_url" :download="audioTourDownloadName" fill="outline" expand="block">
                        {{ $t('download') }}
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

        audio {
            width: 100%;
            margin-bottom: 12px;
        }

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