<script setup>
import { useForm, Head, Link } from '@inertiajs/vue3';
import AuthLayout from '@/Layouts/AuthLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineOptions({ layout: AuthLayout });

const form = useForm({
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head :title="$t('register.meta.title')" />

    <form @submit.prevent="submit">
        <div>
            <InputLabel :value="$t('auth.form.email.label')" for="email" :error="form.errors.email" />
            <TextInput v-model="form.email" type="email" id="email" autofocus autocomplete="username" :error="form.errors.email" />
            <InputError :message="form.errors.email" />
        </div>

        <div class="mt-4">
            <InputLabel :value="$t('auth.form.password.label')" for="password" :error="form.errors.password" />
            <TextInput v-model="form.password" type="password" id="password" autocomplete="new-password" :error="form.errors.password" />
            <InputError :message="form.errors.password" />
        </div>

        <div class="mt-4">
            <InputLabel :value="$t('auth.form.password_confirmation.label')" for="password_confirmation" :error="form.errors.password_confirmation" />
            <TextInput v-model="form.password_confirmation" type="password" id="password_confirmation" autocomplete="new-password" :error="form.errors.password_confirmation" />
            <InputError :message="form.errors.password_confirmation" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-100">
                {{ $t('register.already_registered') }}
            </Link>

            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                {{ $t('register.button') }}
            </PrimaryButton>
        </div>
    </form>
</template>
