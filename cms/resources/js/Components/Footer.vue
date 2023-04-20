<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

const copyright = computed(() => usePage().props.value.globalPreferences.footer.copyright?.replace('{year}', new Date().getFullYear()));
</script>

<template>
    <footer class="bg-gray-50 dark:bg-gray-800">
        <div class="p-4 py-6 mx-auto max-w-screen-xl md:p-8 lg:p-10">
            <div>
                <!-- TODO: Footer content field or menu items. -->
            </div>
            <hr class="hidden my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8">
            <div class="flex justify-between items-center mb-4">
                <a href="#" class="flex justify-center items-center mb-5 text-2xl font-semibold text-gray-900 dark:text-white">
                    <ApplicationLogo imgClass="h-10" />
                </a>
                <ul class="flex justify-center space-x-5">
                    <li v-for="social in $page.props.globalPreferences.footer.socials" :key="social.network">
                        <a :href="social.url" target="_blank" class="text-lg text-gray-500 hover:text-gray-900 dark:hover:text-white dark:text-gray-400">
                            <i :class="`fab fa-fw fa-${social.network}`" />
                        </a>
                    </li>
                </ul>
            </div>
            <div class="flex justify-between items-center">
                <div>
                    <span class="mt-5 text-sm text-gray-500 dark:text-gray-400">
                        {{ copyright }}
                    </span>
                </div>
                <div>
                    <span class="mt-5 text-sm text-gray-500 dark:text-gray-400">
                        Powered by <a :href="$page.props.globalPreferences.sightcms.link" target="_blank" :style="`color: ${$page.props.globalPreferences.sightcms.color}`">
                            sight<span class="text-gray-900 dark:text-white font-bold">cms</span>
                        </a>.
                    </span>
                </div>
            </div>
        </div>
    </footer>
</template>