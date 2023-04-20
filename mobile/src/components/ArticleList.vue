<script setup lang="ts">
import { Article } from '@/types/article';
import ArticleListItem from '@/components/ArticleListItem.vue';

defineProps({
    articles: {
        type: Array as () => Article[],
        required: true
    },
    loading: {
        type: Boolean,
        default: false
    }
});
</script>

<template>
    <template v-if="!loading">
        <ArticleListItem v-for="article in articles" :key="article._id" :article="article" />
    </template>
    <template v-else>
        <ArticleListItem v-for="index in 6" :key="index" />
    </template>
</template>