<script setup>
import { computed } from 'vue';
import { Head } from '@inertiajs/inertia-vue3';
import { storageUrl } from '@/Helpers/misc';
import VueCountdown from '@chenfengyuan/vue-countdown';
import { isSameDay } from '@/Helpers/date';
import Share from '@/Components/Share.vue';

defineProps({
    event: Object
});
</script>

<template>
    <HeadMeta :title="`${event.title} - Event`" />
    
    <Layout>
        <section class="relative overflow-hidden bg-gray-900">
            <img class="absolute top-0 left-0 w-full h-full object-cover opacity-20 pointer-events-none" :src="storageUrl(event.image)">
            <div class="relative py-12 px-4 mx-auto max-w-screen-xl text-center lg:py-[6rem] lg:px-12">
                <p class="my-4 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 xl:px-48">
                    {{ event.location }}
                </p>
                <h1 class="my-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
                    {{ event.title }}
                </h1>
                <p class="my-4 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 xl:px-48">
                    <vue-countdown :time="(new Date(event.date_from).getTime()) - new Date().getTime()" v-slot="{ days, hours, minutes, seconds }">
                        <span v-if="days > 0">{{ days }} days, </span>
                        <span v-if="hours > 0">{{ hours }} hours, </span>
                        <span v-if="minutes > 0">{{ minutes }} minutes, </span>
                        <span v-if="seconds > 0">{{ seconds }} seconds</span>
                    </vue-countdown>
                </p>
            </div>
        </section>

        <section class="p-4 py-6 mx-auto max-w-screen-xl md:p-8 lg:p-10">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-4 md:gap-12">
                <div class="md:col-span-3">
                    <div class="flex flex-col gap-4">
                        <!-- Date display for when the event lasts longer than a day.-->
                        <template v-if="event.date_to !== null && !isSameDay(new Date(event.date_from), new Date(event.date_to))">
                            <div class="flex gap-3">
                                <span class="text-primary-700"><i class="fa fa-fw fa-calendar-alt"></i></span>
                                <span class="text-gray-500 dark:text-gray-400">
                                    {{ new Date(event.date_from).toLocaleString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric' }) }}
                                </span>
                            </div>
                            <div class="flex gap-3">
                                <span class="text-primary-700"><i class="fa fa-fw fa-calendar"></i></span>
                                <span class="text-gray-500 dark:text-gray-400">
                                    {{ new Date(event.date_to).toLocaleString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric' }) }}
                                </span>
                            </div>
                        </template>
                        <template v-else>
                            <!-- Date display for when the event lasts less than a day. -->
                            <div class="flex gap-3">
                                <span class="text-primary-700"><i class="fa fa-fw fa-calendar-alt"></i></span>
                                <span class="text-gray-500 dark:text-gray-400">
                                    {{ new Date(event.date_from).toLocaleString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }) }}
                                </span>
                            </div>
                            <div class="flex gap-3">
                                <span class="text-primary-700"><i class="fa fa-fw fa-clock"></i></span>
                                <span class="text-gray-500 dark:text-gray-400">
                                    <!-- From hours -->
                                    {{ new Date(event.date_from).toLocaleString('en-US', { hour: 'numeric', minute: 'numeric' }) }}
                                    <!-- To hours -->
                                    <template v-if="event.date_to !== null">
                                        - {{ new Date(event.date_to).toLocaleString('en-US', { hour: 'numeric', minute: 'numeric' }) }}
                                    </template>
                                </span>
                            </div>
                        </template>
                    </div>
                </div>
                <div>
                    <a v-if="event.website_link" :href="event.website_link" target="_blank" class="block w-full text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-base px-6 py-3.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        View website
                    </a>
                </div>
            </div>
        </section>

        <hr>

        <section class="p-4 py-6 mx-auto max-w-screen-xl md:p-8 lg:p-10">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-4 md:gap-12">
                <div class="md:col-span-3">
                    <h1 class="mb-10 text-2xl font-bold md:text-3xl lg:text-4xl">Event overview</h1>
                    <div class="format max-w-full" v-html="event.content" />
                </div>
                <div class="flex flex-col gap-8">
                    <div v-if="event.logo">
                        <img :src="storageUrl(event.logo)" class="rounded-xl">
                    </div>
                    <div>
                        <p class="mb-2 font-bold text-gray-600">Location</p>
                        <p class="mb-2 text-gray-500 dark:text-gray-400">{{ event.location }}</p>
                        <a :href="`https://www.google.com/maps/dir/${encodeURIComponent(event.location)}`" target="_blank" class="w-full px-3 py-2 text-xs font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            <span class="w-5 h-5 mr-2 -ml-1"><i class="fa fa-map" /></span>
                            View map
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