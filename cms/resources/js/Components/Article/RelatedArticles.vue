<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import { storageUrl } from '@/Helpers/misc';
import { formatIsoDate } from '@/Helpers/date';

const props = defineProps({
    data: Object
});
</script>

<template>
    <section aria-label="Related articles" class="py-8 lg:py-24 bg-gray-50 dark:bg-gray-800">
        <div class="px-4 mx-auto max-w-screen-xl">
            <h2 class="mb-8 text-2xl font-bold text-gray-900 dark:text-white">Related articles</h2>
            <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">
                <article v-for="article in data" :key="article._id" class="max-w-xs">
                    <Link :href="route('articles.show', { slug: article.slug })">
                        <img v-if="article.image" :src="storageUrl(article.image)" class="mb-5 rounded-lg aspect-square object-cover">
                    </Link>
                    <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                        <Link :href="route('articles.show', { slug: article.slug })">
                            {{ article.title }}
                        </Link>
                    </h2>
                    <p class="mb-4 font-light text-gray-500 dark:text-gray-400">
                        {{ article.summary }}
                    </p>
                    <Link :href="route('articles.show', { slug: article.slug })" class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline">
                        Read more
                    </Link>
                </article>
            </div>
        </div>
    </section>
</template>