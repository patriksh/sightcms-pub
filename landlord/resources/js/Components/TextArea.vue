<script setup>
import { computed } from 'vue';

const props = defineProps(['modelValue', 'error']);

defineEmits(['update:modelValue']);

// Apply red bg, label, placeholder color if this input has an error.
const classes = computed(() =>
    props.error
        ? 'shadow-sm bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5'
        : 'shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-100 focus:border-primary-500 block w-full p-2.5'
);
</script>

<template>
    <textarea
        :class="classes"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    />
</template>
