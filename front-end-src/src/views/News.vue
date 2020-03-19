<template>
  <div class="about-page">
    <div class="page-cover anim" :style="{backgroundImage: `url(${publicPath}frontend-assets/img/cover-about.jpg)`}" data-effect="fadeIn" data-duration="2s">
    </div>
    <mu-breadcrumbs class="breadcrumbs white anim" data-effect="fadeInUp" data-duration="1s">
      <mu-breadcrumbs-item :to="{ params: {locale}, name: 'home' }">{{$t('nav.home')}}</mu-breadcrumbs-item>
      <mu-breadcrumbs-item :to="{ params: {locale}, name: 'history' }">{{$t('nav.about')}}</mu-breadcrumbs-item>
      <mu-breadcrumbs-item disabled>{{$t(`nav.${$route.name}`)}}</mu-breadcrumbs-item>
    </mu-breadcrumbs>
    <mu-container class="container">
      <div class="router-tabs">
        <router-link class="link" active-class="active" :to="{ params: {locale}, name: 'history' }">{{$t('nav.history')}}</router-link>
        <router-link class="link" active-class="active" :to="{ params: {locale}, name: 'craft' }">{{$t('nav.craft')}}</router-link>
        <router-link class="link" active-class="active" :to="{ params: {locale}, name: 'news' }">{{$t('nav.news')}}</router-link>
      </div>
    </mu-container>
    <mu-container class="news-section">
      <h2 class="section-title">{{$t('nav.news')}}</h2>
      <mu-row gutter>
        <mu-col span="12" md="4" :lg="item.head ? 12 : 4" v-for="item in newsList" :key="item.id">
          <router-link
            :class="['news-card', item.head && 'head' ]"
            :to="{ name: 'news-detail', params: {id: item.id, locale}}"
          >
            <mu-col span="12" :lg="item.head ? 8 : 12" class="pic-box">
              <div
                class="pic"
                :style="{backgroundImage: `url(${item.img})`}"
              ></div>
            </mu-col>
            <mu-col span="12" :lg="item.head ? 4 : 12" class="text">
              <div class="time">{{item.pub_date}}</div>
              <div class="title">{{item.title}}</div>
            </mu-col>
          </router-link>
        </mu-col>
      </mu-row>
      <div v-if="total > p * limit" class="more-btn" @click="loadMore">查看更多</div>
    </mu-container>
  </div>
</template>

<script>
import animateEle from '@/simple.animate';
// import NewsSection from './home/NewsSection.vue';
import { fetchNews } from '@/api/index';

export default {
  // components: { NewsSection },
  updated() {
    this.$store.commit('toggleLoadingScene', 100);
    this.$nextTick(() => {
      animateEle(0);
    });
  },
  computed: {
    locale() {
      return this.$i18n.locale;
    },
  },
  data() {
    return {
      publicPath: process.env.BASE_URL,
      newsList: [],
      limit: 10,
      p: 1,
      total: 0,
      loading: false,
    };
  },
  async mounted() {
    this.loading = true;
    const { data, total } = await fetchNews({
      limit: this.limit,
      p: this.p,
    });
    this.loading = false;
    data[0].head = true;
    this.newsList = data;
    this.total = total;
    this.$store.commit('toggleLoadingScene', 100);
    this.$nextTick(() => {
      animateEle(0);
    });
  },
  methods: {
    async loadMore() {
      if (this.loading) return;
      this.loading = true;
      this.p = this.p + 1;
      const { data, total } = await fetchNews({
        limit: this.limit,
        p: this.p,
      });
      this.loading = false;
      this.newsList = [...this.newsList, ...data];
      this.total = total;
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
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
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
  padding-top: 2em;
  padding-bottom: 1.5em;
  margin-left: auto;
  margin-right: auto;

  .link {
    display: block;
    padding: 0.6em 1.3em;
    color: #000;
    text-decoration: none;
    border-bottom: 1px solid #fff;

    &.active {
      border-color: #000;
    }
  }
}

.news-section {
  @media (min-width: 1200px) {
    max-width: 996px;
  }
  @media (min-width: 1700px) {
    max-width: 1500px;
  }
  padding-top: 30px;
  padding-bottom: 60px;

  .more-btn {
    margin-top: 40px;
    margin-right: auto;
    margin-left: auto;
  }
}

.xs, .sm {
  .news-section {
    padding-top: 15px;
    padding-bottom: 40px;

    .more-btn {
      margin-top: 30px;
    }
  }
}

.news-card {
  display: block;
  text-align: left;
  cursor: pointer;
  text-decoration: none;
  overflow: hidden;
  margin-bottom: 20px;

  &:hover {
    .pic {
      transform: translate(-50%, -50%) scale(1.1);
    }

    .title {
      position: relative;
      transition: all 0.5s;
    }
  }
}

.pic-box {
  width: 100%;
  height: 0;
  padding-top: 62.38%;
  overflow: hidden;
  position: relative;
}

.pic {
  position: absolute;
  top: 50%;
  left: 50%;
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
  width: 100%;
  height: 100%;
  transform: translate(-50%, -50%);
  transition: all 0.5s;
}

.time {
  color: #57585a;
  margin-top: 15px;
  margin-bottom: 7.5px;
}

.title {
  color: #18181c;
  line-height: 1.75em;
}

.lg, .xl {
  .head.news-card {
    display: flex;
    background-color: #000;
    height: 322px !important;

    .pic-box {
      padding-top: 0;
      height: 100%;
      box-sizing: border-box;
    }

    .text {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      padding: 20px;
      text-align: center;

      .time {
        color: #fff;
        margin-bottom: 50px;
        margin-top: 0;
      }

      .title {
        color: #fff;
      }
    }
  }
}

.sm, .xs {
  .time {
    margin-top: 8px;
    margin-bottom: 3px;
  }
}
</style>
