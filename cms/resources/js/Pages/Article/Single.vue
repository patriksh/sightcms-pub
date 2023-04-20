<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import { storageUrl } from '@/Helpers/misc';
import { formatIsoDate } from '@/Helpers/date';
import RelatedArticles from '@/Components/Article/RelatedArticles.vue';
// import Newsletter from '@/Components/Newsletter.vue';
import Share from '@/Components/Share.vue';

defineProps({
    article: Object,
    relatedArticles: Object
});
</script>

<template>
    <HeadMeta :title="`${article.title} - ${article.article_category.name}`" />
    
    <Layout>
        <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900">
            <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
                <article class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                    <header class="mb-4 lg:mb-6 not-format">
                        <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">
                            {{ article.title }}
                        </h1>
                        <p class="text-base font-light text-gray-500 dark:text-gray-400">
                            {{ formatIsoDate(article.published_at) }}
                        </p>
                    </header>
                    <img v-if="article.image" :src="storageUrl(article.image)" class="rounded-xl">
                    <div class="max-w-full format format-sm sm:format-base lg:format-lg format-blue dark:format-invert" v-html="article.content"></div>
                    <hr>
                    <div class="flex justify-between">
                        <Link class="text-base font-light text-gray-500 dark:text-gray-400" :href="route('articles.category', { slug: article.article_category.slug })">
                            {{ article.article_category.name }}
                        </Link>
                        <Share :small="true" />
                    </div>
                </article>
            </div>
        </main>

        <RelatedArticles :data="relatedArticles" />
        <!-- TODO: <Newsletter />-->
    </Layout>
</template>