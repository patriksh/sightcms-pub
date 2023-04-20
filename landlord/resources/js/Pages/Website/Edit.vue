<script setup>
import { usePage, useForm, Head, Link } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import DashboardTitle from '@/Components/DashboardTitle.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineOptions({ layout: DashboardLayout });

const props = defineProps({
    website: Object,
});

const form = useForm({
    name: props.website.name,
    domain: props.website.domain
});

const submit = () => form.patch(route('website.update', { id: props.website._id }));
</script>

<template>
    <Head :title="$t('website_edit.meta.title')" />

    <DashboardTitle :value="$t('website_edit.title', { name: website.name })" />

    <div class="py-12 lg:px-6">
        <div class="container mx-auto px-4 sm:px-0">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ $t('website_edit.information_title') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ $t('website_edit.information_text') }}
                        </p>
                    </header>

                    <form @submit.prevent="submit" class="mt-6 space-y-6">
                        <div>
                            <InputLabel :value="$t('website_edit.form.name.label')" for="name" :error="form.errors.name" />
                            <TextInput v-model="form.name" type="text" id="name" :error="form.errors.name" />
                            <InputError :message="form.errors.name" />
                        </div>

                        <!-- TODO: Allow domain changing. -->
                        <div>
                            <InputLabel :value="$t('website_edit.form.domain.label')" for="domain" :error="form.errors.domain" />
                            <TextInput v-model="form.domain" type="text" id="domain" class="bg-gray-200" :error="form.errors.domain" disabled />
                            <InputError :message="form.errors.domain" />
                            <p class="mt-2 text-sm text-gray-600">
                                {{ $t('website_edit.form.domain.help') }}
                            </p>
                        </div>

                        <div class="flex items-center gap-4">
                            <PrimaryButton :disabled="form.processing">
                                {{ $t('website_edit.button') }}
                            </PrimaryButton>

                            <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">
                                    {{ $t('website_edit.saved') }}
                                </p>
                            </Transition>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</template>