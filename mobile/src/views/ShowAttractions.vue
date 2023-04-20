<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { toastController, IonInfiniteScroll, IonInfiniteScrollContent, InfiniteScrollCustomEvent, IonButtons, IonBackButton } from '@ionic/vue';
import to from 'await-to-js';
import { useI18n } from 'vue-i18n';
import { AttractionCategory, Attraction } from '@/types/attraction';
import { getAttractionCategories, getAttractions } from '@/http/attraction';
import TabPageLayout from '@/layouts/TabPageLayout.vue';
import CategoryChips from '@/components/CategoryChips.vue';
import AttractionList from '@/components/AttractionList.vue';

const route = useRoute();
const { t } = useI18n();

const attractionCategories = ref<AttractionCategory[]>([]);
const categoriesLoading = ref(false);
const attractions = ref<Attraction[]>([]);
const attractionsLoading = ref(false); // Used for showing skeleton loaders.
const attractionCategorySlug = ref<string | undefined>();
const attractionPage = ref(0);
const attractionTotal = ref(0);

// Fetch all attraction categories from the backend.
const fetchCategories = async () => {
    categoriesLoading.value = true;
    const [error, categoryResponse] = await to(getAttractionCategories());
    categoriesLoading.value = false;

    if(error) {
        attractionCategories.value = [];
    } else {
        attractionCategories.value = categoryResponse.categories;
    }
};

// Fetch attractions from the backend.
const fetchAttractions = async () => {
    attractionsLoading.value = true;
    const [error, attractionResponse] = await to(getAttractions(attractionCategorySlug.value));
    attractionsLoading.value = false;

    if(error) {
        attractions.value = [];
    } else {
        attractions.value = attractionResponse.attractions.data;
        attractionPage.value = attractionResponse.attractions.current_page;
        attractionTotal.value = attractionResponse.attractions.total;
    }
};

// Refetch attractions when the category changes.
const onChangeCategory = async (slug?: string) => {
    attractionCategorySlug.value = slug || undefined;
    fetchAttractions();
};

// Fetch more attractions when the user scrolls to the bottom of the page.
const onInfiniteScroll = async (e: InfiniteScrollCustomEvent) => {
    if(attractions.value.length < attractionTotal.value) {
        attractionPage.value += 1;

        const [error, attractionResponse] = await to(getAttractions(attractionCategorySlug.value, attractionPage.value));

        if(error) {
            attractionPage.value -= 1;
            return toastController.create({
                message: t('attractions_page.failed_to_load'),
                duration: 2000,
                color: 'danger'
            }).then(toast => toast.present());
        } else {
            attractions.value = [...attractions.value, ...attractionResponse.attractions.data];
        }
    }

    e.target.complete();
};

onMounted(() => {
    // Apply the category from route params if it exists (for deeplinks).
    if(route.params.category) {
        attractionCategorySlug.value = route.params.category as string;
    }

    fetchCategories();
    fetchAttractions();
});
</script>

<template>
    <TabPageLayout :title="t('attractions_page.attractions')">
        <template #toolbar-start>
            <ion-buttons slot="start">
                <ion-back-button default-href="/" />
            </ion-buttons>
        </template>
        <CategoryChips :categories="attractionCategories" :active-slug="attractionCategorySlug" :loading="categoriesLoading" @change="onChangeCategory" />
        <div class="separator" />
        <AttractionList :attractions="attractions" :loading="attractionsLoading" />
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