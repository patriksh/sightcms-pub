<script setup lang="ts">
import { IonItem, IonIcon, IonLabel, IonSkeletonText } from '@ionic/vue';
import { documentOutline } from 'ionicons/icons';
import { Browser } from '@capacitor/browser';
import { Document } from '@/types/document';

const props = defineProps({
    document: {
        type: Object as () => Document
    }
});

const openDocument = () => props.document && props.document.file_url ? Browser.open({ url: props.document.file_url }) : null;
</script>

<template>
    <ion-item v-if="document" @click="openDocument">
        <ion-icon slot="start" :icon="documentOutline" />
        <ion-label>{{ document.name }}</ion-label>
    </ion-item>
    <!-- skeleton -->
    <ion-item v-else>
        <ion-icon slot="start" :icon="documentOutline" />
        <ion-label>
            <ion-skeleton-text animated />
        </ion-label>
    </ion-item>
</template>