<script setup>
import { useForm, Head } from '@inertiajs/vue3';
import AuthLayout from '@/Layouts/AuthLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineOptions({ layout: AuthLayout });

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => form.post(route('password.email'));
</script>

<template>
    <Head :title="$t('forgot_password.meta.title')" />

    <div class="mb-4 text-sm text-gray-600">
        {{ $t('forgot_password.text') }}
    </div>

    <div v-if="status">
        <div class="p-4 mb-4 rounded-lg text-sm text-green-800 bg-green-100 lg:mb-16">
            {{ status }}
        </div>
    </div>

    <form @submit.prevent="submit">
        <div>
            <InputLabel :value="$t('auth.form.email.label')" for="email"  :error="form.errors.email" />
            <TextInput v-model="form.email" type="email" id="email" autofocus autocomplete="username" :error="form.errors.email" />
            <InputError :message="form.errors.email" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                {{ $t('forgot_password.button') }}
            </PrimaryButton>
        </div>
    </form>
</template>
