<script setup lang="ts">
import { IonCard, IonCardHeader, IonCardTitle, IonIcon, IonSkeletonText } from '@ionic/vue';
import { receiptOutline } from 'ionicons/icons';
import { useRouter } from 'vue-router';
import { Page } from '@/types/page';

const props = defineProps({
    page: {
        type: Object as () => Page
    }
});

const router = useRouter();
const openPage = () => props.page ? router.push({ name: 'tabs.more.page.show', params: { slug: props.page.slug }}) : null;
</script>

<template>
    <ion-card v-if="page" @click="openPage">
        <ion-card-header>
            <ion-card-title>
                <ion-icon :icon="receiptOutline" />
                {{ page.title }}
            </ion-card-title>
        </ion-card-header>
    </ion-card>
    <!-- skeleton -->
    <ion-card v-else>
        <ion-card-header>
            <ion-card-title>
                <ion-skeleton-text animated />
            </ion-card-title>
        </ion-card-header>
    </ion-card>
</template>