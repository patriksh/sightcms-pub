<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if(form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }

            if(form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ $t('profile.update_password_title') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ $t('profile.update_password_text') }}
            </p>
        </header>

        <form @submit.prevent="updatePassword" class="mt-6 space-y-6">
            <div>
                <InputLabel :value="$t('auth.form.current_password.label')" for="current_password" :error="form.errors.current_password" />
                <TextInput v-model="form.current_password" type="password" ref="currentPasswordInput" id="current_password" autocomplete="current-password" :error="form.errors.current_password" />
                <InputError :message="form.errors.current_password" />
            </div>

            <div>
                <InputLabel :value="$t('auth.form.new_password.label')" for="password" :error="form.errors.password" />
                <TextInput v-model="form.password" type="password" ref="passwordInput" id="password" autocomplete="new-password" :error="form.errors.password" />
                <InputError :message="form.errors.password" />
            </div>

            <div>
                <InputLabel :value="$t('auth.form.password_confirmation.label')" for="password_confirmation" :error="form.errors.password_confirmation" />
                <TextInput v-model="form.password_confirmation" type="password" id="password_confirmation" autocomplete="new-password" :error="form.errors.password_confirmation" />
                <InputError :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">
                    {{ $t('profile.save') }}
                </PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">
                        {{ $t('profile.saved') }}
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
