<template>
  <div class="collections-page">
    <mu-breadcrumbs class="breadcrumbs black anim" data-effect="fadeInUp" data-duration="2s">
      <mu-breadcrumbs-item :to="{ params: { locale }, name: 'home' }">{{$t('nav.home')}}</mu-breadcrumbs-item>
      <mu-breadcrumbs-item :to="{ params: { locale }, name: 'shops' }">{{$t('nav.shops')}}</mu-breadcrumbs-item>
      <mu-breadcrumbs-item :to="{ params: { locale }, name: 'shop-list' }">{{$t('nav.allShops')}}</mu-breadcrumbs-item>
      <mu-breadcrumbs-item disabled>{{ store.shop }}</mu-breadcrumbs-item>
    </mu-breadcrumbs>

    <mu-container class="store">
      <img :src="store.img" alt="" class="cover">
      <h4 class="title">{{store.shop}}</h4>
      <p>
        <strong v-t="'shops.address'"></strong>
        {{store.address}}
      </p>
      <p>
        <strong v-t="'shops.tel'"></strong>
        {{store.tel}}
      </p>
      <p>
        <strong v-t="'shops.time'"></strong>
        {{store.offer_time}}
      </p>
    </mu-container>
  </div>
</template>

<script>
// import { mapState } from 'vuex';
import animateEle from '@/simple.animate';
import { fetchShopDetail } from '@/api/index';

export default {
  name: 'GoodsDetail',
  data() {
    return {
      store: {},
    };
  },
  computed: {
    locale() {
      return this.$i18n.locale;
    },
  },
  async beforeRouteUpdate(to, from, next) {
    await next();
    await this.fetchData();
    this.$store.commit('toggleLoadingScene', 100);
    this.$nextTick(() => {
      animateEle(0);
    });
  },
  async mounted() {
    await this.fetchData();
    this.$store.commit('toggleLoadingScene', 100);
    this.$nextTick(() => {
      animateEle(0);
    });
  },
  methods: {
    async fetchData() {
      this.store = await fetchShopDetail(this.$route.params.id);
    },
  },
};
</script>

<style lang="less" scoped>
.store {
  @media (min-width: 1200px) {
    max-width: 996px;
  }

  text-align: left;
  padding-top: 75px;
  padding-bottom: 60px;
  overflow: hidden;

  .cover {
    width: 480px;
    float: right;
    margin-left: 24px;
  }

  .title {
    font-size: 25px;
    color: #4a5370;
    line-height: 2em;
    margin-bottom: 48px;
  }

  p {
    line-height: 2em;
    margin-bottom: 1em;

    strong {
      font-size: 18px;
      color: #000;
      font-weight: 500;
      display: block;
      line-height: 1em;
    }
  }
}

.md {
  .store {
    padding-top: 37;
    padding-bottom: 30px;

    .cover {
      width: 300px;
      margin-left: 24px;
    }

    .title {
      font-size: 18px;
      margin-bottom: 48px;
    }

    p {
      strong {
        font-size: 15px;
      }
    }
  }
}

.sm, .xs {
  .store {
    padding-top: 24px;
    padding-bottom: 15px;

    .cover {
      width: 100%;
      float: none;
      margin-left: 0;
    }

    .title {
      font-size: 15px;
      margin-bottom: 12px;
    }

    p {
      strong {
        font-size: 14px;
      }
    }
  }

}
</style>
