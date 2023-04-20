<script setup>
import { ref } from 'vue';
import Intro from './Intro.vue';
import Step1 from './Step1.vue';
import Step2 from './Step2.vue';
import Step3 from './Step3.vue';

const props = defineProps({
    step: {
        type: Number,
        required: true
    }
});
</script>

<template>
    <Intro v-if="step === 0" />
    <Step1 v-if="step === 1" />
    <Step2 v-if="step === 2" />
    <Step3 v-if="step === 3" />
</template>