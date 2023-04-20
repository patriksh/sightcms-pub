<script setup>
import { usePage, useForm, Head } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const form = useForm({
    name: usePage().props.name
});

const submit = () => form.post(route('builder.step1'));
</script>

<template>
    <Head :title="$t('builder.step_1.meta.title')" />

    <div>
        <section class="pt-4">
            <div class="px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
                <h1 class="mb-6 text-2xl font-bold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-4xl">
                    {{ $t('builder.step_1.title') }}
                </h1>
                <p class="mb-12 font-normal text-gray-700">
                    {{ $t('builder.step_1.text') }}
                </p>
                <form @submit.prevent="submit">
                    <div class="flex justify-center gap-2">
                        <!-- TODO: remove required in favor of serverside validation because it looks better, idk -->
                        <TextInput v-model="form.name" type="text" class="max-w-full sm:max-w-[22rem]" :placeholder="$t('builder.step_1.placeholder')" required />
                        <SecondaryButton type="submit">
                            {{ $t('builder.step_1.button') }}
                        </SecondaryButton>
                    </div>
                </form>
            </div>
        </section>
    </div>
</template>