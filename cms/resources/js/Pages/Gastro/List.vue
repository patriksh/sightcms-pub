<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import { storageUrl } from '@/Helpers/misc';
import PageTitle from '@/Components/PageTitle.vue';
import CategorySidebar from '@/Components/CategorySidebar.vue';
import Pagination from '@/Components/Pagination.vue';

defineProps({
    gastros: Object,
    allCategories: Array,
    currentCategory: Object
});
</script>

<template>
    <HeadMeta title="Gastronomy" />

    <Layout>
        <section class="p-4 py-6 mx-auto max-w-screen-xl md:p-8 lg:p-10">
            <PageTitle>Gastronomy</PageTitle>

            <div class="grid gap-8 md:grid-cols-3 lg:grid-cols-4">
                <div class="md:col-span-1">
                    <CategorySidebar :categories="allCategories" :selected="currentCategory?._id" route-name="gastros.category" />
                </div>
                <hr class="block md:hidden">
                <div class="md:col-span-2 lg:col-span-3">
                    <div class="w-full grid gap-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                        <div v-for="gastro in gastros.data" :key="gastro._id"  class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <Link :href="route('gastros.show', { slug: gastro.slug })">
                                <img v-if="gastro.image" :src="storageUrl(gastro.image)" class="object-cover aspect-square w-full rounded-t-lg">
                            </Link>
                            <div class="p-5">
                                <Link :href="route('gastros.show', { slug: gastro.slug })">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        {{ gastro.name }}
                                    </h5>
                                </Link>
                                <p class="font-normal text-gray-700 dark:text-gray-400">
                                    {{ gastro.location }}
                                    <template v-if="currentCategory === null">
                                        -
                                        <Link :href="route('gastros.category', { slug: gastro.gastro_category.slug })" class="text-primary-700">
                                            {{ gastro.gastro_category.name }}
                                        </Link>
                                    </template>
                                </p>
                            </div>
                        </div>
                    </div>
                    <Pagination :links="gastros.links" />
                </div>
            </div>
        </section>
    </Layout>
</template>