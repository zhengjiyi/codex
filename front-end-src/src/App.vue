<template>
  <div id="app" :class="[size, locale]" v-resize="resize" v-scroll="scroll">
    <layout-header :dark="$route.meta.darkHeader" :stick="stick" />
    <router-view class="page" />
    <layout-footer :goods-series="goodsSeries" />
    <layout-drawer :goods-series="goodsSeries" />
    <search-dialog></search-dialog>
    <tips-dialog></tips-dialog>
    <mu-slide-right-transition>
      <mu-button @click="scrollToTop(700)" v-if="scrollTop > 100" class="back-to-top" fab color="#e4bb95">
        <mu-icon value="arrow_upward"></mu-icon>
      </mu-button>
    </mu-slide-right-transition>
    <loading-scene></loading-scene>
  </div>
</template>

<script>
import { mapMutations, mapState } from 'vuex';
import LayoutHeader from './components/LayoutHeader';
import LayoutFooter from './components/LayoutFooter';
import LayoutDrawer from './components/LayoutDrawer';
import LoadingScene from './components/LoadingScene';
import SearchDialog from './components/SearchDialog';
import TipsDialog from './components/TipsDialog';
import animateEle from './simple.animate';

export default {
  name: 'codex-web',
  components: {
    LayoutDrawer, LayoutHeader, LayoutFooter, LoadingScene, SearchDialog, TipsDialog,
  },
  data() {
    return {
      size: '',
      stick: false,
      scrollTop: 0,
    };
  },
  computed: {
    ...mapState(['goodsSeries']),
    locale() {
      return this.$i18n.locale;
    },
  },
  async mounted() {
    this.resize();
  },
  watch: {
  },
  methods: {
    ...mapMutations(['updateSeries', 'updateTags']),
    resize() {
      const smw = 576;
      const mdw = 768;
      const lgw = 992;
      const xlw = 1200;
      const ww = window.innerWidth;

      if (ww >= xlw) {
        this.size = 'xl';
      } else if (ww >= lgw) {
        this.size = 'lg';
      } else if (ww >= mdw) {
        this.size = 'md';
      } else if (ww >= smw) {
        this.size = 'sm';
        this.stick = true;
      } else {
        this.size = 'xs';
        this.stick = true;
      }
    },
    scroll() {
      const wy = window.scrollY;
      if (this.size !== 'xs' && this.size !== 'sm') this.stick = wy > 0;
      const diss = wy - this.scrollTop;
      if (Math.abs(diss) > 10) {
        this.scrollTop = wy;
        animateEle(wy);
      }
    },
    scrollToTop(scrollDuration) {
      const scrollHeight = window.scrollY;
      const scrollStep = Math.PI / (scrollDuration / 15);
      const cosParameter = scrollHeight / 2;
      let scrollCount = 0;
      let scrollMargin = 0;
      const scrollInterval = setInterval(() => {
        if (window.scrollY !== 0) {
          scrollCount += 1;
          scrollMargin = cosParameter - cosParameter * Math.cos(scrollCount * scrollStep);
          window.scrollTo(0, (scrollHeight - scrollMargin));
        } else {
          clearInterval(scrollInterval);
        }
      }, 15);
    },
  },
};
</script>

<style lang="less">
.back-to-top {
  position: fixed;
  z-index: 10;
}

.cn, .en {
  color: #000;
}

.sm, .xs {
  .back-to-top {
    bottom: 40px;
    right: 20px;
  }
}

.md, .lg {
  .back-to-top {
    bottom: 40%;
    right: 30px;
  }
}

.xl {
  .back-to-top {
    bottom: 40%;
    // right: 50%;
    // margin-right: -560px;
    right: 50px;
  }
}

.article .content {
  img {
    max-width: 100%;
    display: block;
  }
}

.xl .hxl { display: none; }
.lg .hlg { display: none; }
.md .hmd { display: none; }
.sm .hsm { display: none; }
.xs .hxs { display: none; }
</style>
