<script setup>
import { router, usePage, Head } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const name = usePage().props?.name || '';
const type = usePage().props?.type || '';
const plans = usePage().props?.plans || [];

// Using router instead of useForm as there's buttons for each plan (no need for validation).
const proceed = (plan) => router.post('/builder/step-3', { plan });
</script>

<template>
    <Head :title="$t('builder.step_3.meta.title')" />

    <div>
        <section class="pt-4">
            <div class="px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
                <h1 class="mb-6 text-2xl font-bold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-4xl">
                    {{ $t('builder.step_3.title') }}
                </h1>
                <p class="mb-12 font-normal text-gray-700">
                    <i18n-t keypath="builder.step_3.text" tag="span">
                        <template v-slot:name>
                            <span class="italic">{{ name }}</span>
                        </template>
                        <template v-slot:type>
                            {{ type }}
                        </template>
                    </i18n-t>
                </p>

                <div class="space-y-8 lg:grid lg:grid-cols-3 lg:grid-flow-col sm:gap-6 xl:gap-10 lg:space-y-0" style="grid-auto-columns: 1fr;">
                    <div v-for="plan in plans" :key="plan.id" class="flex flex-col w-full p-6 mx-auto text-center text-gray-900 bg-white border border-gray-200 rounded">
                        <h3 class="mb-4 text-2xl font-semibold">
                            {{ $t(plan.name) }}
                        </h3>
                        <div class="flex justify-center items-baseline my-8">
                            <span class="mr-2 text-5xl font-extrabold">
                                {{ plan.price }} €
                            </span>
                            <span class="text-gray-500 dark:text-gray-400">
                                {{ $t('builder.step_3.per_month') }}
                            </span>
                        </div>
                        <ul role="list" class="mb-8 space-y-4 text-left">
                            <li v-for="(feature, index) in plan.features" :key="index" class="flex items-center space-x-3">
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                <span>{{ $t(feature) }}</span>
                            </li>
                        </ul>
                        <PrimaryButton @click="proceed('free')" :disabled="plan.active ? false : true">
                            {{ plan.active ? $t('builder.step_3.button') : $t('builder.step_3.button_inactive') }}
                        </PrimaryButton>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>