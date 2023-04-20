<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { storageUrl } from '@/Helpers/misc';
import PageTitle from '@/Components/PageTitle.vue';
import Pagination from '@/Components/Pagination.vue';

defineProps({
    audioTours: Object,
    allCategories: Array,
    currentCategory: Object
});
</script>

<template>
    <HeadMeta title="Audio Tours" />

    <Layout>
        <section class="p-4 py-6 mx-auto max-w-screen-xl md:p-8 lg:p-10">
            <PageTitle>Audio Tours</PageTitle>

            <div class="w-full grid gap-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                <div v-for="audioTour in audioTours.data" :key="audioTour._id"  class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <Link :href="route('audio-tours.show', { slug: audioTour.slug })">
                        <img v-if="audioTour.image" :src="storageUrl(audioTour.image)" class="object-cover aspect-square w-full rounded-t-lg">
                    </Link>
                    <div class="p-5">
                        <Link :href="route('audio-tours.show', { slug: audioTour.slug })">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ audioTour.title }}
                            </h5>
                        </Link>
                        <p class="font-normal text-gray-700 dark:text-gray-400">
                            {{ audioTour.duration }}
                        </p>
                    </div>
                </div>
            </div>
            <Pagination :links="audioTours.links" />
        </section>
    </Layout>
</template>