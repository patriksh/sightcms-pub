<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
</script>

<template>
    <Head :title="$t('builder.finish.meta.title')" />
    <section class="pt-16">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-5">
                <p class="max-w-2xl mb-2 font-light text-gray-500 md:text-lg lg:text-xl">
                    {{ $t('builder.finish.text') }}
                </p>
                <h1 class="max-w-lg mb-8 text-2xl font-bold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-4xl">
                    {{ $t('builder.finish.title') }}
                </h1>
                <PrimaryButton type="button" class="py-3 text-base">
                    <a :href="route('website.dashboard', { id: $page.props.website_id })" class="inline-flex items-center justify-center">
                        {{ $t('builder.finish.button') }}
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                </PrimaryButton>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-7 lg:flex">
                <div class="pl-24">
                    <img src="@/Assets/builder-finish-demo.png" class="shadow rounded-md">
                </div>    
            </div>                
        </div>
    </section>
</template>