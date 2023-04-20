<script setup>
defineProps({
    data: {
        type: Object,
        default() {
            return {
                title: '',
                text: '',
                image_1: '',
                image_2: ''
            }
        }
    }
});
</script>

<template>
    <section class="bg-white dark:bg-gray-900">
        <div class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
            <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                    {{ data.title }}
                </h2>
                <div class="max-w-full format format-sm sm:format-base lg:format-lg format-blue dark:format-invert" v-html="data.text"></div>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-8">
                <img class="w-full rounded-lg" :src="data.image_1">
                <img class="mt-4 w-full lg:mt-10 rounded-lg" :src="data.image_2">
            </div>
        </div>
    </section>
</template>