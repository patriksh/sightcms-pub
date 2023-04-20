<script setup>
import { Head, Link } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import DashboardTitle from '@/Components/DashboardTitle.vue';

defineOptions({ layout: DashboardLayout });

const props = defineProps({
    websites: Object,
});
</script>

<template>
    <Head :title="$t('websites.meta.title')" />

    <DashboardTitle :value="$t('websites.title')" />

    <div class="py-12 lg:px-6">
        <div class="container mx-auto px-4 sm:px-0">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mb-4">
                <div v-for="website in websites" :key="website._id" class="w-full bg-white border border-gray-200 rounded-lg shadow">
                    <div class="flex justify-end px-4 pt-4">
                        <button disabled class="inline-block text-gray-500 hover:bg-gray-1000 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg text-sm p-1.5" type="button">
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path></svg>
                        </button>
                    </div>
                    <div class="flex flex-col items-center pb-10">
                        <div class="w-24 h-24 mb-3 flex justify-center items-center rounded-full shadow-lg bg-primary-500 text-white font-extrabold text-4xl capitalize">
                            <!-- Gets the first letter of the website and uses it as the avatar icon. -->
                            {{ website.name.slice(0, 1) }}
                        </div>
                        <h5 class="mb-1 text-xl font-medium text-gray-900">
                            {{ website.name }}
                        </h5>
                        <span class="text-sm text-gray-500">
                            <span class="capitalize">{{ website.plan }}</span> {{ $t('websites.plan') }}
                        </span>
                        <div class="flex mt-4 space-x-3 md:mt-6">
                            <a :href="route('website.dashboard', { id: website._id })" target="_blank" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-primary-500 rounded-lg hover:bg-primary-600 focus:ring-4 focus:outline-none focus:ring-primary-100">
                                {{ $t('websites.dashboard') }}
                            </a>
                            <Link :href="route('website.edit', { id: website._id })" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200">
                                {{ $t('websites.edit') }}
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>