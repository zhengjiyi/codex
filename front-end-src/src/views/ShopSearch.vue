<template>
  <div class="about-page">
    <div class="page-cover anim" :style="{backgroundImage: `url(${publicPath}frontend-assets/img/cover-shop.jpg)`}" data-effect="fadeIn" data-duration="2s">
    </div>
    <mu-breadcrumbs class="breadcrumbs white anim" data-effect="fadeInUp" data-duration="1s">
      <mu-breadcrumbs-item :to="{ params: {locale}, name: 'home' }">{{$t('nav.home')}}</mu-breadcrumbs-item>
      <mu-breadcrumbs-item disabled>{{$t('nav.shops')}}</mu-breadcrumbs-item>
    </mu-breadcrumbs>

    <div class="store-search">
      <mu-menu placement="bottom" style="width: 100%">
        <div class="search">
          <span>{{$t('shops.selectCountryAndCity')}}</span>
          <i class="iconfont icon-down"></i>
        </div>
        <mu-list slot="content">
          <mu-list-item :to="{ name: 'shop-list', params: { locale }}" button >
            <mu-list-item-title>{{ $t('shops.allCountry') }}</mu-list-item-title>
          </mu-list-item>
          <mu-list-item :to="{ name: 'shop-list', params: { locale }, query: {nation: item}}" button v-for="(item, index) in countries" :key="index">
            <mu-list-item-title>{{ item }}</mu-list-item-title>
          </mu-list-item>
        </mu-list>
      </mu-menu>

      <div class="links">
        <a @click="getLocation">{{$t('shops.searchNearby')}} &gt;</a>
        <router-link :to="{ params: {locale}, name: 'shop-list' }">{{$t('shops.searchAll')}} &gt;</router-link>
      </div>
    </div>

  </div>
</template>

<script>
import animateEle from '@/simple.animate';
import { fetchShops } from '@/api/index';

export default {
  async mounted() {
    await this.fetchData();
    this.$store.commit('toggleLoadingScene', 100);
    this.$nextTick(() => {
      animateEle(0);
    });
  },
  async beforeRouteUpdate(to, from, next) {
    await next();
    this.$store.commit('toggleLoadingScene', 60);
    await this.fetchData();
    this.$store.commit('toggleLoadingScene', 100);
    this.$nextTick(() => {
      animateEle(0);
    });
  },
  data() {
    return {
      cities: {},
      publicPath: process.env.BASE_URL,
    };
  },
  computed: {
    locale() {
      return this.$i18n.locale;
    },
    countries() {
      return Object.keys(this.cities);
    },
  },
  methods: {
    async fetchData() {
      const { city } = await fetchShops();
      this.cities = city;
    },
    getLocation() {
      const instance = this;
      AMap.plugin('AMap.CitySearch', () => {
        const citySearch = new AMap.CitySearch();
        citySearch.getLocalCity((status, result) => {
          if (status === 'complete' && result.info === 'OK') {
            // 查询成功，result即为当前所在城市信息
            console.log(result);
            instance.$router.push({ name: 'shop-list', params: { locale: instance.locale }, query: { city: result.city } });
          }
        });
      });
    },
  },
};
</script>

<style lang="less" scoped>
@import '../styles/vars.less';

.page-cover {
  width: 100%;
  height: 0;
  padding-top: 42.71%;
  background-color: #000;
  position: relative;
  box-sizing: border-box;
  overflow: hidden;
  background-position: center center;
  background-repeat: no-repeat;
  background-size: cover;
}

.sm {
  .page-cover { padding-top: 350px; }
}

.xs {
  .page-cover { padding-top: 320px; }
}

.breadcrumbs {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 1;
}


.sm, .xs {
  .breadcrumbs {
    padding-top: 100px;
  }
}

.container {
  @media (min-width: 1200px) {
    max-width: 960px;
  }
  @media (min-width: 1700px) {
    max-width: 1500px;
  }
}

.router-tabs {
  display: flex;
  justify-content: space-between;
  padding-top: 37px;
  padding-bottom: 33px;
  margin-left: auto;
  margin-right: auto;

  .link {
    display: block;
    font-size: 18px;
    padding: 12px 23px;
    color: #000;
    text-decoration: none;
    border-bottom: 1px solid #fff;

    &.active {
      border-color: #000;
    }
  }
}

.store-search {
  max-width: 430px;
  margin: 23% auto 0;
  color: #898989;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
}

.search {
  display: flex;
  justify-content: space-between;
  padding: 15px 8px;
  background-color: #fff;
}
.links {
  display: flex;
  justify-content: space-between;
  margin-top: 54px;

  a {
    cursor: pointer;
    color: #fff;
    text-decoration: none;
    font-weight: 500;

    &:hover {
      color: #e4bb95;
    }
  }
}

.md {
  .store-search {
    width: 60%;
  }
  .search {
    padding: 15px 10px;
  }
  .links {
    margin-top: 26px;
  }
}

.sm, .xs {
  .store-search {
    width: 80%;
    margin-top: 200px;
  }
  .search {
    padding: 15px 10px;
  }
  .links {
    margin-top: 33px;
  }
}

</style>
