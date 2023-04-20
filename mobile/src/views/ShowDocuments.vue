<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { toastController, IonInfiniteScroll, IonInfiniteScrollContent, InfiniteScrollCustomEvent, IonButtons, IonBackButton } from '@ionic/vue';
import to from 'await-to-js';
import { useI18n } from 'vue-i18n';
import { DocumentCategory, Document } from '@/types/document';
import { getDocumentCategories, getDocuments } from '@/http/document';
import TabPageLayout from '@/layouts/TabPageLayout.vue';
import CategoryChips from '@/components/CategoryChips.vue';
import DocumentList from '@/components/DocumentList.vue';

const route = useRoute();
const { t } = useI18n();

const documentCategories = ref<DocumentCategory[]>([]);
const categoriesLoading = ref(false);
const documents = ref<Document[]>([]);
const documentsLoading = ref(false); // Used for showing skeleton loaders.
const documentCategorySlug = ref<string | undefined>();
const documentPage = ref(0);
const documentTotal = ref(0);

// Fetch all document categories from the backend.
const fetchCategories = async () => {
    categoriesLoading.value = true;
    const [error, categoryResponse] = await to(getDocumentCategories());
    categoriesLoading.value = false;

    if(error) {
        documentCategories.value = [];
    } else {
        documentCategories.value = categoryResponse.categories;
    }
};

// Fetch documents from the backend.
const fetchDocuments = async () => {
    documentsLoading.value = true;
    const [error, documentResponse] = await to(getDocuments(documentCategorySlug.value));
    documentsLoading.value = false;

    if(error) {
        documents.value = [];
    } else {
        documents.value = documentResponse.documents.data;
        documentPage.value = documentResponse.documents.current_page;
        documentTotal.value = documentResponse.documents.total;
    }
};

// Refetch documents when the category changes.
const onChangeCategory = async (slug?: string) => {
    documentCategorySlug.value = slug || undefined;
    fetchDocuments();
};

// Fetch more documents when the user scrolls to the bottom of the page.
const onInfiniteScroll = async (e: InfiniteScrollCustomEvent) => {
    if(documents.value.length < documentTotal.value) {
        documentPage.value += 1;

        const [error, documentResponse] = await to(getDocuments(documentCategorySlug.value, documentPage.value));

        if(error) {
            documentPage.value -= 1;
            return toastController.create({
                message: t('documents_page.failed_to_load'),
                duration: 2000,
                color: 'danger'
            }).then(toast => toast.present());
        } else {
            documents.value = [...documents.value, ...documentResponse.documents.data];
        }
    }

    e.target.complete();
};

onMounted(() => {
    // Apply the category from route params if it exists (for deeplinks).
    if(route.params.category) {
        documentCategorySlug.value = route.params.category as string;
    }

    fetchCategories();
    fetchDocuments();
});
</script>

<template>
    <TabPageLayout :title="t('documents_page.documents')">
        <template #toolbar-start>
            <ion-buttons slot="start">
                <ion-back-button default-href="/" />
            </ion-buttons>
        </template>
        <CategoryChips :categories="documentCategories" :active-slug="documentCategorySlug" :loading="categoriesLoading" @change="onChangeCategory" />
        <div class="separator" />
        <DocumentList :documents="documents" :loading="documentsLoading" />
        <ion-infinite-scroll @ionInfinite="onInfiniteScroll">
            <ion-infinite-scroll-content></ion-infinite-scroll-content>
        </ion-infinite-scroll>
    </TabPageLayout>
</template>

<style scoped lang="scss">
.separator {
    margin: 12px 10px 18px 10px;
}

.ios {
    .separator {
        margin: 16px;
    }
}
</style>