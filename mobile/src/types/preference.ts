export type Preference = {
    key: string;
    value: string;
}

export type PreferencesResponse = {
    preferences: Preference[];
}