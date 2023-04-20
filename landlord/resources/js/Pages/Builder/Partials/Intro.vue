<script setup>
import { router, Head } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const proceed = () => router.visit('/builder/step-1');
</script>

<template>
    <Head :title="$t('builder.intro.meta.title')" />
    
    <div>
        <section class="pt-16">
            <div class="px-4 mx-auto max-w-screen-xl text-center lg:py-16">
                <h1 class="mb-8 text-4xl font-bold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">
                    <i18n-t keypath="builder.intro.title" tag="span">
                        <template v-slot:branding>
                            <span class="text-primary-500 font-medium">sight</span><span class="font-bold">cms</span>        
                        </template>
                    </i18n-t>
                </h1>
                <p class="mb-14 text-xl font-normal text-gray-700 lg:text-2xl">
                    {{ $t('builder.intro.text') }}
                </p>
                <PrimaryButton @click="proceed" class="px-8 sm:py-4 sm:text-base lg:text-lg">
                    {{ $t('builder.intro.button') }}
                </PrimaryButton>
            </div>
        </section>
    </div>
</template>