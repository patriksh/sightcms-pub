import { defineStore } from 'pinia';
import { ref, computed } from 'vue';
import { Preferences as CapacitorPreferences } from '@capacitor/preferences';
import { Preference } from '@/types/preference';
import { isOnline } from '@/http/http';
import { getPreferences } from '@/http/preferences';
import { OfflineError } from '@/errors/http';

export const usePreferencesStore = defineStore('preferences', () => {
    const preferences = ref<Preference[]>([]);
    const preference = (key: string) => computed(() => preferences.value.find(p => p.key === key));

    const fetch = async () => {
        if(preferences.value.length > 0) return;

        // If we're online, fetch the preferences from the API and store them in Capacitor Preferences.
        if(await isOnline()) {
            preferences.value = await getPreferences();
            await CapacitorPreferences.set({ key: 'preferences', value: JSON.stringify(preferences.value) });
        } else {
        // If we're offline, fetch the preferences from Capacitor Preferences.
            const { value } = await CapacitorPreferences.get({ key: 'preferences' });
            if(value) {
                preferences.value = JSON.parse(value);
            } else {
                throw new OfflineError();
            }
        }
    }
  
    return { preferences, preference, fetch }
});