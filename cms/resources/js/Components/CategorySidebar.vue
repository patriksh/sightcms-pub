<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

defineProps({
    categories: Array,
    selected: String|null,
    routeName: String,
});
</script>

<template>
    <div class="p-2 border rounded-lg bg-white">
        <ul class="flex flex-col gap-2">
            <li v-for="category in categories">
                <Link
                    :href="route(routeName, { slug: category.slug })"
                    :class="`flex items-center p-2 text-base font-normal rounded-lg dark:text-white ${selected === category._id ? 'bg-primary-700 text-white' : 'text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700'}`">
                    <span class="w-6 h-6">
                        <i :class="`${category.icon} fa-fw`" />
                    </span>
                    <span class="ml-3">{{ category.name }}</span>
                </Link>
            </li>
        </ul>
    </div>
</template>