
<script setup>
import { onMounted } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    recaptchaSiteKey: String,
    contactSubtitle: String,
    contactInformation: String,
    contactCategories: Array
});

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
    form.post(route('contact.store'), { onSuccess: () => form.reset()});
}
</script>

<template>
    <HeadMeta title="Contact" />

    <Layout>
        <section class="bg-gray-50">
            <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900">
                    Contact Us
                </h2>
                <p class="mb-8 lg:mb-12 font-light text-center text-gray-500 sm:text-xl">
                    {{ $page.props.contactSubtitle }}
                </p>
                <div v-if="$page.props?.flash?.message">
                    <div class="p-4 mb-8 rounded-lg text-sm text-green-800 bg-green-100 lg:mb-12">
                        {{ $page.props.flash.message }}
                    </div>
                </div>
                <div v-if="$page.props.contactInformation" class="px-5 mb-8 border rounded-lg bg-white lg:mb-12">
                    <div class="format">
                        <div v-html="$page.props.contactInformation" />
                    </div>
                </div>
                <form @submit.prevent="submit" class="space-y-8">
                    <div>
                        <InputLabel value="Your email" :error="form.errors.email" />
                        <TextInput v-model="form.email" type="email" placeholder="Your email" :error="form.errors.email" />
                        <InputError :message="form.errors.email" />
                    </div>
                    <div>
                        <InputLabel value="Subject" :error="form.errors.subject" />
                        <TextInput v-model="form.subject" type="text" list="subject-datalist" placeholder="Let us know how we can help you" :error="form.errors.subject" />
                        <datalist v-if="contactCategories.length > 0" id="subject-datalist">
                            <option v-for="option in contactCategories" :key="option" :value="option" />
                        </datalist>
                        <InputError :message="form.errors.subject" />
                    </div>
                    <div>
                        <InputLabel value="Your message" :error="form.errors.message" />
                        <TextArea v-model="form.message" placeholder="Leave a comment..." rows="6" :error="form.errors.message" />
                        <InputError :message="form.errors.message" />
                    </div>
                    <div>
                        <InputError :message="form.errors.recaptcha" />
                    </div>
                    <button type="submit" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-md text-sm px-5 py-3 focus:outline-none w-full sm:w-fit">
                        Send message
                    </button>
                </form>
            </div>
        </section>
    </Layout>
</template>