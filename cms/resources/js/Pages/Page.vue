<script setup>
import { Head } from '@inertiajs/inertia-vue3';

defineProps({
    page: Object,
});
</script>

<template>
    <HeadMeta :title="page.title" />

    <Layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ page.title }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="format" v-html="page.content"></div>
                </div>
            </div>
        </div>
    </Layout>
</template>