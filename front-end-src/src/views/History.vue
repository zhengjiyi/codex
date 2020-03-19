<template>
  <div class="about-page">
    <div class="page-cover anim" :style="{backgroundImage: `url(${publicPath}frontend-assets/img/cover-about.jpg)`}" data-effect="fadeIn" data-duration="2s">
    </div>
    <mu-breadcrumbs class="breadcrumbs white anim" data-effect="fadeInUp" data-duration="2s">
      <mu-breadcrumbs-item :to="{ params: {locale}, name: 'home' }">{{$t('nav.home')}}</mu-breadcrumbs-item>
      <mu-breadcrumbs-item :to="{ params: {locale}, name: 'history' }">{{$t('nav.about')}}</mu-breadcrumbs-item>
      <mu-breadcrumbs-item disabled>{{$t(`nav.${$route.name}`)}}</mu-breadcrumbs-item>
    </mu-breadcrumbs>
    <mu-container class="container anim" data-effect="fadeInUp" data-duration="2s">
      <div class="router-tabs">
        <router-link class="link" active-class="active" :to="{ params: {locale}, name: 'history' }">{{$t('nav.history')}}</router-link>
        <router-link class="link" active-class="active" :to="{ params: {locale}, name: 'craft' }">{{$t('nav.craft')}}</router-link>
        <router-link class="link" active-class="active" :to="{ params: {locale}, name: 'news' }">{{$t('nav.news')}}</router-link>
      </div>

      <div class="history">
        <article class="article">
          <section class="section right">
            <div class="img-box anim" data-effect="fadeInRight" data-duration="1s">
              <img :src="`${publicPath}frontend-assets/img/history-1.png`" />
            </div>
            <div class="text anim" data-effect="fadeInLeft" data-duration="1s">
              <p v-for="(item, index) in $t('history.desc')" :key="index">{{ item }}</p>
            </div>
          </section>
          <section class="section left">
            <div class="img-box img-box-3 anim" data-effect="fadeInLeft" data-duration="1s">
              <img :src="`${publicPath}frontend-assets/img/history-2.png`" />
            </div>
            <div class="text anim" data-effect="fadeInRight" data-duration="1s">
              <p v-for="(item, index) in $t('history.section1.desc')" :key="`1_${index}`">{{ item }}</p>
              <p v-for="(item, index) in $t('history.section2.desc')" :key="`2_${index}`">{{ item }}</p>
            </div>
          </section>
          <section class="section right">
            <div class="img-box anim" data-effect="fadeInRight" data-duration="1s">
              <img :src="`${publicPath}frontend-assets/img/history-3.png`" />
            </div>
            <div class="text anim" data-effect="fadeInLeft" data-duration="1s">
              <p v-for="(item, index) in $t('history.section3.desc')" :key="`3_${index}`">{{ item }}</p>
              <p v-for="(item, index) in $t('history.section4.desc')" :key="`4_${index}`">{{ item }}</p>
            </div>
          </section>
        </article>
      </div>
    </mu-container>

  </div>
</template>

<script>
import animateEle from '@/simple.animate';

export default {
  data() {
    return {
      publicPath: process.env.BASE_URL,
    };
  },
  computed: {
    locale() {
      return this.$i18n.locale;
    },
  },
  beforeRouteUpdate(to, from, next) {
    this.$store.commit('toggleLoadingScene', 100);
    next();
    this.$nextTick(() => {
      animateEle(0);
    });
  },
  mounted() {
    this.$store.commit('toggleLoadingScene', 100);
    this.$nextTick(() => {
      animateEle(0);
    });
  },
  methods: {
  },
};
</script>

<style lang="less" scoped>
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

.article {
  @media (min-width: 1200px) {
    max-width: 996px;
  }
  @media (min-width: 1700px) {
    max-width: 1500px;
  }
  width: 100%;
  margin-left: auto;
  margin-right: auto;
  position: relative;
  font-size: 16px;
  line-height: 1.75em;
  text-align: left;
  color: #231815;
  text-align: justify;
  padding-top: 33px;
  padding-bottom: 67px;

  header {
    text-align: center;
  }

  .img-box {
    flex: 1;
    overflow: hidden;
    img {
      width: 100%;
      display: block;
      transform: scale(1);
      transition: all 0.5s;
      margin: auto;

      &:hover {
        transform: scale(1.2)
      }
    }
  }

  .section {
    clear: both;
    overflow: hidden;
    padding: 26px 0;
    display: flex;
    align-items: center;
    justify-content: space-between;

    &.right {
      flex-direction: row-reverse;

      .img-box {
        margin-left: 39px;
      }
    }

    &.left {
      flex-direction: row;

      .img-box {
        margin-right: 39px;
      }
    }

    .text {
      width: 475px;
      @media (min-width: 1700px) {
        width: 560px;
      }
      // text-align: center;
      max-width: 100%;
      line-height: 2.2em;
    }
  }

  .title {
    font-size: 24px;
    line-height: 28px;
    font-weight: bold;
    text-align: left;

    &:after {
      content: "——";
      display: block;
      font-weight: lighter;
    }
  }

  h1.title {
    margin-bottom: 38px;
    text-align: center;
  }

  .end {
    font-size: 24px;
    line-height: 36px;
    font-weight: bold;
    text-align: center;

    &::before {
      content: "——";
      display: block;
      font-weight: lighter;
    }
  }
}

.md .article {
  padding-top: 40px;
  padding-bottom: 60px;

  .section {
    padding: 12px 0;
    align-items: center;
    justify-content: center;
    flex-direction: column-reverse;
    width: 100%;

    &.right {
      .img-box {
        margin-left: 0;
      }
    }

    &.left {
      .img-box {
        margin-right: 0;
      }
    }

    .img-box {
      flex: none;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-top: 30px;
    }

    .text {
      flex: none;
      width: 100%;
    }
  }

  .title {
    font-size: 1.5em;
    line-height: 1.2em;
    // text-align: center;
    margin-top: 10px;
  }

  h1 {
    margin-bottom: 20px;
  }

  .end {
    font-size: 1.5em;
    line-height: 1.5em;
  }
}

.sm, .xs {
  .article {
    width: 100%;
    line-height: 1.5em;
    padding-top: 15px;
    padding-bottom: 33px;
    box-sizing: border-box;
    font-size: 13px;

    .section {
      padding: 15px 0;
      align-items: center;
      justify-content: center;
      flex-direction: column-reverse;

      &.right {
        .img-box {
          margin-left: 0;
        }
      }

      &.left {
        .img-box {
          margin-right: 0;
        }
      }

      .img-box {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 30px;
      }

      .text {
        flex: 1;
        font-size: 12px;
      }
    }

    .title {
      font-size: 1.5em;
      line-height: 1.2em;
      // text-align: center;
      margin-top: 20px;
    }

    h1 {
      margin-bottom: 25px;
    }
  }
}

</style>
