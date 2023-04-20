<script setup>
import { computed } from 'vue';
import { useForm, Head, Link } from '@inertiajs/vue3';
import AuthLayout from '@/Layouts/AuthLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineOptions({ layout: AuthLayout });

const props = defineProps({
    status: String,
});

const form = useForm({});

const submit = () => form.post(route('verification.send'));

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <Head :title="$t('verify_email.meta.title')" />

    <div class="mb-4 text-sm text-gray-600">
        {{ $t('verify_email.text') }}
    </div>

    <div v-if="verificationLinkSent">
        <div class="p-4 mb-4 rounded-lg text-sm text-green-800 bg-green-100 lg:mb-16">
            {{ $t('verify_email.text_resent') }}
        </div>
    </div>

    <form @submit.prevent="submit">
        <div class="mt-4 flex items-center justify-between">
            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                {{ $t('verify_email.button') }}
            </PrimaryButton>

            <Link :href="route('logout')"  method="post" as="button" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-100">
                {{ $t('verify_email.sign_out') }}
            </Link>
        </div>
    </form>
</template>
