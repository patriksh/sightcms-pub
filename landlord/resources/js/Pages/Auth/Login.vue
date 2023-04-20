<script setup>
import { useForm, Head, Link } from '@inertiajs/vue3';
import AuthLayout from '@/Layouts/AuthLayout.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineOptions({ layout: AuthLayout });

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head :title="$t('login.meta.title')" />

    <div v-if="status">
        <div class="p-4 mb-4 rounded-lg text-sm text-green-800 bg-green-100 lg:mb-16">
            {{ status }}
        </div>
    </div>

    <form @submit.prevent="submit">
        <div>
            <InputLabel :value="$t('auth.form.email.label')" for="email" :error="form.errors.email" />
            <TextInput v-model="form.email" type="email" id="email" autofocus autocomplete="username" :error="form.errors.email" />
            <InputError :message="form.errors.email" />
        </div>

        <div class="mt-4">
            <InputLabel :value="$t('auth.form.password.label')" for="password" :error="form.errors.password" />
            <TextInput v-model="form.password" type="password" id="password" autocomplete="current-password" :error="form.errors.password" />
            <InputError :message="form.errors.password" />
        </div>

        <div class="block mt-4">
            <label class="flex items-center">
                <Checkbox name="remember" v-model:checked="form.remember" />
                <span class="ml-2 text-sm text-gray-600">
                    {{ $t('login.remember_me') }}
                </span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-100">
                {{ $t('login.forgot_password') }}
            </Link>

            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                {{ $t('login.button') }}
            </PrimaryButton>
        </div>
    </form>
</template>
