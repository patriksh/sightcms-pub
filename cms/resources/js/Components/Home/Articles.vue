<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import { storageUrl } from '@/Helpers/misc';
import { formatIsoDate } from '@/Helpers/date';

defineProps({
    data: {
        type: Object,
        default() {
            return {
                title: '',
                subtitle: '',
                articles: []
            }
        }
    }
});
</script>

<template>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8">
                <h2 class="mb-4 text-3xl lg:text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                    {{ data.title }}
                </h2>
                <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">
                    {{ data.subtitle }}
                </p>
            </div> 
            <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                <article v-for="article in data.articles" :key="article._id" class="bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                    <Link :href="route('articles.show', { slug: article.slug })">
                        <img v-if="article.image" :src="storageUrl(article.image)" class="rounded-t-lg aspect-square object-cover">
                    </Link>
                    <div class="p-5">
                        <Link :href="route('articles.show', { slug: article.slug })">
                            <h5 class="mb-2 text-m font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ article.title }}
                            </h5>
                        </Link>
                        <p class="mb-3 text-xs font-normal text-gray-700 dark:text-gray-400">
                            {{ formatIsoDate(article.published_at) }}
                        </p>
                    </div>
                </article>
            </div>  
        </div>
    </section>
</template>