<script setup lang="ts">
import { IonCard, IonChip, IonCardHeader, IonCardTitle, IonSkeletonText } from '@ionic/vue';
import { useRouter } from 'vue-router';
import { AudioTour } from '@/types/audioTour';

const props = defineProps({
    audioTour: {
        type: Object as () => AudioTour
    }
});

const router = useRouter();
const openAudioTour = () => props.audioTour ? router.push({ name: 'tabs.more.audio-tours.show', params: { slug: props.audioTour.slug }}) : null;
</script>

<template>
    <ion-card v-if="audioTour" @click="openAudioTour">
        <img v-if="audioTour.image_url" :src="audioTour.image_url" class="img" />
        <ion-chip class="category">
            {{ audioTour.duration }}
        </ion-chip>
        <ion-card-header>
            <ion-card-title>
                {{ audioTour.title }}
            </ion-card-title>
        </ion-card-header>
    </ion-card>
    <!-- skeleton -->
    <ion-card v-else>
        <div class="img" style="height: 200px; background: var(--ion-color-light);" />
        <ion-chip class="category skeleton">
            <ion-skeleton-text style="width: 50px" />
        </ion-chip>
        <ion-card-header>
            <ion-card-title>
                <ion-skeleton-text style="height: 36px" animated />
            </ion-card-title>
        </ion-card-header>
    </ion-card>
</template>

<style scoped lang="scss">
ion-card {
    position: relative;

    .category {
        position: absolute;
        top: 8px;
        right: 8px;
        background-color: #222428; // var(--ion-color-dark);
        color: #ffffff; // var(--ion-color-dark-contrast);

        &.skeleton {
            background-color: var(--ion-color-light);
        }
    }

    // Extra padding for category chip if there's no image.
    &:not(&:has(.img)) {
        ion-card-header {
            padding-top: 54px;
        }
    }
}
</style>