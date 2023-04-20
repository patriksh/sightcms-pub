import { createRouter, createWebHistory } from '@ionic/vue-router';
import { RouteRecordRaw } from 'vue-router';
import { usePreferencesStore } from '@/stores/preferences';
import { HttpError, OfflineError } from '@/errors/http';
import TabsPage from '@/views/TabOutlet.vue';

const routes: Array<RouteRecordRaw> = [
    {
        path: '/',
        redirect: '/tabs/articles'
    },
    {
        path: '/tabs/',
        component: TabsPage,
        children: [
            {
                path: '',
                redirect: '/tabs/articles'
            },
            {
                path: 'articles',
                name: 'tabs.articles',
                component: () => import('@/views/TabArticles.vue')
            },
            {
                path: 'articles/category/:category',
                name: 'tabs.articles.category',
                component: () => import('@/views/TabArticles.vue')
            },
            {
                path: 'articles/view/:slug',
                name: 'tabs.articles.show',
                component: () => import('@/views/ShowArticle.vue')
            },
            {
                path: 'events',
                name: 'tabs.events',
                component: () => import('@/views/TabEvents.vue')
            },
            {
                path: 'events/view/:slug',
                name: 'tabs.events.show',
                component: () => import('@/views/ShowEvent.vue')
            },
            {
                path: 'more',
                name: 'more',
                component: () => import('@/views/TabMore.vue')
            },
            {
                path: 'more/documents',
                name: 'tabs.more.documents',
                component: () => import('@/views/ShowDocuments.vue')
            },
            {
                path: 'more/documents/category/:category?',
                name: 'tabs.more.documents.category',
                component: () => import('@/views/ShowDocuments.vue')
            },
            {
                path: 'more/attractions',
                name: 'tabs.more.attractions',
                component: () => import('@/views/ShowAttractions.vue')
            },
            {
                path: 'more/attractions/category/:category?',
                name: 'tabs.more.attractions.category',
                component: () => import('@/views/ShowAttractions.vue')
            },
            {
                path: 'more/attractions/view/:slug',
                name: 'tabs.more.attractions.show',
                component: () => import('@/views/ShowAttraction.vue')
            },
            {
                path: 'more/gastronomy',
                name: 'tabs.more.gastronomy',
                component: () => import('@/views/ShowGastros.vue')
            },
            {
                path: 'more/gastronomy/category/:category?',
                name: 'tabs.more.gastronomy.category',
                component: () => import('@/views/ShowGastros.vue')
            },
            {
                path: 'more/gastronomy/view/:slug',
                name: 'tabs.more.gastronomy.show',
                component: () => import('@/views/ShowGastro.vue')
            },
            {
                path: 'more/audio-tours',
                name: 'tabs.more.audio-tours',
                component: () => import('@/views/ShowAudioTours.vue')
            },
            {
                path: 'more/audio-tours/view/:slug',
                name: 'tabs.more.audio-tours.show',
                component: () => import('@/views/ShowAudioTour.vue')
            },
            {
                path: 'more/page/view/:slug',
                name: 'tabs.more.page.show',
                component: () => import('@/views/ShowPage.vue')
            },
        ]
    },
    {
        path: '/unavailable',
        component: () => import('@/views/UnavailablePage.vue')
    },
    {
        path: '/offline',
        component: () => import('@/views/OfflinePage.vue')
    }
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
});

router.beforeEach(async (to) => {
    // Check if the user is offline or the API is unavailable.
    if(to.path !== '/offline' && to.path !== '/unavailable') {
        try {
            await usePreferencesStore().fetch();
        } catch(error) {
            if(error instanceof HttpError) {
                return { path: '/unavailable' };
            }

            if(error instanceof OfflineError) {
                return { path: '/offline' };
            }
        }
    }
});

export default router;
