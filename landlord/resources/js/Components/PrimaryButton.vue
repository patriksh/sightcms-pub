<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
    disabled: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <button
        :type="type"
        :disabled="disabled"
        :class="`text-white bg-primary-500 font-medium rounded-md text-sm px-5 py-2.5 focus:outline-none ${disabled ? 'opacity-60 cursor-not-allowed' : 'hover:bg-primary-600 focus:ring-4 focus:ring-primary-100'}'}`"
    >
        <slot />
    </button>
</template>
