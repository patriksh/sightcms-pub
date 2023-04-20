<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { toastController, IonInfiniteScroll, IonInfiniteScrollContent, InfiniteScrollCustomEvent } from '@ionic/vue';
import to from 'await-to-js';
import { useI18n } from 'vue-i18n';
import { ArticleCategory, Article } from '@/types/article';
import { getArticleCategories, getArticles } from '@/http/article';
import TabPageLayout from '@/layouts/TabPageLayout.vue';
import CategoryChips from '@/components/CategoryChips.vue';
import ArticleList from '@/components/ArticleList.vue';

const route = useRoute();
const { t } = useI18n();

const articleCategories = ref<ArticleCategory[]>([]);
const categoriesLoading = ref(false);
const articles = ref<Article[]>([]);
const articlesLoading = ref(false); // Used for showing skeleton loaders.
const articleCategorySlug = ref<string | undefined>();
const articlePage = ref(0);
const articleTotal = ref(0);

// Fetch all article categories from the backend.
const fetchCategories = async () => {
    categoriesLoading.value = true;
    const [error, categoryResponse] = await to(getArticleCategories());
    categoriesLoading.value = false;

    if(error) {
        articleCategories.value = [];
    } else {
        articleCategories.value = categoryResponse.categories;
    }
};

// Fetch articles from the backend.
const fetchArticles = async () => {
    articlesLoading.value = true;
    const [error, articleResponse] = await to(getArticles(articleCategorySlug.value));
    articlesLoading.value = false;

    if(error) {
        articles.value = [];
    } else {
        articles.value = articleResponse.articles.data;
        articlePage.value = articleResponse.articles.current_page;
        articleTotal.value = articleResponse.articles.total;
    }
};

// Refetch articles when the category changes.
const onChangeCategory = async (slug?: string) => {
    articleCategorySlug.value = slug || undefined;
    fetchArticles();
};

// Fetch more articles when the user scrolls to the bottom of the page.
const onInfiniteScroll = async (e: InfiniteScrollCustomEvent) => {
    if(articles.value.length < articleTotal.value) {
        articlePage.value += 1;

        const [error, articleResponse] = await to(getArticles(articleCategorySlug.value, articlePage.value));

        if(error) {
            articlePage.value -= 1;
            return toastController.create({
                message: t('articles_page.failed_to_load'),
                duration: 2000,
                color: 'danger'
            }).then(toast => toast.present());
        } else {
            articles.value = [...articles.value, ...articleResponse.articles.data];
        }
    }

    e.target.complete();
};

onMounted(() => {
    // Apply the category from route params if it exists (for deeplinks).
    if(route.params.category) {
        articleCategorySlug.value = route.params.category as string;
    }

    fetchCategories();
    fetchArticles();
});
</script>

<template>
    <TabPageLayout :title="$t('articles_page.articles')">
        <CategoryChips :categories="articleCategories" :active-slug="articleCategorySlug" :loading="categoriesLoading" @change="onChangeCategory" />
        <div class="separator" />
        <ArticleList :articles="articles" :loading="articlesLoading" />
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