<script setup>
import { computed } from 'vue';
import { storageUrl } from '@/Helpers/misc';

defineProps(['imgClass']);
</script>

<template>
    <!-- Use the page title if a logo image isn't set. -->
    <img v-if="$page.props.globalPreferences.identity.logo" :src="storageUrl($page.props.globalPreferences.identity.logo)" :class="imgClass">
    <template v-else>
        <div>
            <div class="text-primary-700 text-xl font-bold tracking-tight leading-none">
                {{ $page.props.globalPreferences.identity.name }}
            </div>
        </div>
    </template>
</template>
