<script setup lang="ts">
import { Category } from '@/types/category';
import { IonChip, IonIcon, IonSkeletonText } from '@ionic/vue';
import { closeOutline } from 'ionicons/icons';

defineProps({
    categories: {
        type: Array as () => Category[]
    },
    activeSlug: {
        type: String,
        required: false
    },
    loading: {
        type: Boolean,
        default: false
    }
});

defineEmits(['change']);
</script>

<template>
    <div class="chips">
        <template v-if="categories && categories.length > 0">
            <ion-chip v-for="category in categories" :key="category.slug" :color="category.slug === activeSlug ? 'primary' : ''">
                <ion-icon v-if="category.slug === activeSlug" :icon="closeOutline" @click="$emit('change', undefined)" />
                <span @click="$emit('change', category.slug)">{{ category.name }}</span>
            </ion-chip>
        </template>
        <!-- skeleton -->
        <template v-else-if="loading">
            <ion-chip v-for="index in 3" :key="index" class="skeleton">
                <ion-skeleton-text style="width: 50px" animated />
            </ion-chip>
        </template>
    </div>
</template>

<style scoped lang="scss">
.chips {
    margin-inline: 10px;
    margin-top: 10px;
    overflow-x: auto;
    overflow-y: hidden;
    white-space: nowrap;
}
</style>