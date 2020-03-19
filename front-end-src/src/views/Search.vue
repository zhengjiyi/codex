<template>
  <div class="about-page">
    <div class="page-cover anim" :style="{backgroundImage: `url(${publicPath}frontend-assets/img/cover-search.png)`}" data-effect="fadeIn" data-duration="2s">
    </div>
    <mu-breadcrumbs class="breadcrumbs white anim" data-effect="fadeInUp" data-duration="1s">
      <mu-breadcrumbs-item :to="{ params: {locale}, name: 'home' }">{{$t('nav.home')}}</mu-breadcrumbs-item>
      <mu-breadcrumbs-item disabled>{{$t('nav.search')}}</mu-breadcrumbs-item>
    </mu-breadcrumbs>

    <form action="" class="search-form">
      <div class="field">
        <input v-model="keyword" type="text" placeholder="输入关键词">
        <div class="button" @click="handleSearch">
          <i class="iconfont icon-search"></i>
        </div>
      </div>
    </form>

    <mu-container ref="container" class="loadmore-content">
      <h2 class="section-title">{{$t('search.watch')}}</h2>
      <mu-row>
        <mu-col span="6" sm="4" md="4" lg="3" v-for="item in goodsList" :key="item.id">
          <router-link :to="{ name: 'product-detail', params: { id: item.id, seriesId: item.product_type, locale }}" class="goods-card">
            <div class="img-box">
              <div
                class="img"
                :style="{backgroundImage: `url(${item.img[0]})`}"
              ></div>
            </div>
            <div class="type">{{item.type}}</div>
            <div class="name">{{item.model}}</div>
            <div class="price">￥{{item.price}}</div>
          </router-link>
        </mu-col>
      </mu-row>
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
    </mu-container>
  </div>
</template>

<script>
import animateEle from '@/simple.animate';
import { fetchSearch } from '@/api/index';

export default {
  computed: {
    locale() {
      return this.$i18n.locale;
    },
  },
  async beforeRouteUpdate(to, from, next) {
    await next();
    this.$store.commit('toggleLoadingScene', 100);
    this.$nextTick(() => {
      animateEle(0);
    });
  },
  data() {
    return {
      keyword: this.$route.query.keyword,
      goodsList: [],
      newsList: [],
      publicPath: process.env.BASE_URL,
    };
  },
  async mounted() {
    await this.handleSearch();
    this.$store.commit('toggleLoadingScene', 100);
    this.$nextTick(() => {
      animateEle(0);
    });
  },
  methods: {
    async handleSubmit() {
      this.$router.replace({ ...this.$route, query: { ...this.$route.query, keyword: this.keyword } });
    },
    async handleSearch() {
      const { product, news } = await fetchSearch(this.keyword);
      this.goodsList = product;
      this.newsList = news;
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

.news-section, .loadmore-content {
  @media (min-width: 1200px) {
    max-width: 996px;
  }
  @media (min-width: 1700px) {
    max-width: 1500px;
  }
  padding-top: 60px;
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


.goods-card {
  box-sizing: border-box;
  text-align: center;
  text-decoration: none;
  display: block;
  position: relative;
  overflow: hidden;
  cursor: pointer;
  color: #332c2b;
  transition: all 0.5s;
  margin-top: 30px;
  padding-bottom: 15px;

  &:hover::after {
    left: 0;
  }

  &::after {
    content: "";
    display: block;
    left: -100%;
    top: 0;
    width: 100%;
    height: 100%;
    position: absolute;
    background: rgba(0,0,0,0.1);
    transition: all 0.5s;
  }

  .img-box {
    overflow: hidden;
    height: 0;
    width: 100%;
    padding-bottom: 140%;
    position: relative;

    .img {
      background-repeat: no-repeat;
      background-size: contain;
      background-position: center center;
      width: 100%;
      height: 100%;
      position: absolute;
      top: 0;
      left: 0;
    }
  }

  .type {
    margin-top: 5px;
    margin-bottom: 4px;
    color: #595757;
  }

  .name, .price {
    font-size: 1.1em;
    line-height: 1.5em;
  }
}

.sm, .xs {
  .search-form {
    margin: -70px auto 30px;
  }
}

.search-form {
  position: relative;
  z-index: 1;
  background-color: #fff;
  width: 340px;
  margin: -100px auto 100px;

  .button {
    display: block;
    box-sizing: border-box;
    text-align: center;
    font-size: 16px;
    color: #fff;
    padding: 10px 15px;
    background-color: #0b0b0b;
    cursor: pointer;
    outline: none;
    border: none;

    .iconfont {
      font-size: 18px;
    }
  }

  .field {
    border: 1px solid #000;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    background-color: #fff;
  }

  input {
    font-size: 16x;
    line-height: 1em;
    border: none;
    padding: 12px 7px;
    color: #57585a;
    flex: 1;
    outline-color: #e4bb95;
  }
}
</style>
