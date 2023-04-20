<script setup>
import { Head } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import DashboardTitle from '@/Components/DashboardTitle.vue';

defineOptions({ layout: DashboardLayout });
</script>

<template>
    <Head title="Dashboard" />

    <DashboardTitle value="Dashboard" />

    <div class="py-12 lg:px-6">
        <div class="container mx-auto px-4 sm:px-0">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">You're logged in!</div>
            </div>
        </div>
    </div>
</template>
