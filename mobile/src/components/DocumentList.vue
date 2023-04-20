<script setup lang="ts">
import { IonList } from '@ionic/vue';
import { Document } from '@/types/document';
import DocumentListItem from '@/components/DocumentListItem.vue';

defineProps({
    documents: {
        type: Array as () => Document[],
        required: true
    },
    loading: {
        type: Boolean,
        default: false
    }
});
</script>

<template>
    <ion-list>
        <template v-if="!loading">
            <DocumentListItem v-for="document in documents" :key="document._id" :document="document" />
        </template>
        <template v-else>
            <DocumentListItem v-for="index in 12" :key="index" />
        </template>
    </ion-list>
</template>