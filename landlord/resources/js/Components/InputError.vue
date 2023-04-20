<script setup>
defineProps(['message']);
</script>

<template>
    <p v-if="message" class="mt-2 text-sm text-red-600">
        {{ message }}
    </p>
</template>
