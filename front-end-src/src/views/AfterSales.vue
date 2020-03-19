<template>
  <div class="about-page">
    <div class="page-cover anim" :style="{backgroundImage: `url(${publicPath}frontend-assets/img/cover-services.jpg)`}" data-effect="fadeIn" data-duration="2s">
    </div>
    <mu-breadcrumbs class="breadcrumbs white anim" data-effect="fadeInUp" data-duration="1s">
      <mu-breadcrumbs-item :to="{ params: { locale}, name: 'home' }">{{$t('nav.home')}}</mu-breadcrumbs-item>
      <mu-breadcrumbs-item :to="{ params: { locale}, name: 'afterSale' }">{{$t('nav.services')}}</mu-breadcrumbs-item>
      <mu-breadcrumbs-item disabled>{{$t('nav.afterSale')}}</mu-breadcrumbs-item>
    </mu-breadcrumbs>
    <mu-container class="container">
      <div class="router-tabs">
        <router-link class="link" active-class="active" :to="{ params: { locale}, name: 'after-sales' }">{{$t('nav.afterSale')}}</router-link>
        <router-link class="link" active-class="active" :to="{ params: { locale}, name: 'questions' }">{{$t('nav.questions')}}</router-link>
        <router-link class="link" active-class="active" :to="{ params: { locale}, name: 'legal' }">{{$t('nav.legal')}}</router-link>
      </div>
    </mu-container>
    <mu-container class="after-sales-section">
      <p v-for="(item, index) in $t('afterSale.section1')" :key="`section1${index}`">{{ item }}</p>
      <mu-divider class="divider"></mu-divider>
      <p v-for="(item, index) in $t('afterSale.section2')" :key="`section2${index}`">{{ item }}</p>
      <mu-divider class="divider"></mu-divider>
      <p>
        <i class="iconfont icon-web"></i>
        {{ $t('afterSale.section3.p1')}}
        <br/>
        <strong>
          <a :href="`http://${ $t('afterSale.section3.web1') }`" target="_blank">{{ $t('afterSale.section3.web1')}}</a>
        </strong>
      </p>
      <mu-divider class="divider"></mu-divider>
      <p>
        <i class="iconfont icon-phone"></i>
        {{ $t('afterSale.section4.p1')}}
        <br/>
        <strong>
          <a :href="`tel:${$t('afterSale.section4.tel1')}`">{{$t('afterSale.section4.tel1')}}</a>
        </strong>
      </p>

      <div class="down-box">
        <div class="bg" :style="{backgroundImage: `url(${publicPath}frontend-assets/img/services-1.png)`}"></div>
        <div class="container">
        <!--  <p>CODEX瑞士豪度表保养说明</p>
          <a
            :href="`${publicPath}files/手表日常保养和使用注意事项.pdf`"
            class="more-btn" download="CODEX瑞士豪度表保养说明"
          >
            <i class="iconfont icon-download"></i> {{ $t('btn.download') }}
          </a> -->
        </div>
      </div>
    </mu-container>
  </div>
</template>

<script>
import animateEle from '@/simple.animate';

export default {
  beforeRouteUpdate(to, from, next) {
    next();
    this.$store.commit('toggleLoadingScene', 100);
    this.$nextTick(() => {
      animateEle(0);
    });
  },
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
  mounted() {
    this.$store.commit('toggleLoadingScene', 100);
    this.$nextTick(() => {
      animateEle(0);
    });
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

.after-sales-section {
  @media (min-width: 1200px) {
    max-width: 996px;
  }

  @media (min-width: 1700px) {
    max-width: 1500px;
  }
  text-align: left;
  padding-bottom: 48px;

  p {
    color: #231815;
    line-height: 1.75em;
    padding-bottom: 0.7em;

    strong {
      font-size: 1.5em;
      font-weight: bold;

      a {
        color: #231815;
        text-decoration: none;
      }
    }

    .iconfont {
      font-size: 2.577em;
      float: left;
      vertical-align: top;
      margin: 15px 5px 15px 0;
    }
  }

  .divider {
    margin-bottom: 1em;
  }

  .down-box {
    margin-top: 30px;
    overflow: hidden;
    position: relative;
    width: 100%;
    height: 258px;
    display: flex;
    align-items: center;
    justify-content: center;

    &:hover .bg {
      transform: translate(-50%, -50%) scale(1.1);
    }

    .bg {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 100%;
      height: 100%;
      background-position: center center;
      background-size: cover;
      transform: translate(-50%, -50%);
      transition: all 0.5s;
    }

    .container {
      position: relative;
      z-index: 1;
    }


    .more-btn {
      color: #fff;
      margin: auto;
    }

    p {
      color: #fff;
      margin-bottom: 30px;
      padding-bottom: 0;
      border-bottom: 0;
      text-align: center;
    }
  }
}

</style>
