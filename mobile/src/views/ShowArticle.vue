<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { onIonViewWillEnter, toastController, IonCardTitle, IonCardSubtitle, IonCardContent, IonButtons, IonBackButton, IonButton, IonIcon } from '@ionic/vue';
import { shareSocialOutline } from 'ionicons/icons';
import to from 'await-to-js';
import { Share } from '@capacitor/share';
import { useI18n } from 'vue-i18n';
import { Article } from '@/types/article';
import { getArticle } from '@/http/article';
import { dateToLocaleString } from '@/utils/date';
import TabPageLayout from '@/layouts/TabPageLayout.vue';

const route = useRoute();
const { t } = useI18n();

const articleSlug = ref<string>(route.params.slug as string);
const article = ref<Article|null>();
const articleLoading = ref(false); // Used for showing skeleton loaders.
const canShare = ref(false);

// Fetch the article from the backend.
const fetchArticle = async () => {
    articleLoading.value = true;
    const [error, articleResponse] = await to(getArticle(articleSlug.value));
    articleLoading.value = false;

    if(error) {
        article.value = null;
        toastController.create({
            message: t('article_page.failed_to_load'),
            duration: 2000,
            color: 'danger',
        }).then(toast => toast.present());
    } else {
        article.value = articleResponse.article;
    }
};

// Check is navigator.share available.
const checkCanShare = async () => {
    canShare.value = (await Share.canShare()).value;
};

// Share the article.
const share = async () => {
    if(!article.value) return;

    await Share.share({
        title: article.value.title,
        text: article.value.summary,
        url: article.value.url || '',
        dialogTitle: t('share_with_friends'),
    });
}

onMounted(() => {
    checkCanShare();
});

// Fetch the article each time the page is visited, since Ionic caches views so onMounted isn't called every time.
onIonViewWillEnter(() => {
    articleSlug.value = route.params.slug as string;
    fetchArticle();
});
</script>

<template>
    <TabPageLayout :title="article?.title || t('article_page.article')">
        <template #toolbar-start>
            <ion-buttons slot="start">
                <ion-back-button default-href="/" />
            </ion-buttons>
        </template>
        <template v-if="canShare" #toolbar-end>
            <ion-buttons slot="end">
                <ion-button @click="share">
                    <ion-icon :icon="shareSocialOutline" />
                </ion-button>
            </ion-buttons>
        </template>
        <div v-if="article">
            <img v-if="article.image_url" :src="article.image_url" />
            <div class="container">
                <ion-card-title>{{ article.title }}</ion-card-title>
                <ion-card-subtitle>{{ dateToLocaleString(new Date(article.published_at)) }}</ion-card-subtitle>
                <div class="separator" />
                <ion-card-content>
                    <div class="content" v-html="article.content" />
                </ion-card-content>
            </div>
        </div>
    </TabPageLayout>
</template>

<style scoped lang="scss">
.container {
    padding: 16px;

    ion-card-title {
        margin-bottom: 8px;
    }

    ion-card-content {
        padding: 0;

        .content {
            ::v-deep img {
                height: auto;
            }
        }
    }
}

.separator {
    margin: 12px 0;
}
</style>