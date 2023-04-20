
<script setup>
import { onMounted } from 'vue';
import { useForm, Head } from '@inertiajs/vue3';
import LandingLayout from '@/Layouts/LandingLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineOptions({ layout: LandingLayout });

const props = defineProps(['recaptchaSiteKey']);

// Appends the reCAPTCHA script to the document head on load.
onMounted(() => {
    const script = document.createElement('script');
    script.setAttribute('src', `https://www.google.com/recaptcha/api.js?render=${props.recaptchaSiteKey}`)
    document.head.appendChild(script);
});

const form = useForm({
    email: '',
    subject: '',
    message: '',
    recaptcha: ''
});

const submit = async () => {
    // Waits for the reCAPTCHA response, then appends it to the form and submits it.
    form.recaptcha = await grecaptcha.execute(props.recaptchaSiteKey, { action: 'submit' });
    form.post(route('contact.post'), { onSuccess: () => form.reset()});
}
</script>

<template>
    <Head :title="$t('contact.meta.title')" />

    <section class="bg-gray-50">
        <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900">
                {{ $t('contact.title') }}
            </h2>
            <p class="mb-8 lg:mb-16 font-light text-center text-gray-500 sm:text-xl">
                {{ $t('contact.subtitle') }}
            </p>
            <div v-if="$page.props.flash.message">
                <div class="p-4 mb-8 rounded-lg text-sm text-green-800 bg-green-100 lg:mb-16">
                    {{ $page.props.flash.message }}
                </div>
            </div>
            <form @submit.prevent="submit" class="space-y-8">
                <div>
                    <InputLabel :value="$t('contact.form.email.label')" :error="form.errors.email" />
                    <TextInput v-model="form.email" type="email" :placeholder="$t('contact.form.email.placeholder')" :error="form.errors.email" />
                    <InputError :message="form.errors.email" />
                </div>
                <div>
                    <InputLabel :value="$t('contact.form.subject.label')" :error="form.errors.subject" />
                    <TextInput v-model="form.subject" type="text" :placeholder="$t('contact.form.subject.placeholder')" :error="form.errors.subject" />
                    <InputError :message="form.errors.subject" />
                </div>
                <div>
                    <InputLabel :value="$t('contact.form.message.label')" :error="form.errors.message" />
                    <TextArea v-model="form.message" :placeholder="$t('contact.form.message.placeholder')" rows="6" :error="form.errors.message" />
                    <InputError :message="form.errors.message" />
                </div>
                <div>
                    <InputError :message="form.errors.recaptcha" />
                </div>
                <PrimaryButton type="submit" class="py-3 w-full sm:w-fit">
                    {{ $t('contact.form.button') }}
                </PrimaryButton>
            </form>
        </div>
    </section>
</template>