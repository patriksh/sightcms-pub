
<script setup>
import { Head } from '@inertiajs/vue3';
import LandingLayout from '@/Layouts/LandingLayout.vue';

defineOptions({ layout: LandingLayout });
</script>

<template>
    <Head :title="$t('privacy_policy.meta.title')" />

    <section class="bg-gray-50">
        <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
            <h2 class="mb-12 text-4xl tracking-tight font-extrabold text-center text-gray-900">
                {{ $t('privacy_policy.title') }}
            </h2>
            <div class="format max-w-full">
                <p>
                    {{ $t('privacy_policy.text') }}
                </p>
            </div>
        </div>
    </section>
</template>
