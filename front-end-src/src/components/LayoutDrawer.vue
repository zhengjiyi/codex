<template>
  <mu-drawer
    id="layout-drawer"
    :class="{open}"
    ref="drawer"
    :style="{ paddingTop, paddingLeft }"
    :width="width"
    :open.sync="open" :docked="false"
  >
    <menu-btn dark :active="open" @click="close">{{$t('btn.menu')}}</menu-btn>
    <mu-divider class="divider" style="transition-delay: 0s;" />
    <router-link class="link" style="transition-delay: 0.2s;" :to="{ name: 'products', params: { seriesId: 'all', locale}}" @click.native="close">{{$t('nav.series')}}</router-link>

    <mu-row class="goods-series" style="transition-delay: 0.1s; transition-duration: 0.6s">
      <mu-col span="4" v-for="item in goodsSeries" :key="item.id">
        <router-link class="series" :to="{ name: 'products', params: { seriesId: item.id, locale}}" @click.native="close">
          <div class="image"><img :src="item.image" alt=""></div>
          <span>{{item.type_name}}</span>
        </router-link>
      </mu-col>
      <mu-col span="4">
        <router-link class="series" :to="{ name: 'products', params: { seriesId: 'all', locale}}" @click.native="close">
          <div class="image"><img :src="`${publicPath}frontend-assets/img/sidebar-1.png`" alt=""></div>
          <span>{{$t('nav.allGoods')}}</span>
        </router-link>
      </mu-col>
    </mu-row>

    <mu-divider class="divider" style="transition-delay: 0.2s;" />

    <router-link class="link" style="transition-delay: 0.2s;" :to="{ params: {locale}, name: 'history' }" @click.native="close">{{$t('nav.about')}}</router-link>
    <router-link class="link" style="transition-delay: 0.3s;" :to="{ params: {locale}, name: 'services' }" @click.native="close">{{$t('nav.services')}}</router-link>
    <router-link class="link" style="transition-delay: 0.4s;" :to="{ params: {locale}, name: 'contact' }" @click.native="close">{{$t('nav.contactUs')}}</router-link>
    <router-link class="link" style="transition-delay: 0.5s;" :to="{ params: {locale}, name: 'shops' }" @click.native="close">{{$t('nav.shops')}}</router-link>

    <mu-divider class="divider" style="transition-delay: 0.5s;" />

    <div class="social" style="transition-delay: 0.6s;">
      <a href="https://www.instagram.com/codexwatch/" target="_blank"><i class="iconfont icon-instagram"></i></a>
      <a href="https://www.facebook.com/codexwatch/" target="_blank"><i class="iconfont icon-facebook"></i></a>
      <a href="http://weibo.com/codexwatch2018" target="_blank"><i class="iconfont icon-weibo"></i></a>
      <mu-menu class="wechat" placement="top-start" open-on-hover>
        <a href=""><i class="iconfont icon-wechat"></i></a>
        <mu-paper slot="content" class="" :z-depth="1">
          <p style="text-align: center; padding: 10px 10px 0; margin: 0">{{ $t('tips.scanQR') }}</p>
          <img style="width: 220px; padding: 10px;" :src="`${publicPath}frontend-assets/img/qr.png`" alt="">
        </mu-paper>
      </mu-menu>
    </div>
  </mu-drawer>
</template>

<script>
import MenuBtn from './MenuBtn';
// import animateEle from '@/simple.animate';

export default {
  name: 'LayoutDrawer',
  components: { MenuBtn },
  props: {
    goodsSeries: Array,
  },
  data() {
    return {
      open: false,
      publicPath: process.env.BASE_URL,
    };
  },
  // watch: {
  //   open() {
  //     animateEle(window.innerHeight);
  //   },
  // },
  computed: {
    locale() {
      return this.$i18n.locale;
    },
    visible() {
      return this.$store.state.drawer.visible;
    },
    paddingTop() {
      return `${this.$store.state.drawer.top}px`;
    },
    paddingLeft() {
      return `${this.$store.state.drawer.left}px`;
    },
    width() {
      const w = window.innerWidth > 1299 ? 360 : 300;
      return `${this.$store.state.drawer.left + w}px`;
    },
  },
  watch: {
    visible(val) {
      if (val !== this.open) this.open = val;
    },
    open(val) {
      if (val !== this.visible) {
        this.$store.commit('setDrawer', { visible: val });
      }
    },
  },
  methods: {
    show() {
      this.$store.commit('setDrawer', { visible: true });
    },
    close() {
      this.$store.commit('setDrawer', { visible: false });
    },
  },
};
</script>

<style lang="less" scoped>
#layout-drawer {
  padding-right: 30px;

  @media (min-width: 1300px) {
    padding-right: 90px;
  }

  .divider,
  .link,
  .goods-series,
  .social {
    position: relative;
    left: -150%;
    transition: left 0.5s, opacity 0.3s;
    opacity: 0;
  };

  &.open {
    .divider,
    .link,
    .goods-series,
    .social {
      left: 0;
      opacity: 1;
    };
  }

  .divider {
    margin: 23px 0;
  }

  .link {
    display: block;
    font-size: 18px;
    line-height: 2em;
    color: #7d6650;

    &:hover {
      color: #c18044;
    }
  }

  .goods-series {
    .series {
      display: block;
      text-align: center;
      margin-top: 20px;
      padding: 0 5px;
      color: #000;
      text-decoration: none;

      .image {
        position: relative;
        overflow: hidden;
        border: 1px solid #a6a7a8;
        width: 100%;
        height: 0;
        padding-bottom: 110%;
        box-sizing: border-box;
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
      }

      img {
        display: block;
        transform: translate(-50%, -50%) scale(1);
        transition: all 0.5s;
        width: 100%;
        position: absolute;
        top: 50%; left: 50%;
      }

      span {
        line-height: 1.5em;
        font-size: 12px;
      }

      &:hover {
        img {
          transform: translate(-50%, -50%) scale(1.1);
        }
      }
    }
  }

  .social {
    padding-top: 10px;
    padding-bottom: 25px;

    > a,
    .wechat a {
      display: inline-block;
      vertical-align: middle;
      text-decoration: none;
      color: #57585a;
      margin-right: 15px;

      &:hover {
        color: #c18044;
      }

      .iconfont {
        font-size: 26px;
      }
    }
  }
}

.xs {
  #layout-drawer {
    padding-right: 8px;

    .divider {
      margin: 16px 0;
    }

    .link {
      font-size: 16px;
    }

    .goods-series {
      .series {
        margin-top: 15px;
      }
    }

    .social {
      padding-top: 7.5px;
      padding-bottom: 18px;

      > a {
        text-decoration: none;
        color: #57585a;
        margin-right: 12px;

        &:hover {
          color: #c18044;
        }

        .iconfont {
          font-size: 26px;
        }
      }
    }
  }
}
</style>
