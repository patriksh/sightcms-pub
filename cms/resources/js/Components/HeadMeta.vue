<script setup>
import { computed } from 'vue';
import { usePage, Head } from '@inertiajs/inertia-vue3';
import { storageUrl } from '@/Helpers/misc';

const props = defineProps({ title: String })

const computedTitle = computed(() => {
    const titleTemplate = usePage().props.value.globalPreferences.seo.title;
    
    if(titleTemplate) {
        return titleTemplate
            .replace('{CURRENT_PAGE}', props.title)
            .replace('{SITE_NAME}', usePage().props.value.globalPreferences.identity.name);
    } else {
        return `${props.title} - ${usePage().props.value.globalPreferences.identity.name}`;
    }
});

const computedDescription = computed(() => {
    const descriptionTemplate = usePage().props.value.globalPreferences.seo.description;
    
    if(descriptionTemplate) {
        return descriptionTemplate
            .replace('{CURRENT_PAGE}', props.title)
            .replace('{SITE_NAME}', usePage().props.value.globalPreferences.identity.name)
            .replace('{SITE_DESCRIPTION}', usePage().props.value.globalPreferences.identity.description);
    } else {
        return usePage().props.value.globalPreferences.identity.description;
    }
});

const computedImage = computed(() => {
    const logo = usePage().props.value.globalPreferences.identity.logo;
    const seoImage = usePage().props.value.globalPreferences.seo.image;

    if(seoImage) {
        return storageUrl(seoImage);
    } else if(logo) {
        return storageUrl(logo);
    } else {
        return null;
    }
});
</script>

<template>
    <Head :title="computedTitle">
        <meta head-key="description" name="description" :content="computedDescription" />
        <meta v-if="computedImage" head-key="og:image" property="og:image" :content="computedImage" />
        <slot />
    </Head>
</template>