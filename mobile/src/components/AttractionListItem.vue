<script setup lang="ts">
import { IonCard, IonChip, IonCardHeader, IonCardTitle, IonCardContent, IonSkeletonText } from '@ionic/vue';
import { useRouter } from 'vue-router';
import { Attraction } from '@/types/attraction';

const props = defineProps({
    attraction: {
        type: Object as () => Attraction
    }
});

const router = useRouter();
const openAttraction = () => props.attraction ? router.push({ name: 'tabs.more.attractions.show', params: { slug: props.attraction.slug }}) : null;
</script>

<template>
    <ion-card v-if="attraction" @click="openAttraction">
        <img v-if="attraction.image_url" :src="attraction.image_url" class="img" />
        <ion-chip v-if="attraction.attraction_category" class="category">
            {{ attraction.attraction_category.name }}
        </ion-chip>
        <ion-card-header>
            <ion-card-title>
                {{ attraction.name }}
            </ion-card-title>
        </ion-card-header>

        <ion-card-content>
            {{ attraction.location }}
        </ion-card-content>
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

        <ion-card-content>
            <ion-skeleton-text style="width: 180px" />
        </ion-card-content>
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