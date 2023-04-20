<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import { storageUrl } from '@/Helpers/misc';
import { formatIsoDate } from '@/Helpers/date';
import PageTitle from '@/Components/PageTitle.vue';
import CategorySidebar from '@/Components/CategorySidebar.vue';
import Pagination from '@/Components/Pagination.vue';

defineProps({
    articles: Object,
    allCategories: Array,
    currentCategory: Object
});
</script>

<template>
    <HeadMeta title="Articles" />

    <Layout>
        <section class="p-4 py-6 mx-auto max-w-screen-xl md:p-8 lg:p-10">
            <PageTitle>Articles</PageTitle>

            <div class="grid gap-8 md:grid-cols-3 lg:grid-cols-4">
                <div class="md:col-span-1">
                    <CategorySidebar :categories="allCategories" :selected="currentCategory?._id" route-name="articles.category" />
                </div>
                <hr class="block md:hidden">
                <div class="md:col-span-2 lg:col-span-3">
                    <div class="w-full grid gap-4">
                        <article v-for="article in articles.data" :key="article._id" class="flex flex-col items-center bg-white border rounded-lg shadow-md sm:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <img v-if="article.image" :src="storageUrl(article.image)" class="object-cover aspect-square w-full rounded-t-lg h-96 sm:h-auto sm:w-48 sm:rounded-none sm:rounded-l-lg">
                            <div class="flex flex-col justify-between p-4 leading-normal">
                                <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    <Link :href="route('articles.show', { slug: article.slug })">
                                        {{ article.title }}
                                    </Link>
                                </h5>
                                <p class="mb-3 text-sm font-normal text-gray-700 dark:text-gray-400">
                                    <Link :href="route('articles.category', { slug: article.article_category.slug })" class="text-primary-700">
                                        {{ article.article_category.name }}
                                    </Link>
                                     - {{ formatIsoDate(article.published_at) }}
                                </p>
                                <p class="text-sm font-normal text-gray-700 dark:text-gray-400">
                                    <Link :href="route('articles.show', { slug: article.slug })">
                                        {{ article.summary }}
                                    </Link>
                                </p>
                            </div>
                        </article>
                        <Pagination :links="articles.links" />
                    </div>
                </div>
            </div>
        </section>
    </Layout>
</template>