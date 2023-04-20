<script setup>
import { useRouter } from 'vue-router';
import { IonRefresher, IonRefresherContent, IonButton } from '@ionic/vue';
import TabPageLayout from '@/layouts/TabPageLayout.vue';

const router = useRouter();

const refresh = (event) => {
    router.push('/');

    // If called from ion-refresher, complet it's event.
    if(event && event.type == 'ion-refresh') {
        event.target.complete();
    }
}
</script>

<template>
    <TabPageLayout :title="$t('offline_page.offline')">
        <ion-refresher slot="fixed" @ionRefresh="refresh($event)">
            <ion-refresher-content />
        </ion-refresher>
        <div class="message">
            <h1>{{ $t('offline_page.you_are_offline') }}</h1>
            <p>{{ $t('offline_page.please_check_and_try_again') }}</p>
            <ion-button @click="refresh">{{ $t('offline_page.retry') }}</ion-button>
        </div>
    </TabPageLayout>
</template>

<style scoped lang="scss">
.message {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    padding: 16px;
    text-align: center;
    
    h1 {
        font-size: 24px;
        margin: 0;
        margin-bottom: 16px;
    }

    p {
        font-size: 16px;
        margin: 0;
        margin-bottom: 8px;
    }
}
</style>