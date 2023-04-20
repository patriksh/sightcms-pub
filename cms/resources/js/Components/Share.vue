<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

const props = defineProps({
    link: {
        type: String
    },
    small: {
        type: Boolean,
        default: false
    }
});

// Default share link is the current base url + current route.
const shareLink = computed(() => props.link || usePage().props.value.ziggy.url + usePage().url.value)

// Show the OS share dialog if it's supported.
const canUseNavigatorShare = window.navigator.share ? true : false;
const doNavigatorShare = (url) => window.navigator.share({ url });

const classes = computed(() => 
    props.small
        ? 'text-lg text-gray-500 hover:text-gray-900 dark:hover:text-white dark:text-gray-400'
        : 'text-2xl text-gray-500 hover:text-gray-900 dark:hover:text-white dark:text-gray-400'
);
</script>

<template>
    <div class="flex gap-2">
        <a :href="`https://www.facebook.com/sharer.php?u=${encodeURIComponent(shareLink)}`" target="_blank" rel="noopener noreferrer" alt="Share on Facebook" :class="`${classes} `">
            <i class="fab fa-fw fa-facebook" />
        </a>
        <a :href="`https://twitter.com/intent/tweet?url=${encodeURIComponent(shareLink)}`" target="_blank" rel="noopener noreferrer" alt="Share on Twitter" :class="`${classes} `">
            <i class="fab fa-fw fa-twitter" />
        </a>
        <a :href="`whatsapp://send?text=${encodeURIComponent(shareLink)}`" target="_blank" rel="noopener noreferrer" alt="Share on WhatsApp" :class="`${classes} `">
            <i class="fab fa-fw fa-whatsapp" />
        </a>
        <a v-if="canUseNavigatorShare" @click="doNavigatorShare(shareLink)" href="#" alt="Share" :class="`${classes} `">
            <i class="fa fa-fw fa-share" />
        </a>
    </div>
</template>