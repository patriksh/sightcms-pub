<script setup>
import Logo from '@/Assets/logo.svg'
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <Link href="/">
                <Logo class="h-10 mb-10" />
            </Link>
        </div>
        <transition name="auth" mode="out-in" appear>
            <main :key="$page.url" class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <slot />
            </main>
        </transition>
    </div>
</template>

<style>
.auth-enter-active,
.auth-leave-active {
    transition: all .1s;
}

.auth-enter,
.auth-leave-active {
    opacity: 0;
}
</style>