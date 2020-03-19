<template>
  <div class="home">
    <banner-section v-if="bannerItems.length > 0" :items="bannerItems"></banner-section>
    <intro-section></intro-section>
    <series-section :items="goodsSeries"></series-section>
    <about-section></about-section>
    <news-section :items="newsList"></news-section>
    <store-section></store-section>
  </div>
</template>

<script>
import { mapState } from 'vuex';
import BannerSection from './BannerSection.vue';
import IntroSection from './IntroSection.vue';
import AboutSection from './AboutSection.vue';
import StoreSection from './StoreSection.vue';
import NewsSection from './NewsSection.vue';
import SeriesSection from './SeriesSection.vue';
import { fetchBanner, fetchNews } from '@/api/index';
import animateEle from '@/simple.animate';

export default {
  name: 'home',
  components: {
    BannerSection, IntroSection, AboutSection, StoreSection, SeriesSection, NewsSection,
  },
  async beforeRouteUpdate(to, from, next) {
    await next();
    if (to.params.locale !== from.params.locale) {
      await this.fetchData();
    }
    this.$store.commit('toggleLoadingScene', 100);
    this.$nextTick(() => {
      animateEle(0);
    });
  },
  data() {
    return {
      bannerItems: [],
      newsList: [],
    };
  },
  computed: {
    ...mapState(['goodsSeries']),
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
      this.bannerItems = [];
      this.newsList = [];
      this.bannerItems = await fetchBanner();
      const newsRes = await fetchNews({ p: 1, limit: 3 });
      this.newsList = newsRes.data;
    },
  },
};
</script>

<style lang="less" scoped>
@import '../../styles/vars.less';
</style>
