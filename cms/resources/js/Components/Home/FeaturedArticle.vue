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
                article: {}
            }
        }
    },
    articles: Object
});
</script>

<template>
    <section class="p-4 bg-white dark:bg-gray-900 md:p-10 lg:p-20">
        <div class="bg-gray-800 rounded-lg flex flex-col items-center gap-4 p-4 mx-auto max-w-screen-xl sm:flex-row sm:gap-8 xl:gap-16 lg:p-10">
            <img v-if="data.article?.image" class="object-cover aspect-square rounded-xl sm:max-w-[35%]" :src="storageUrl(data.article.image)">
            <div class="mt-4 md:mt-0">
                <h2 class="mb-4 text-3xl tracking-tight font-extrabold text-white lg:text-4xl">
                    {{ data.article?.title }}
                </h2>
                <p class="mb-4 font-normal text-gray-300 md:text-lg">
                    {{ formatIsoDate(data.article?.published_at) }}
                </p>
                <p class="mb-6 font-light text-gray-400 md:text-lg">
                    {{ data.article?.summary }}
                </p>
                <Link :href="route('articles.show', { slug: data.article?.slug })" class="inline-flex items-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-900 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Read more
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </Link>
            </div>
        </div>
    </section>
</template>