<template>
  <div class="collections-page">
    <mu-breadcrumbs class="breadcrumbs black anim" data-effect="fadeInUp" data-duration="2s">
      <mu-breadcrumbs-item :to="{ params: {locale}, name: 'home' }">{{$t('nav.home')}}</mu-breadcrumbs-item>
      <mu-breadcrumbs-item :to="{ params: {locale}, name: 'news' }">{{$t('nav.news')}}</mu-breadcrumbs-item>
      <mu-breadcrumbs-item disabled>{{news.title}}</mu-breadcrumbs-item>
    </mu-breadcrumbs>

    <mu-container class="prev-next">
      <router-link v-if="prevId" class="prev anim" data-effect="fadeInRight" data-duration="2s" :to="{ name: 'news-detail', params: {id: prevId, locale}}"><i class="iconfont icon-left"></i> {{$t('btn.prev')}}</router-link>
      <router-link v-if="nextId" class="next anim" data-effect="fadeInLeft" data-duration="2s" :to="{ name: 'news-detail', params: {id: nextId, locale}}">{{$t('btn.next')}} <i class="iconfont icon-right"></i></router-link>
    </mu-container>

    <mu-container class="article news">
      <div class="cover">
        <img :src="news.img" alt="">
      </div>
      <span class="time">{{news.pub_date}}</span>
      <h1 class="title">{{news.title}}</h1>
      <section class="content" v-html="news.content"></section>
    </mu-container>
  </div>
</template>

<script>
// import { mapState } from 'vuex';
import animateEle from '@/simple.animate';
import { fetchNewsDetail } from '@/api/index';

export default {
  name: 'GoodsDetail',
  data() {
    return {
      news: {},
      nextId: '',
      prevId: '',
    };
  },
  computed: {
    locale() {
      return this.$i18n.locale;
    },
  },
  async beforeRouteUpdate(to, from, next) {
    if (to.params.id !== from.params.id) {
      this.$store.commit('toggleLoadingScene', 0);
    }
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
      const { news, next_id, prev_id } = await fetchNewsDetail(this.$route.params.id);
      this.news = news;
      this.nextId = next_id;
      this.prevId = prev_id;
    },
  },
};
</script>

<style lang="less" scoped>
.article {
  @media (min-width: 1200px) {
    max-width: 996px;
  }
  @media (min-width: 1700px) {
    max-width: 1500px;
  }
}

.news {
  text-align: left;

  .cover {
    display: block;
    width: 100%;
    overflow: hidden;
    margin-bottom: 48px;

    img {
      display: block;
      width: 100%;
      transform: scale(1);
      transition: all 0.5s;

      &:hover {
        transform: scale(1.1);
      }
    }
  }

  .time {
    font-size: 18px;
  }

  .title {
    font-size: 28px;
    margin-top: 7.5px;
    margin-bottom: 7.5px;
  }

  .content {
    border-top: 1px solid #000;
    margin-top: 24px;
    padding-bottom: 24px;
    padding-top: 30px;
  }
}

</style>
