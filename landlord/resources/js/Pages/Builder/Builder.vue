<script setup>
import BuilderLayout from '@/Layouts/BuilderLayout.vue';
import BuilderForm from './Partials/Form.vue';
import BuilderFinish from './Partials/Finish.vue';

defineOptions({ layout: BuilderLayout });

defineProps({
    step: Number,
    finish: Boolean
});
</script>

<template>
    <BuilderForm v-if="!finish" :step="step" />
    <BuilderFinish v-if="finish" />
</template>