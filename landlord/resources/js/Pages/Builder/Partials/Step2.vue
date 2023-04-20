<script setup>
import { usePage, useForm, Head } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const name = usePage().props?.name || '';

const form = useForm({
    type: null
});

const submit = () => form.post(route('builder.step2'));
</script>

<template>
    <Head :title="$t('builder.step_2.meta.title')" />

    <div>
        <section class="pt-4">
            <div class="px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
                <h1 class="mb-6 text-2xl font-bold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-4xl">
                    {{ $t('builder.step_2.title') }}
                </h1>
                <p class="mb-12 font-normal text-gray-700">
                    <i18n-t keypath="builder.step_2.text" tag="span">
                        <template v-slot:name>
                            <span class="italic">{{ name }}</span>
                        </template>
                    </i18n-t>
                </p>
                <form @submit.prevent="submit">
                    <div class="flex justify-center mb-4">
                        <div class="flex flex-1 flex-col gap-4 max-w-full sm:flex-row sm:max-w-lg">
                            <div class="flex flex-1 items-center pl-4 gap-2 border border-gray-200 rounded">
                                <input v-model="form.type" name="type" value="government" id="type-government" type="radio" class="w-4 h-4 text-primary-500 bg-gray-100 border-gray-300 focus:ring-primary-500 focus:ring-2">
                                <label for="type-government" class="w-full text-left flex flex-col py-4 ml-2 text-sm font-medium text-gray-900">
                                    <span class="font-semibold">
                                        {{ $t('builder.step_2.types.government.title') }}
                                    </span>
                                    <small>
                                        {{ $t('builder.step_2.types.government.text') }}
                                    </small>
                                </label>
                            </div>
                            <div class="flex flex-1 items-center pl-4 gap-2 border border-gray-200 rounded">
                                <input v-model="form.type" name="type" value="tourism" id="type-tourism" type="radio" class="w-4 h-4 text-primary-500 bg-gray-100 border-gray-300 focus:ring-primary-500 focus:ring-2">
                                <label for="type-tourism" class="w-full text-left flex flex-col py-4 ml-2 text-sm font-medium text-gray-900">
                                    <span class="font-semibold">
                                        {{ $t('builder.step_2.types.tourism.title') }}
                                    </span>
                                    <small>
                                        {{ $t('builder.step_2.types.tourism.text') }}
                                    </small>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center mb-4">
                        <div class="w-full max-w-full sm:max-w-lg">
                            <div class="flex flex-1 items-center pl-4 gap-2 border border-gray-200 rounded">
                                <input v-model="form.type" name="type" value="all" id="type-all" type="radio" class="w-4 h-4 text-primary-500 bg-gray-100 border-gray-300 focus:ring-primary-500 focus:ring-2">
                                <label for="type-all" class="w-full text-left flex flex-col py-4 ml-2 text-sm font-medium text-gray-900">
                                    <span class="font-semibold">
                                        {{ $t('builder.step_2.types.universal.title') }}
                                    </span>
                                    <small>
                                        {{ $t('builder.step_2.types.universal.text') }}
                                    </small>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center gap-2">
                        <SecondaryButton type="submit" class="h-[42px]">
                            {{ $t('builder.step_2.button') }}
                        </SecondaryButton>
                    </div>
                </form>
            </div>
        </section>
    </div>
</template>