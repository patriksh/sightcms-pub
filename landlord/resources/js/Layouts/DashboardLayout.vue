<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import DashboardNavLink from '@/Components/DashboardNavLink.vue';
import Logo from '@/Assets/logo.svg'

const userDropdown = ref(false);
const mainDropdown = ref(false);

// Listen for clicks on the document.
const userDropdownClickListener = (event) => {
    // If clicked on the dropdown button, toggle the dropdown.
    if(event.target.closest('#user-dropdown-trigger')) {
        userDropdown.value = !userDropdown.value;
    // If clicked outside the dropdown, close the dropdown.
    } else if(!event.composedPath().includes(document.querySelector('#user-dropdown'))) {
        userDropdown.value = false;
    }
};

onMounted(() => document.addEventListener('click', userDropdownClickListener));
onUnmounted(() => document.removeEventListener('click', userDropdownClickListener));
</script>

<template>
    <div class="flex flex-col min-h-screen">
        <header>
            <nav class="bg-white border-b border-gray-100 px-4 lg:px-6 py-2.5">
                <div class="container flex flex-wrap items-center justify-between mx-auto gap-4 md:justify-[unset]">
                    <Link :href="route('landing')" class="flex items-center">
                        <Logo class="mr-3 h-6 sm:h-8" />
                    </Link>
                    <div class="flex justify-between md:flex-1">
                        <div class="flex items-center relative md:order-2">
                            <button type="button" class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300" id="user-dropdown-trigger">
                                <div class="w-8 h-8 flex justify-center items-center rounded-full shadow-lg bg-primary-500 text-white text-base capitalize">
                                    <!-- Gets the first letter of the name (or email, if the name is empty), and uses it as the avatar icon. -->
                                    {{ $page.props.auth.user.name ? $page.props.auth.user.name.slice(0, 1) : $page.props.auth.user.email.slice(0, 1) }}
                                </div>
                            </button>
                            <div :class="`${userDropdown ? 'block' : 'hidden'} absolute origin-top-right top-8 right-0 z-50 my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow transition ease-in-out duration-150`" id="user-dropdown">
                                <div class="px-4 py-3">
                                    <template v-if="$page.props.auth.user.name">
                                        <span class="block text-sm text-gray-900">
                                            {{ $page.props.auth.user.name }}
                                        </span>
                                        <span class="block text-sm font-medium text-gray-500 truncate">
                                            {{ $page.props.auth.user.email }}
                                        </span>
                                    </template>
                                    <span v-else class="block text-sm text-gray-900">
                                        {{ $page.props.auth.user.email }}
                                    </span>
                                </div>
                                <ul class="py-2" @click="userDropdown = false">
                                    <li>
                                        <Link :href="route('profile.edit')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            {{ $t('nav.profile') }}
                                        </Link>
                                    </li>
                                    <li>
                                        <Link :href="route('logout')" method="post" as="button" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            {{ $t('nav.sign_out') }}
                                        </Link>
                                    </li>
                                </ul>
                            </div>
                            <button @click="mainDropdown = !mainDropdown" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                            </button>
                        </div>
                        <div class="hidden items-center justify-between w-auto order-1 md:flex">
                            <ul class="flex flex-row p-4 text-sm font-medium bg-white border-gray-100 rounded-lg space-x-8">
                                <!-- <li>
                                    <DashboardNavLink :href="route('dashboard')" :active="route().current('dashboard')">Dashboard</DashboardNavLink>
                                </li> -->
                                <li>
                                    <DashboardNavLink :href="route('website.list')" :active="route().current('website.list')">
                                        {{ $t('nav.websites') }}
                                    </DashboardNavLink>
                                </li>
                                <li>
                                    <DashboardNavLink :href="route('builder.intro')">
                                        {{ $t('nav.create') }}
                                    </DashboardNavLink>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- TODO: Rework menu so there's no need for another copy for mobile phones. -->
                <div :class="`${mainDropdown ? 'block' : 'hidden'} items-center justify-between w-full md:hidden`">
                    <ul class="flex flex-col p-4 mt-4 border border-gray-100 rounded-lg bg-gray-50">
                        <!-- <li>
                            <DashboardNavLink :href="route('dashboard')" :active="route().current('dashboard')">Dashboard</DashboardNavLink>
                        </li> -->
                        <li>
                            <DashboardNavLink :href="route('website.list')" :active="route().current('website.list')">
                                {{ $t('nav.websites') }}
                            </DashboardNavLink>
                        </li>
                        <li>
                            <DashboardNavLink :href="route('builder.intro')">
                                {{ $t('nav.create') }}
                            </DashboardNavLink>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <main class="flex-1 bg-gray-100">
            <slot />
        </main>

        <footer class="p-4 bg-white sm:p-6">
            <div class="mx-auto max-w-screen-xl">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <span class="text-sm text-gray-500 sm:text-center">
                        © {{ new Date().getFullYear() }} <a href="https://sightcms.app" class="hover:underline">sightcms</a>. {{ $t('nav.all_rights_reserved') }}
                    </span>
                </div>
            </div>
        </footer>
    </div>
</template>