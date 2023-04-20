<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps(['href', 'active']);

// Apply primary text/bg color to active links.
const classes = computed(() =>
    props.active
        ? 'block py-2 pl-3 pr-4 text-white bg-primary-500 rounded md:bg-transparent md:text-primary-500 md:p-0'
        : 'block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-primary-500 md:p-0'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
