import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

// Get the full storage URL for a given filename.
export const storageUrl = (filename) => computed(() => usePage().props.value.storageUrl).value + filename;