<script setup>
import { nextTick, ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import DangerButton from '@/Components/DangerButton.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ $t('profile.delete_account_title') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ $t('profile.delete_account_text') }}
            </p>
        </header>

        <DangerButton @click="confirmUserDeletion">Delete Account</DangerButton>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ $t('profile.delete_account_confirmation_title') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ $t('profile.delete_account_confirmation_text') }}
                </p>

                <div class="mt-6">
                    <TextInput v-model="form.password" @keyup.enter="deleteUser" type="password" ref="passwordInput" id="password" :placeholder="$t('auth.form.password.label')" autocomplete="current-password" :error="form.errors.password" />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal">
                        {{ $t('profile.cancel') }}
                    </SecondaryButton>

                    <DangerButton @click="deleteUser" class="ml-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        {{ $t('profile.delete_account_button') }}
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
