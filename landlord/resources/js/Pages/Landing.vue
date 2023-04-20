<script setup>
import { onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { useI18n } from 'vue-i18n';
import AOS from 'aos';
import { Head, Link } from '@inertiajs/vue3';
import LandingLayout from '@/Layouts/LandingLayout.vue';
import LandingHeroImage from '@/Assets/landing-hero.svg';

onMounted(() => {
    const language = usePage().props.language;
    useI18n().locale.value = language;


    // Initialize animate on scroll
    AOS.init();
});

defineOptions({ layout: LandingLayout });
</script>

<template>
    <Head :title="$t('landing.meta.title')" />
    
    <section class="bg-gray-50">
        <div class="grid py-8 px-4 mx-auto max-w-screen-xl justify-center items-center lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="text-center lg:mr-auto lg:text-left lg:col-span-7">
                <h1 class="mb-4 text-4xl font-extrabold leading-none md:text-5xl lg:max-w-2xl xl:text-6xl">
                    {{ $t('landing.hero.title') }}
                </h1>
                <p class="mb-6 font-light text-gray-500 md:text-lg lg:max-w-2xl lg:mb-8 lg:text-xl">
                    {{ $t('landing.hero.text') }}
                </p>
                <Link :href="route('get-started')" class="inline-flex justify-center items-center py-3 px-5 mr-3 text-base font-medium text-center text-white rounded-md bg-primary-500 hover:bg-primary-600 focus:ring-4 focus:ring-primary-100">
                    {{ $t('landing.hero.cta_1') }}
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </Link>
                <Link :href="route('contact')" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-gray-900 rounded-md border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100">
                    {{ $t('landing.hero.cta_2') }}
                </Link> 
            </div>
            <div class="hidden relative h-[505px] lg:mt-0 lg:col-span-5 lg:flex">
                <div class="absolute text-primary-500 lg:scale-[55%] lg:left-[-200px] xl:scale-[65%] xl:left-[-150px]">
                    <LandingHeroImage />
                </div>
            </div>                
        </div>
    </section>

    <section class="bg-gray-100">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <div class="mb-8 text-center lg:mb-16">
                <h2 class="mb-4 text-4xl font-extrabold text-gray-900">
                    {{ $t('landing.features.title') }}
                </h2>
                <p class="text-gray-500 sm:text-xl">
                    {{ $t('landing.features.text') }}
                </p>
            </div>
            <div id="features" class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                <div data-aos="fade-up">
                    <div class="flex items-center j gap-4 mb-4">
                        <div class="flex justify-center items-center w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12">
                            <svg class="w-5 h-5 text-primary-500 lg:w-6 lg:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                        </div>
                        <h3 class="text-xl font-bold">
                            {{  $t('landing.features.feature_1_title') }}
                        </h3>
                    </div>
                    <p class="text-gray-500">
                        {{ $t('landing.features.feature_1_text') }}
                    </p>
                </div>
                <div data-aos="fade-up">
                    <div class="flex items-center j gap-4 mb-4">
                        <div class="flex justify-center items-center w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12">
                            <svg class="w-5 h-5 text-primary-500 lg:w-6 lg:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg>
                        </div>
                        <h3 class="text-xl font-bold">
                            {{ $t('landing.features.feature_2_title') }}
                        </h3>
                    </div>
                    <p class="text-gray-500">
                        {{ $t('landing.features.feature_2_text') }}
                    </p>
                </div>
                <div data-aos="fade-up">
                    <div class="flex items-center j gap-4 mb-4">
                        <div class="flex justify-center items-center w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12">
                            <svg class="w-5 h-5 text-primary-500 lg:w-6 lg:h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg>
                        </div>
                        <h3 class="text-xl font-bold">
                            {{ $t('landing.features.feature_3_title') }}
                        </h3>
                    </div>
                    <p class="text-gray-500">
                        {{ $t('landing.features.feature_3_text') }}
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-gray-50">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6" data-aos="zoom-in" data-aos-delay="100">
            <div class="mx-auto max-w-screen-sm text-center">
                <h2 class="mb-4 text-4xl font-extrabold leading-tight text-gray-900">
                    {{ $t('landing.cta.title') }}
                </h2>
                <p class="mb-6 font-light text-gray-500 md:text-lg">
                    {{ $t('landing.cta.text') }}
                </p>
                <Link :href="route('get-started')" class="text-white bg-primary-500 hover:bg-primary-600 focus:ring-4 focus:ring-primary-100 font-medium rounded-md text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">
                    {{ $t('landing.cta.button') }}
                </Link>
            </div>
        </div>
    </section>
</template>