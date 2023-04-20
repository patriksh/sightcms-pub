<script setup>
defineProps({
    data: {
        type: Object,
        default() {
            return {
                title: '',
                text: ''
            }
        }
    }
});
</script>

<template>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="max-w-screen-lg text-gray-500 sm:text-lg dark:text-gray-400">
                <h2 class="mb-4 text-4xl tracking-tight font-bold text-gray-900 dark:text-white">
                    {{ data.title }}
                </h2>
                <div class="max-w-full format format-sm format-blue sm:format-base lg:format-lg dark:format-invert" v-html="data.text"></div>
            </div>
        </div>
    </section>
</template>