<template>
  <mu-flex class="store-section">
    <div class="bg anim" :style="{backgroundImage: `url(${publicPath}frontend-assets/img/cover-shop.jpg)`}" data-effect="fadeIn" data-duration="1s"></div>
    <mu-container class="container anim" data-effect="fadeInUp" data-duration="1s">
      <h2 class="section-title">{{$t('home.store.title')}}</h2>
      <div class="slash"></div>
      <p>{{$t('home.store.desc')}}</p>
      <router-link :to="{ name: 'shops', params: { locale } }" class="more-btn">{{$t('home.store.search')}}</router-link>
    </mu-container>
  </mu-flex>
</template>

<script>
export default {
  computed: {
    locale() {
      return this.$i18n.locale;
    },
  },
  data() {
    return {
      publicPath: process.env.BASE_URL,
    };
  },
};
</script>


<style lang="less" scoped>
@import '../../styles/vars.less';

.store-section {
  position: relative;
  padding-top: 142.5px;
  padding-bottom: 112.5px;
  overflow: hidden;

  .container {
    @media (min-width: 1200px) {
      max-width: 996px;
      padding: 80px 0;
    }
    @media (min-width: 1700px) {
      max-width: 1500px;
      padding: 120px 0 180px;
    }
    text-align: center;
    z-index: 1;
  }

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

  .section-title {
    color: @white;
    margin-bottom: 50px;
  }

  .more-btn {
    color: @white;
    margin: auto;
  }

  p {
    color: @white;
    margin-bottom: 52px;
  }
}

.xs .store-section {
  padding-top: 60px;
  padding-bottom: 60px;
}
</style>
