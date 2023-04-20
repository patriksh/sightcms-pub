<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { toastController, IonInfiniteScroll, IonInfiniteScrollContent, InfiniteScrollCustomEvent, IonButtons, IonBackButton } from '@ionic/vue';
import to from 'await-to-js';
import { useI18n } from 'vue-i18n';
import { GastroCategory, Gastro } from '@/types/gastro';
import { getGastroCategories, getGastros } from '@/http/gastro';
import TabPageLayout from '@/layouts/TabPageLayout.vue';
import CategoryChips from '@/components/CategoryChips.vue';
import GastroList from '@/components/GastroList.vue';

const route = useRoute();
const { t } = useI18n();

const gastroCategories = ref<GastroCategory[]>([]);
const categoriesLoading = ref(false);
const gastros = ref<Gastro[]>([]);
const gastrosLoading = ref(false); // Used for showing skeleton loaders.
const gastroCategorySlug = ref<string | undefined>();
const gastroPage = ref(0);
const gastroTotal = ref(0);

// Fetch all gastro categories from the backend.
const fetchCategories = async () => {
    categoriesLoading.value = true;
    const [error, categoryResponse] = await to(getGastroCategories());
    categoriesLoading.value = false;

    if(error) {
        gastroCategories.value = [];
    } else {
        gastroCategories.value = categoryResponse.categories;
    }
};

// Fetch gastros from the backend.
const fetchGastros = async () => {
    gastrosLoading.value = true;
    const [error, gastroResponse] = await to(getGastros(gastroCategorySlug.value));
    gastrosLoading.value = false;

    if(error) {
        gastros.value = [];
    } else {
        gastros.value = gastroResponse.gastros.data;
        gastroPage.value = gastroResponse.gastros.current_page;
        gastroTotal.value = gastroResponse.gastros.total;
    }
};

// Refetch gastros when the category changes.
const onChangeCategory = async (slug?: string) => {
    gastroCategorySlug.value = slug || undefined;
    fetchGastros();
};

// Fetch more gastros when the user scrolls to the bottom of the page.
const onInfiniteScroll = async (e: InfiniteScrollCustomEvent) => {
    if(gastros.value.length < gastroTotal.value) {
        gastroPage.value += 1;

        const [error, gastroResponse] = await to(getGastros(gastroCategorySlug.value, gastroPage.value));

        if(error) {
            gastroPage.value -= 1;
            return toastController.create({
                message: t('gastros_page.failed_to_load'),
                duration: 2000,
                color: 'danger'
            }).then(toast => toast.present());
        } else {
            gastros.value = [...gastros.value, ...gastroResponse.gastros.data];
        }
    }

    e.target.complete();
};

onMounted(() => {
    // Apply the category from route params if it exists (for deeplinks).
    if(route.params.category) {
        gastroCategorySlug.value = route.params.category as string;
    }

    fetchCategories();
    fetchGastros();
});
</script>

<template>
    <TabPageLayout :title="t('gastros_page.gastronomy')">
        <template #toolbar-start>
            <ion-buttons slot="start">
                <ion-back-button default-href="/" />
            </ion-buttons>
        </template>
        <CategoryChips :categories="gastroCategories" :active-slug="gastroCategorySlug" :loading="categoriesLoading" @change="onChangeCategory" />
        <div class="separator" />
        <GastroList :gastros="gastros" :loading="gastrosLoading" />
        <ion-infinite-scroll @ionInfinite="onInfiniteScroll">
            <ion-infinite-scroll-content></ion-infinite-scroll-content>
        </ion-infinite-scroll>
    </TabPageLayout>
</template>

<style scoped lang="scss">
.separator {
    margin: 12px 10px 18px 10px;
}

.ios {
    .separator {
        margin: 16px;
    }
}
</style>