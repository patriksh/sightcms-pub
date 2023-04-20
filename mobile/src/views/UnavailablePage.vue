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
    <TabPageLayout :title="$t('unavailable_page.unavailable')">
        <ion-refresher slot="fixed" @ionRefresh="refresh($event)">
            <ion-refresher-content />
        </ion-refresher>
        <div class="message">
            <h1>{{ $t('unavailable_page.application_unavailable') }}</h1>
            <p>{{ $t('unavailable_page.app_is_currently_unavailable') }}</p>
            <p>{{ $t('unavailable_page.please_try_again_later') }}</p>
            <ion-button @click="refresh">{{ $t('unavailable_page.retry') }}</ion-button>
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