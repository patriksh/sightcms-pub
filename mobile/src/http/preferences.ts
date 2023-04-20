import { httpGet } from './http';
import { Preference, PreferencesResponse } from '@/types/preference';

export const getPreferences = async (): Promise<Preference[]> => {
    const response: PreferencesResponse = await httpGet('preferences');
    return response.preferences;
}