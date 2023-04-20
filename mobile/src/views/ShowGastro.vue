<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { onIonViewWillEnter, toastController, IonCardTitle, IonCardSubtitle, IonCardContent, IonButtons, IonBackButton, IonButton, IonIcon } from '@ionic/vue';
import { shareSocialOutline } from 'ionicons/icons';
import to from 'await-to-js';
import { Share } from '@capacitor/share';
import { useI18n } from 'vue-i18n';
import { Gastro } from '@/types/gastro';
import { getGastro } from '@/http/gastro';
import TabPageLayout from '@/layouts/TabPageLayout.vue';

const route = useRoute();
const { t } = useI18n();

const gastroSlug = ref<string>(route.params.slug as string);
const gastro = ref<Gastro|null>();
const gastroLoading = ref(false); // Used for showing skeleton loaders.
const canShare = ref(false);

// Fetch the gastro from the backend.
const fetchGastro = async () => {
    gastroLoading.value = true;
    const [error, gastroResponse] = await to(getGastro(gastroSlug.value));
    gastroLoading.value = false;

    if(error) {
        gastro.value = null;
        toastController.create({
            message: t('gastro_page.failed_to_load'),
            duration: 2000,
            color: 'danger',
        }).then(toast => toast.present());
    } else {
        gastro.value = gastroResponse.gastro;
    }
};

// Check is navigator.share available.
const checkCanShare = async () => {
    canShare.value = (await Share.canShare()).value;
};

// Share the gastro.
const share = async () => {
    if(!gastro.value) return;

    await Share.share({
        title: gastro.value.name,
        url: gastro.value.url || '',
        dialogTitle: t('share_with_friends'),
    });
}

onMounted(() => {
    checkCanShare();
});

// Fetch the gastro each time the page is visited, since Ionic caches views so onMounted isn't called every time.
onIonViewWillEnter(() => {
    gastroSlug.value = route.params.slug as string;
    fetchGastro();
});
</script>

<template>
    <TabPageLayout :title="gastro?.name || t('gastro_page.gastronomy')">
        <template #toolbar-start>
            <ion-buttons slot="start">
                <ion-back-button default-href="/" />
            </ion-buttons>
        </template>
        <template v-if="canShare" #toolbar-end>
            <ion-buttons slot="end">
                <ion-button @click="share">
                    <ion-icon :icon="shareSocialOutline" />
                </ion-button>
            </ion-buttons>
        </template>
        <div v-if="gastro">
            <img v-if="gastro.image_url" :src="gastro.image_url" />
            <div class="container">
                <ion-card-title>{{ gastro.name }}</ion-card-title>
                <ion-card-subtitle>{{ gastro.location }}</ion-card-subtitle>
                <div class="separator" />
                <ion-card-content>
                    <div class="content" v-html="gastro.content" />
                </ion-card-content>
                <div class="separator" />
                <ion-card-content class="buttons">
                    <ion-button :href="`https://www.google.com/maps/dir/${encodeURIComponent(gastro.location)}`" target="_blank" fill="outline" expand="block">
                        {{ $t('get_directions') }}
                    </ion-button>
                    <ion-button v-if="gastro.website_link" :href="gastro.website_link" target="_blank" fill="outline" expand="block">
                        {{ $t('view_website') }}
                    </ion-button>
                </ion-card-content>
            </div>
        </div>
    </TabPageLayout>
</template>

<style scoped lang="scss">
.container {
    padding: 16px;

    ion-card-title {
        margin-bottom: 8px;
    }

    ion-card-content {
        padding: 0;

        .content {
            ::v-deep img {
                height: auto;
            }
        }
    }

    .buttons {
        display: flex;
        gap: 8px;

        ion-button {
            flex: 1;
        }
    }
}

.separator {
    margin: 12px 0;
}
</style>