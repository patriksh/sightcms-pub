<script setup lang="ts">
import { IonCard, IonChip, IonCardHeader, IonCardTitle, IonCardContent, IonSkeletonText } from '@ionic/vue';
import { useRouter } from 'vue-router';
import { Gastro } from '@/types/gastro';

const props = defineProps({
    gastro: {
        type: Object as () => Gastro
    }
});

const router = useRouter();
const openGastro = () => props.gastro ? router.push({ name: 'tabs.more.gastronomy.show', params: { slug: props.gastro.slug }}) : null;
</script>

<template>
    <ion-card v-if="gastro" @click="openGastro">
        <img v-if="gastro.image_url" :src="gastro.image_url" class="img" />
        <ion-chip v-if="gastro.gastro_category" class="category">
            {{ gastro.gastro_category.name }}
        </ion-chip>
        <ion-card-header>
            <ion-card-title>
                {{ gastro.name }}
            </ion-card-title>
        </ion-card-header>

        <ion-card-content>
            {{ gastro.location }}
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