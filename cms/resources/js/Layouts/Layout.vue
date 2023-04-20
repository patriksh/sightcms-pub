<script setup>
import { ref, computed } from 'vue';
import { usePage, Link } from '@inertiajs/inertia-vue3';
import A11yMenu from '@/Components/A11yMenu.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import NavLink from '@/Components/NavLink.vue';
import Footer from '@/Components/Footer.vue';

const menuVisible = ref(false);

// TODO: temporary solution, save routes in menuItems so we can use them for comparison.
const isNavLinkActive = (menuItem) => {
    if(menuItem.type == 'internal_link') {
        return usePage().url.value == menuItem.link;
    }
}

// Show only on the "Grad Zabok" website, since the demo app connects to that site.
// TODO: Figure out how to properly detect user agent on SSR.
const showAppDownloadBanner = computed(() => usePage().props.value.globalPreferences.tenant.slug == 'grad-zabok');
</script>

<template>
    <A11yMenu />
    
    <div :class="`flex flex-col min-h-screen bg-gray-100 dark:bg-gray-900 ${showAppDownloadBanner ? 'pt-[97px] sm:pt-[61px]' : 'pt-[61px]'}`">
        <div v-if="showAppDownloadBanner" class="fixed w-full z-20 top-0 left-0 px-2 py-1.5 bg-gray-100 text-gray-500 text-center block sm:hidden dark:bg-gray-800 dark:text-gray-400">
            <a class="flex justify-between" href="https://play.google.com/store/apps/details?id=com.sightcms.app" target="_blank">
                <div>
                    Preuzmite našu Android aplikaciju.
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </div>
            </a>
        </div>
        <nav :class="`bg-white px-2 sm:px-4 py-2.5 dark:bg-gray-900 fixed w-full z-20 ${showAppDownloadBanner ? 'top-[36px] sm:top-0' : 'top-0'} left-0 border-b border-gray-200 dark:border-gray-800`">
            <div class="container flex flex-wrap items-center justify-between mx-auto">
                <Link :href="route('home')" class="flex items-center">
                    <ApplicationLogo imgClass="h-6 sm:h-12" />
                </Link>
                <div class="flex items-center md:order-2">
                    <button type="button" class="pointer-events-none inline-flex items-center justify-center p-2 text-sm text-gray-500 rounded cursor-pointer"> <!-- hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white -->
                        Hrvatski (HR)
                    </button>
                    <button @click="menuVisible = !menuVisible" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-language-select" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-6 h-6" fill="currentColor" aria-hidden="true" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
                <div :class="`${menuVisible ? '' : 'hidden'} items-center justify-between w-full md:flex md:w-auto md:order-1`" id="mobile-menu-language-select">
                    <ul class="flex flex-col gap-2 p-4 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                        <NavLink v-for="menuItem in $page.props.menu" :href="menuItem.link" :active="isNavLinkActive(menuItem)">
                            {{ menuItem.name }}
                        </NavLink>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="flex-1">
            <slot />
        </div>

        <Footer />
    </div>
</template>
