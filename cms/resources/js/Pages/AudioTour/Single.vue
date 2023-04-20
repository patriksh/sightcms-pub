<script setup>
import { computed } from 'vue';
import { storageUrl } from '@/Helpers/misc';
import Share from '@/Components/Share.vue';

const props = defineProps({
    audioTour: Object
});

const audioTourMime = computed(() => {
    return props.audioTour.file.split('.').pop() === 'mp3' ? 'audio/mpeg' : 'audio/wav';
});

const audioTourDownloadName = computed(() => {
    // encode the title to remove spaces and special characters as URL
    return `tour-${encodeURIComponent(props.audioTour.title)}.${props.audioTour.file.split('.').pop()}`;
});
</script>

<template>
    <HeadMeta :title="`${audioTour.title} - Audio Tour`" />
    
    <Layout>
        <section class="relative overflow-hidden bg-gray-900">
            <img class="absolute top-0 left-0 w-full h-full object-cover opacity-20 pointer-events-none" :src="storageUrl(audioTour.image)">
            <div class="relative py-12 px-4 mx-auto max-w-screen-xl text-center lg:py-[6rem] lg:px-12">
                <h1 class="my-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
                    {{ audioTour.title }}
                </h1>
                <p class="my-4 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 xl:px-48">
                    Duration: {{ audioTour.duration }}
                </p>
            </div>
        </section>

        <section class="p-4 py-6 mx-auto max-w-screen-xl md:p-8 lg:p-10">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-4 md:gap-12">
                <div class="md:col-span-3">
                    <div class="mb-10">
                        <div class="w-auto p-2 rounded-xl bg-gray-200">
                            <audio controls class="w-full">
                                <source :src="storageUrl(audioTour.file)" :type="audioTourMime" />
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>
                    <h1 class="mb-10 text-2xl font-bold md:text-3xl lg:text-4xl">Audio Tour information</h1>
                    <div class="format max-w-full" v-html="audioTour.content" />
                </div>
                <div class="flex flex-col gap-8">
                    <div>
                        <p class="mb-2 font-bold text-gray-600">Download</p>
                        <a :download="audioTourDownloadName" :href="storageUrl(audioTour.file)" class="text-2xl text-gray-500 hover:text-gray-900 dark:hover:text-white dark:text-gray-400">
                            <i class="fas fa-fw fa-download"></i>
                            <small class="ml-2">{{ audioTour.file_size }}</small>
                        </a>
                    </div>
                    <div>
                        <p class="mb-2 font-bold text-gray-600">Share</p>
                        <Share />
                    </div>
                </div>
            </div>
        </section>
    </Layout>
</template>