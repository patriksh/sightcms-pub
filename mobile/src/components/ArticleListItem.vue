<script setup lang="ts">
import { IonCard, IonChip, IonCardHeader, IonCardTitle, IonCardSubtitle, IonCardContent, IonSkeletonText } from '@ionic/vue';
import { useRouter } from 'vue-router';
import { Article } from '@/types/article';
import { dateToLocaleString } from '@/utils/date';

const props = defineProps({
    article: {
        type: Object as () => Article
    }
});

const router = useRouter();
const openArticle = () => props.article ? router.push({ name: 'tabs.articles.show', params: { slug: props.article.slug }}) : null;
</script>

<template>
    <ion-card v-if="article" @click="openArticle">
        <img v-if="article.image_url" :src="article.image_url" class="img" />
        <ion-chip v-if="article.article_category" class="category">
            {{ article.article_category.name }}
        </ion-chip>
        <ion-card-header>
            <ion-card-title>
                {{ article.title }}
            </ion-card-title>
        </ion-card-header>

        <ion-card-content>
            <div class="summary">
                {{ article.summary }}
            </div>
            {{ dateToLocaleString(new Date(article.published_at)) }}
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
            <ion-skeleton-text />
            <ion-skeleton-text />
            <ion-skeleton-text />
            <ion-card-subtitle>
                <ion-skeleton-text style="width: 130px" />
            </ion-card-subtitle>
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

    .summary {
        margin-bottom: 12px;
    }
}
</style>