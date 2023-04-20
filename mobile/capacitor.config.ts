import { CapacitorConfig } from '@capacitor/cli';

const config: CapacitorConfig = {
    appId: 'com.sightcms.app',
    appName: 'sightcms demo',
    webDir: 'dist',
    bundledWebRuntime: false,
    plugins: {
        LocalNotifications: {
            smallIcon: 'ic_notification'
        },
    },
};

export default config;
