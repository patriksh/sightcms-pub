<script setup>
import { computed } from 'vue';

const props = defineProps(['value', 'error']);

// Apply red text color if input of this label has an error.
const classes = computed(() =>
    props.error
        ? 'block mb-2 text-sm font-medium text-red-700'
        : 'block mb-2 text-sm font-medium text-gray-900'
);
</script>

<template>
    <label :class="classes">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
