<script setup>
import Logo from '@/Assets/logo.svg'
import { Link } from '@inertiajs/vue3';

const goBack = () => window.history.back();
</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <nav>
            <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8">
                <div class="flex justify-center h-16 relative">
                    <div class="flex">
                        <div class="shrink-0 flex items-center">
                            <Link :href="route('dashboard')">
                                <Logo class="block h-8 w-auto fill-current text-gray-800 mt-2" />
                            </Link>
                        </div>
                    </div>
                    <div class="absolute left-0 top-4">
                        <button @click="goBack" type="button" class="text-gray-400 font">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <transition name="builder" mode="out-in" appear>
            <main :key="$page.url">
                <slot />
            </main>
        </transition>
    </div>
</template>

<style>
.builder-enter-active,
.builder-leave-active {
    transition: all .1s;
}

.builder-enter,
.builder-leave-active {
    opacity: 0;
}
</style>