<script setup>
import { onMounted, ref, computed } from 'vue';

const props = defineProps(['modelValue', 'error']);

defineEmits(['update:modelValue']);

const input = ref(null);

// Focus the input if it has the autofocus attribute.
onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

// Expose the focus method to the parent component (required if using script setup).
defineExpose({ focus: () => input.value.focus() });

// Apply red bg, label, placeholder color if this input has an error.
const classes = computed(() =>
    props.error
        ? 'shadow-sm bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5'
        : 'shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-300 focus:border-primary-700 block w-full p-2.5'
);
</script>

<template>
    <input
        :class="classes"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
    />
</template>
