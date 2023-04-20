<script setup lang="ts">
import { IonPage, IonHeader, IonToolbar, IonTitle, IonContent } from '@ionic/vue';

defineProps({
    title: {
        type: String,
        required: true
    }
});
</script>

<template>
    <ion-page>
        <ion-header>
            <ion-toolbar color="primary">
                <slot name="toolbar-start" />
                <ion-title>
                    {{ title }}
                </ion-title>
                <slot name="toolbar-end" />
            </ion-toolbar>
        </ion-header>
        <ion-content>
            <slot />
        </ion-content>
    </ion-page>
</template>