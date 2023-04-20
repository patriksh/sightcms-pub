<script setup lang="ts">
import { ref } from 'vue';
import { useRoute } from 'vue-router';
import { onIonViewWillEnter, toastController, IonCardTitle, IonCardContent, IonButtons, IonBackButton } from '@ionic/vue';
import to from 'await-to-js';
import { useI18n } from 'vue-i18n';
import { Page } from '@/types/page';
import { getPage } from '@/http/page';
import TabPageLayout from '@/layouts/TabPageLayout.vue';

const { t } = useI18n();
const route = useRoute();

const pageSlug = ref<string>(route.params.slug as string);
const page = ref<Page|null>();
const pageLoading = ref(false); // Used for showing skeleton loaders.

// Fetch the static page from the backend.
const fetchPage = async () => {
    pageLoading.value = true;
    const [error, pageResponse] = await to(getPage(pageSlug.value));
    pageLoading.value = false;

    if(error) {
        page.value = null;
        toastController.create({
            message: t('static_page.failed_to_load'),
            duration: 2000,
            color: 'danger',
        }).then(toast => toast.present());
    } else {
        page.value = pageResponse.page;
    }
};

// Fetch the static page each time the page is visited, since Ionic caches views so onMounted isn't called every time.
onIonViewWillEnter(() => {
    pageSlug.value = route.params.slug as string;
    fetchPage();
});
</script>

<template>
    <TabPageLayout :title="page?.title || t('static_page.page')">
        <template #toolbar-start>
            <ion-buttons slot="start">
                <ion-back-button default-href="/" />
            </ion-buttons>
        </template>
        <div v-if="page">
            <div class="container">
                <ion-card-title>{{ page.title }}</ion-card-title>
                <div class="separator" />
                <ion-card-content>
                    <div class="content" v-html="page.content" />
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