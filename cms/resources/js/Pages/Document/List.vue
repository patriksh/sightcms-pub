<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import { storageUrl } from '@/Helpers/misc';
import PageTitle from '@/Components/PageTitle.vue';
import CategorySidebar from '@/Components/CategorySidebar.vue';
import Pagination from '@/Components/Pagination.vue';

defineProps({
    documents: Object,
    allCategories: Array,
    currentCategory: Object
});
</script>

<template>
    <HeadMeta title="Documents" />

    <Layout>
        <section class="p-4 py-6 mx-auto max-w-screen-xl md:p-8 lg:p-10">
            <PageTitle>Documents</PageTitle>

            <div class="grid gap-8 md:grid-cols-3 lg:grid-cols-4">
                <div class="md:col-span-1">
                    <CategorySidebar :categories="allCategories" :selected="currentCategory?._id" route-name="documents.category" />
                </div>
                <hr class="block md:hidden">
                <div class="md:col-span-2 lg:col-span-3">
                    <div class="w-full bg-white rounded-lg border p-4 flex flex-col gap-4">
                        <div v-for="document in documents.data" :key="document._id">
                            <a :href="storageUrl(document.file)" target="_blank" class="text-md text-gray-900 dark:text-white leading-normal">
                                <span class="mr-2 text-primary-700"><i class="fa fa-fw fa-file"></i></span>
                                <span class="hover:underline">{{ document.name }}</span>
                            </a>
                        </div>
                    </div>
                    <Pagination :links="documents.links" />
                </div>
            </div>
        </section>
    </Layout>
</template>