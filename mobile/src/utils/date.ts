import { useI18n } from 'vue-i18n';

// Check if two Date objects are on the same day.
export const isSameDay = (date1: Date, date2: Date): boolean => (date1.getDate() === date2.getDate() && date1.getMonth() === date2.getMonth() && date1.getFullYear() === date2.getFullYear());

// Format a Date object to a string.
export const dateToLocaleString = (date: Date): string => {
    const { locale } = useI18n();
    const localeFormatted = locale.value.replace('_', '-');
    return date.toLocaleString(localeFormatted, { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric' });
}

// Format a Date object to a date string.
export const dateToLocaleDateString = (date: Date): string => {
    const { locale } = useI18n();
    const localeFormatted = locale.value.replace('_', '-');
    return date.toLocaleString(localeFormatted, { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
}

// Format a Date object to a time string.
export const dateToLocaleTimeString = (date: Date): string => {
    const { locale } = useI18n();
    const localeFormatted = locale.value.replace('_', '-');
    return date.toLocaleString(localeFormatted, { hour: 'numeric', minute: 'numeric' });
}