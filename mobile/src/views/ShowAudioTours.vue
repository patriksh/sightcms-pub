<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { toastController, IonInfiniteScroll, IonInfiniteScrollContent, InfiniteScrollCustomEvent, IonButtons, IonBackButton } from '@ionic/vue';
import to from 'await-to-js';
import { useI18n } from 'vue-i18n';
import { AudioTour } from '@/types/audioTour';
import { getAudioTours } from '@/http/audioTour';
import TabPageLayout from '@/layouts/TabPageLayout.vue';
import AudioTourList from '@/components/AudioTourList.vue';

const { t } = useI18n();

const audioTours = ref<AudioTour[]>([]);
const audioToursLoading = ref(false); // Used for showing skeleton loaders.
const audioTourPage = ref(0);
const audioTourTotal = ref(0);

// Fetch audioTours from the backend.
const fetchAudioTours = async () => {
    audioToursLoading.value = true;
    const [error, audioTourResponse] = await to(getAudioTours());
    audioToursLoading.value = false;

    if(error) {
        audioTours.value = [];
    } else {
        audioTours.value = audioTourResponse.audioTours.data;
        audioTourPage.value = audioTourResponse.audioTours.current_page;
        audioTourTotal.value = audioTourResponse.audioTours.total;
    }
};

// Fetch more audioTours when the user scrolls to the bottom of the page.
const onInfiniteScroll = async (e: InfiniteScrollCustomEvent) => {
    if(audioTours.value.length < audioTourTotal.value) {
        audioTourPage.value += 1;

        const [error, audioTourResponse] = await to(getAudioTours(audioTourPage.value));

        if(error) {
            audioTourPage.value -= 1;
            return toastController.create({
                message: t('audio_tours_page.failed_to_load'),
                duration: 2000,
                color: 'danger'
            }).then(toast => toast.present());
        } else {
            audioTours.value = [...audioTours.value, ...audioTourResponse.audioTours.data];
        }
    }

    e.target.complete();
};

onMounted(() => fetchAudioTours());
</script>

<template>
    <TabPageLayout :title="t('audio_tours_page.audio_tours')">
        <template #toolbar-start>
            <ion-buttons slot="start">
                <ion-back-button default-href="/" />
            </ion-buttons>
        </template>
        <AudioTourList :audioTours="audioTours" :loading="audioToursLoading" />
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