<script setup>
import Hero from '@/Components/Home/Hero.vue';
import Features from '@/Components/Home/Features.vue';
import TextBlock from '@/Components/Home/TextBlock.vue';
import TextImageBlock from '@/Components/Home/TextImageBlock.vue';
import Articles from '@/Components/Home/Articles.vue';
import FeaturedArticle from '@/Components/Home/FeaturedArticle.vue';

defineProps({
    blocks: Array
});

// Define a component for each block type.
const resolveComponent = (name) => {
    return {
        hero: Hero,
        features: Features,
        text_block: TextBlock,
        text_image_block: TextImageBlock,
        articles: Articles,
        featured_article: FeaturedArticle
    }[name];
};

// Background color will change for every other block.
const alternateBackgroundClass = 'bg-gray-100 dark:bg-gray-800';
const blocksWithoutAlternatingBackground = ['hero'];
</script>

<template>
    <HeadMeta title="Home" />

    <Layout>
        <div class="blocks" v-for="(block, index) in blocks" :key="block._id">
            <component :is="resolveComponent(block.block)" :data="block.extras" :class="(index % 2 == 0 && block.block in blocksWithoutAlternatingBackground) ? alternateBackgroundClass : undefined" />
        </div>
    </Layout>
</template>