<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { IonCard, IonCardHeader, IonCardTitle, IonIcon } from '@ionic/vue';
import { documentOutline, headsetOutline, planetOutline, restaurantOutline } from 'ionicons/icons';
import to from 'await-to-js';
import { useI18n } from 'vue-i18n';
import { Page } from '@/types/page';
import { getPages } from '@/http/page';
import TabPageLayout from '@/layouts/TabPageLayout.vue';
import PageList from '@/components/PageList.vue';

const { t } = useI18n();

// List of built-in page menu items.
const appPages = [
    {
        title: t('more_page.documents'),
        route: 'tabs.more.documents',
        icon: documentOutline
    },
    {
        title: t('more_page.attractions'),
        route: 'tabs.more.attractions',
        icon: planetOutline
    },
    {
        title: t('more_page.gastronomy'),
        route: 'tabs.more.gastronomy',
        icon: restaurantOutline
    },
    {
        title: t('more_page.audio_tours'),
        route: 'tabs.more.audio-tours',
        icon: headsetOutline
    }
];

const staticPages = ref<Page[]>([]);
const pagesLoading = ref(false);

// Fetch list of static pages from the backend.
const fetchPages = async () => {
    pagesLoading.value = true;
    const [error, pagesResponse] = await to(getPages());
    pagesLoading.value = false;

    if(error) {
        staticPages.value = [];
    } else {
        staticPages.value = pagesResponse.pages;
    }
};

onMounted(() => {
    fetchPages();
});
</script>

<template>
    <TabPageLayout :title="$t('more_page.more')">
        <ion-card v-for="(page, index) in appPages" :key="index" @click="$router.push({ name: page.route })">
            <ion-card-header>
                <ion-card-title>
                    <ion-icon :icon="page.icon" />
                    {{ page.title }}
                </ion-card-title>
            </ion-card-header>
        </ion-card>
        <div class="static-pages">
            <PageList :pages="staticPages" :loading="pagesLoading" />
        </div>
    </TabPageLayout>
</template>

<style scoped lang="scss">
ion-card, .static-pages ::v-deep ion-card {
    ion-card-title {
        display: flex;
        align-items: center;
        gap: 8px;

        ion-icon {
            width: 24px;
        }
    }
}
</style>