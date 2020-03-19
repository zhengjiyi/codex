import Vue from 'vue';
import Router from 'vue-router';
import MtaH5 from 'mta-h5-analysis';

import SimpleLayout from './components/SimpleLayout.vue';
import store from './store';
import i18n from './i18n';

import Home from './views/home/index.vue';
import Collections from './views/Collections.vue';
import Goods from './views/Goods.vue';
import { fetchGoodsSeries, fetchTags } from './api/index';


Vue.use(Router);

const routes = [
  {
    path: '/',
    redirect: '/en/home',
  },
  {
    path: '/:locale',
    name: 'locale',
    redirect: 'home',
    component: SimpleLayout,
    children: [{
      path: 'home',
      name: 'home',
      component: Home,
    },
    {
      path: 'products',
      redirect: 'products/all',
    },
    {
      path: 'products/:seriesId',
      name: 'products',
      component: Collections,
    },
    {
      path: 'products/:seriesId/:id',
      name: 'product-detail',
      component: Goods,
      meta: { darkHeader: true },
    },
    {
      path: 'about',
      name: 'about',
      redirect: 'history',
    },
    {
      path: 'history',
      name: 'history',
      component: () => import('./views/History.vue'),
    },
    {
      path: 'craft',
      name: 'craft',
      component: () => import('./views/Craft.vue'),
    },
    {
      path: 'search',
      name: 'search',
      component: () => import('./views/Search.vue'),
    },
    {
      path: 'news',
      name: 'news',
      component: () => import('./views/News.vue'),
    },
    {
      path: 'news/:id',
      name: 'news-detail',
      meta: { darkHeader: true },
      component: () => import('./views/NewsDetail.vue'),
    },
    {
      path: 'services',
      name: 'services',
      redirect: 'after-sales',
    },
    {
      path: 'after-sales',
      name: 'after-sales',
      component: () => import('./views/AfterSales.vue'),
    },
    {
      path: 'legal',
      name: 'legal',
      component: () => import('./views/Legal.vue'),
    },
    {
      path: 'questions',
      name: 'questions',
      component: () => import('./views/Questions.vue'),
    },
    {
      path: 'contact',
      name: 'contact',
      component: () => import('./views/Contact.vue'),
    },
    {
      path: 'shops',
      name: 'shops',
      component: () => import('./views/ShopSearch.vue'),
    },
    {
      path: 'shops/:id',
      name: 'shop-detail',
      meta: { darkHeader: true },
      component: () => import('./views/ShopDetail.vue'),
    },
    {
      path: 'shop-list',
      name: 'shop-list',
      meta: { darkHeader: true },
      component: () => import('./views/ShopList.vue'),
    }],
  },
];

const router = new Router({
  routes,
  scrollBehavior() {
    return {
      x: 0,
      y: 0,
    };
    // return 期望滚动到哪个的位置
    // if (savedPosition) {
    //   return savedPosition;
    // }
    // const position = {};
    // if (to.hash) {
    //   position.selector = to.hash;

    //   if (document.querySelector(to.hash)) {
    //     return position;
    //   }

    //   // if the returned position is falsy or an empty object,
    //   // will retain current scroll position.
    //   return false;
    // }
    // return new Promise((resolve) => {
    //   // check if any matched route config has meta that requires scrolling to top
    //   // if (to.matched.some(m => m.meta.scrollToTop)) {
    //   // coords will be used if no selector is provided,
    //   // or if the selector didn't match any element.
    //   position.x = 0;
    //   position.y = 0;
    //   // }

    //   // wait for the out transition to complete (if necessary)
    //   this.app.$root.$once('triggerScroll', () => {
    //     // if the resolved position is falsy or an empty object,
    //     // will retain current scroll position.
    //     resolve(position);
    //   });
    // });
  },
});

router.beforeEach(async (to, from, next) => {
  // 跳转页面前关闭侧边栏
  store.commit('setDrawer', { visible: false });
  if (to.params.locale !== from.params.locale) {
    i18n.locale = to.params.locale;
    store.commit('toggleLoadingScene', 0);
    const goodsSeries = await fetchGoodsSeries();
    store.commit('updateSeries', goodsSeries);
    store.commit('toggleLoadingScene', 20);
    const typeTags = await fetchTags();
    store.commit('updateTags', typeTags);
    store.commit('toggleLoadingScene', 40);
    setTimeout(() => {
      next();
    }, 300);
  } else if (to.name !== from.name) {
    store.commit('toggleLoadingScene', 0);
    setTimeout(() => {
      next();
    }, 300);
  } else {
    next();
  }
});

router.afterEach(() => {
  if (process.env.NODE_ENV === 'production') {
    MtaH5.pgv();
  }
});

router.onReady(() => {
  // 加载路由后隐藏 loadingScene
  store.commit('toggleLoadingScene', 100);
});

export default router;
