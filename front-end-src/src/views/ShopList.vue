<template>
  <div class="collections-page">
    <mu-breadcrumbs class="breadcrumbs black anim" data-effect="fadeInUp" data-duration="2s">
      <mu-breadcrumbs-item :to="{ params: {locale}, name: 'home' }">{{$t('nav.home')}}</mu-breadcrumbs-item>
      <mu-breadcrumbs-item :to="{ params: {locale}, name: 'shops' }">{{$t('nav.shops')}}</mu-breadcrumbs-item>
      <mu-breadcrumbs-item :to="{ params: {locale}, name: 'shop-list' }" replace>{{$t('nav.allShops')}}</mu-breadcrumbs-item>
      <mu-breadcrumbs-item :to="{ params: {locale}, name: 'shop-list', query: { nation: nation } }" replace v-if="!!nation">{{nation}}</mu-breadcrumbs-item>
      <mu-breadcrumbs-item :to="{ params: {locale}, name: 'shop-list', query: { nation: nation, city: city } }" replace v-if="!!city">{{city}}</mu-breadcrumbs-item>
    </mu-breadcrumbs>

    <mu-container class="shop-list-section">
      <mu-row gutter justify-content="center" class="filter">
        <mu-col span="4">
          <mu-select :placeholder="$t('btn.p_country')" class="select" filterable solo v-model="nation" full-width>
            <mu-option :label="$t('shops.allCountry')" value=""></mu-option>
            <mu-option v-for="item in countries" :key="item" :label="item" :value="item"></mu-option>
          </mu-select>
        </mu-col>
        <mu-col span="4">
          <mu-select :placeholder="$t('btn.p_city')" class="select" filterable solo v-model="city" full-width>
            <mu-option :label="$t('shops.allCity')" value=""></mu-option>
            <mu-option v-for="city in cityOptions" :key="city" :label="city" :value="city"></mu-option>
          </mu-select>
        </mu-col>
        <mu-col span="3" md="2">
          <mu-button class="search-btn" full-width flat repalce :to="{ name: 'shop-list', params: {locale}, query: { nation, city }}">{{$t('btn.search')}}</mu-button>
        </mu-col>
      </mu-row>

      <mu-row class="store-list-wrap" ref="storeListWrap">
        <mu-col span="12" md="6" class="store-list" ref="storeCities" v-for="(area, cityName) in shops" :key="cityName">
          <p class="city-title">{{cityName}}</p>
          <div class="store" v-for="shop in area.shop" :key="shop.id">
            <router-link :to="{ name: 'shop-detail', params: { id: shop.id, locale }}" class="name">{{shop.shop}}</router-link>
            <p class="address">{{shop.address}}</p>
            <p class="tel">{{shop.tel}}</p>
          </div>
          <router-link v-if="area.has_more" :to="{ name: 'shop-list', query: { city: keyword } }" class="more">{{$t('btn.more')}}</router-link>
        </mu-col>
      </mu-row>

    </mu-container>


  </div>
</template>

<script>
// import { mapState } from 'vuex';
// import Waterfall from 'vue-waterfall/lib/waterfall';
// import WaterfallSlot from 'vue-waterfall/lib/waterfall-slot';
import animateEle from '@/simple.animate';
import { fetchShops } from '@/api/index';

export default {
  name: 'GoodsDetail',
  // components: {
  //   Waterfall,
  //   WaterfallSlot,
  // },
  data() {
    return {
      initShops: {},
      shops: {},
      cities: {},
      nation: '',
      city: '',
    };
  },
  updated() {
    this.$refs.storeCities.forEach((city) => {
      console.log(city.offsetTop, city.offsetLeft);
    });
  },
  async beforeRouteUpdate(to, from, next) {
    await next();
    if (to.params.locale !== from.params.locale) {
      await this.fetchData();
      this.$store.commit('toggleLoadingScene', 50);
    }
    const { nation, city } = to.query;
    if (!nation && !city) {
      this.nation = '';
      this.city = '';
      this.shops = this.initShops;
    } else {
      this.city = city;
      this.nation = nation;
      await this.search();
    }
    this.$store.commit('toggleLoadingScene', 100);
    this.$nextTick(() => {
      animateEle(0);
    });
  },
  computed: {
    locale() {
      return this.$i18n.locale;
    },
    keyword() {
      return this.$route.query.keyword;
    },
    countries() {
      return Object.keys(this.cities) || [];
    },
    cityOptions() {
      return this.cities[this.nation] || [];
    },
  },
  async mounted() {
    await this.fetchData();
    this.$store.commit('toggleLoadingScene', 50);
    const { nation, city } = this.$route.query;
    if (!nation && !city) {
      this.nation = '';
      this.city = '';
      this.shops = this.initShops;
    } else {
      this.city = city;
      this.nation = nation;
      await this.search();
    }
    this.$store.commit('toggleLoadingScene', 100);
    this.$nextTick(() => {
      animateEle(0);
    });
  },
  methods: {
    async fetchData() {
      const { city, shop } = await fetchShops();
      this.shops = shop;
      this.initShops = shop;
      this.cities = city;
    },
    async search() {
      const { shop } = await fetchShops({
        nation: this.nation,
        city: this.city,
      });
      this.shops = shop;
    },
    selectCountry(val) {
      if (this.selectCountry === val) return;
      this.nation = val;
      this.city = '';
    },
    selectCity(val) {
      this.city = val;
    },
  },

};
</script>

<style lang="less" scoped>
.shop-list-section {
  @media (min-width: 1200px) {
    max-width: 996px;
  }
  // @media (min-width: 1700px) {
  //   max-width: 1500px;
  // }
}


.filter {
  margin-top: 40px;
  .select {
    display: inline-block;
    box-sizing: border-box;
    width: 100%;
    height: 60px;
    padding: 10px;
    border: 1px solid #000;
    vertical-align: top;
  }

  .search-btn {
    background-color: #000;
    color: #fff;
    border: 0;
    padding: 10px 0;
    font-size: 18px;
    width: 100%;
    height: 60px;
    box-sizing: border-box;
  }
}

.sm, .xs {
  .filter {
    margin-top: 30px;

    .select {
      display: inline-block;
      box-sizing: border-box;
      width: 100%;
      height: 40px;
      padding: 0px 0 0px 5px;
      border: 1px solid #000;
      vertical-align: top;
      box-sizing: border-box;
      font-size: 12px;
    }

    .search-btn {
      background-color: #000;
      color: #fff;
      border: 0;
      padding: 0px 0;
      font-size: 14px;
      width: 100%;
      height: 48px;
      box-sizing: border-box;
    }
  }

  .store-list {
    padding-top: 35px;
    padding-left: 15px;
    padding-right: 15px;

    .city-title {
      margin-bottom: 20px;
      font-size: 20px;
    }
    .store {
      margin-bottom: 15px;

      .name {
        font-size: 18px;
      }
    }
  }
}

.store-list {
  text-align: left;
  // padding-top: 55px;
  padding: 55px 20px 0;
}

.city-title {
  font-size: 24px;
  font-weight: bold;
  color: #000;
  margin-bottom: 40px;
}

.store {
  margin-bottom: 30px;
  display: inline-block;
  vertical-align: top;
  width: 100%;

  .name {
    font-size: 24px;
    color: #4a5370;
    line-height: 2em;
    text-decoration: none;

    &:hover {
      color: #000;
    }
  }

  .address,
  .tel {
    color: #57585a;
    line-height: 2em;
  }
}
</style>
