// Formats a ISO date from database to a human readable date.
export const formatIsoDate = (date) => (new Date(date)).toLocaleString('hr-HR', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })

// Check if two Date objects are on the same day.
export const isSameDay = (date1, date2) => (date1.getDate() === date2.getDate() && date1.getMonth() === date2.getMonth() && date1.getFullYear() === date2.getFullYear());