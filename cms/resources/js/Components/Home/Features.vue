<script setup>
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    data: {
        type: Object,
        default() {
            return {
                title: '',
                text: '',
                items: '[]',
                align: 'left'
            }
        }
    }
});

const isSvgIcon = (icon) => icon.trim().startsWith('<svg');
const isFaIcon = (icon) => icon.trim().startsWith('fa');
const isValidIcon = (icon) => isSvgIcon(icon) || isFaIcon(icon);
</script>

<template>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
                    {{ data.title }}
                </h2>
                <p class="text-gray-500 sm:text-xl dark:text-gray-400">
                    {{ data.text }}
                </p>
            </div>
            <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                <div v-for="item in JSON.parse(data.items)" :key="item._id" :class="data.align === 'center' ? 'flex flex-col items-center' : ''">
                    <div v-if="item.icon && isValidIcon(item.icon)" class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                        <Link :href="item.url">
                            <span v-if="isSvgIcon(item.icon)" class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300" v-html="item.icon" />
                            <span v-else-if="isFaIcon(item.icon)" class="w-5 h-5 text-primary-600 text-2xl lg:w-6 lg:h-6 dark:text-primary-300" :class="item.icon" />
                        </Link>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">
                        <Link :href="item.url">
                            {{ item.title }}
                        </Link>
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400">
                        {{ item.text }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>