<script setup>
import { usePage, useForm, Link } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ $t('profile.profile_information_title') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ $t('profile.profile_information_text') }}
            </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">
            <div>
                <InputLabel :value="$t('auth.form.name.label')" for="name" :error="form.errors.name" />
                <TextInput v-model="form.name" type="text" id="name" autofocus autocomplete="name" :error="form.errors.name" />
                <InputError :message="form.errors.name" />
            </div>

            <div>
                <InputLabel :value="$t('auth.form.email.label')" for="email" :error="form.errors.email" />
                <TextInput v-model="form.email" type="email" id="email" required autocomplete="email" :error="form.errors.email" />
                <InputError :message="form.errors.email" />
            </div>

            <div v-if="props.mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800">
                    {{ $t('profile.email_not_verified') }}
                    <Link :href="route('verification.send')" method="post" as="button" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-100">
                        {{ $t('profile.resend_verification') }}
                    </Link>
                </p>

                <div v-show="props.status === 'verification-link-sent'" class="mt-2 font-medium text-sm text-green-600">
                    {{ $t('profile.verification_sent') }}
                </div>
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
