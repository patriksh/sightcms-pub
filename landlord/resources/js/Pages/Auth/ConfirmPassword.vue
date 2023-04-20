<script setup>
import { useForm, Head } from '@inertiajs/vue3';
import AuthLayout from '@/Layouts/AuthLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineOptions({ layout: AuthLayout });

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <Head :title="$t('confirm_password.meta.title')" />

    <div class="mb-4 text-sm text-gray-600">
        {{ $t('confirm_password.text') }}
    </div>

    <form @submit.prevent="submit">
        <div>
            <InputLabel :value="$t('auth.form.password.label')" for="password" :error="form.errors.password" />
            <TextInput v-model="form.password" type="password" id="password" autocomplete="current-password" autofocus :error="form.errors.password" />
            <InputError :message="form.errors.password" />
        </div>

        <div class="flex justify-end mt-4">
            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                {{ $t('confirm_password.button') }}
            </PrimaryButton>
        </div>
    </form>
</template>
