<template>
  <div class="about-page">
    <div class="page-cover anim" :style="{backgroundImage: `url(${publicPath}frontend-assets/img/cover-services.jpg)`}" data-effect="fadeIn" data-duration="2s">
    </div>
    <mu-breadcrumbs class="breadcrumbs white anim" data-effect="fadeInUp" data-duration="1s">
      <mu-breadcrumbs-item :to="{ params: {locale}, name: 'home' }">{{$t('nav.home')}}</mu-breadcrumbs-item>
      <mu-breadcrumbs-item :to="{ params: { locale}, name: 'afterSale' }">{{$t('nav.services')}}</mu-breadcrumbs-item>
      <mu-breadcrumbs-item disabled>{{$t('nav.legal')}}</mu-breadcrumbs-item>
    </mu-breadcrumbs>
    <mu-container class="container">
      <div class="router-tabs">
        <router-link class="link" active-class="active" :to="{ params: {locale}, name: 'after-sales' }">{{$t('nav.afterSale')}}</router-link>
        <router-link class="link" active-class="active" :to="{ params: {locale}, name: 'questions' }">{{$t('nav.questions')}}</router-link>
        <router-link class="link" active-class="active" :to="{ params: {locale}, name: 'legal' }">{{$t('nav.legal')}}</router-link>
      </div>
    </mu-container>
    <mu-container class="legal-section">
      <p v-t="'legal.s1'"></p>
      <br/>
      <p v-for="(item, index) in $t('legal.s2')" :key="`s2${index}`">{{ item }}</p>
      <hr/>
      <h4 v-t="'legal.t3'"></h4>
      <p v-for="(item, index) in $t('legal.s3')" :key="`s3${index}`">{{ item }}</p>
      <hr/>
      <h4 v-t="'legal.t4'"></h4>
      <p v-for="(item, index) in $t('legal.s4')" :key="`s4${index}`">{{ item }}</p>
      <hr/>
      <h4 v-t="'legal.t5'"></h4>
      <p v-for="(item, index) in $t('legal.s5')" :key="`s5${index}`">{{ item }}</p>
      <hr/>
      <h4 v-t="'legal.t6'"></h4>
      <p v-for="(item, index) in $t('legal.s6')" :key="`s6${index}`">{{ item }}</p>
      <hr/>
      <h4 v-t="'legal.t7'"></h4>
      <p v-for="(item, index) in $t('legal.s7')" :key="`s7${index}`">{{ item }}</p>
      <hr/>
      <h4 v-t="'legal.t8'"></h4>
      <p v-for="(item, index) in $t('legal.s8')" :key="`s8${index}`">{{ item }}</p>
      <hr/>
      <h4 v-t="'legal.t9'"></h4>
      <p v-for="(item, index) in $t('legal.s9')" :key="`s9${index}`">{{ item }}</p>
      <hr/>
      <p v-for="(item, index) in $t('legal.s10')" :key="`s10${index}`">{{ item }}</p>
    </mu-container>
  </div>
</template>

<script>
import animateEle from '@/simple.animate';

export default {
  beforeRouteUpdate(to, from, next) {
    this.$store.commit('toggleLoadingScene', 100);
    next();
    this.$nextTick(() => {
      animateEle(0);
    });
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
  data() {
    return {
      publicPath: process.env.BASE_URL,
    };
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

.container {
  @media (min-width: 1200px) {
    max-width: 960px;
  }
  @media (min-width: 1700px) {
    max-width: 1500px;
  }
}


.sm, .xs {
  .breadcrumbs {
    padding-top: 100px;
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

.legal-section {
  @media (min-width: 1200px) {
    max-width: 996px;
  }
  @media (min-width: 1700px) {
    max-width: 1500px;
  }
  text-align: left;
  color: #231815;
  line-height: 1.75em;
  padding-bottom: 48px;

  .red {
    color: red;
  }

  h4 {
    font-size: 18px;
    line-height: 2em;
    font-weight: 500;
  }

  hr {
    margin: 1em 0;
    border-width: 1px;
  }
}

</style>
