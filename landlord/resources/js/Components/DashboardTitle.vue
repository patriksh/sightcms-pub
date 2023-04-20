<script setup>
defineProps(['value'])
</script>

<template>
    <div class="bg-white shadow">
        <div class="container mx-auto py-6 px-4 sm:px-0 lg:px-6">
            <h2 v-if="value" class="font-semibold text-xl text-gray-800 leading-tight">
                {{ value }}
            </h2>

            <slot />
        </div>
    </div>
</template>