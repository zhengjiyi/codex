<template>
  <mu-container class="about-section">
    <h2 class="section-title anim" data-effect="fadeInUp" data-duration="1s">{{$t('home.brand.title')}}</h2>
    <mu-flex fill>
      <div class="about-box anim" :style="{backgroundImage: `url(${publicPath}frontend-assets/img/home-1.jpg)`}" data-effect="fadeInLeft" data-duration="1s">
        <div class="inner-box">
          <h2 class="section-title">{{$t('home.brand.about')}}</h2>
          <div class="slash hs"></div>
          <p class="hsm hxs" v-for="(item, index) in $t('home.brand.desc')" :key="index">{{ item }}</p>
          <br>
          <br>
          <router-link :to="{ name: 'history', params: { locale } }" class="more-btn">{{$t('btn.more')}}</router-link>
        </div>
      </div>
      <div class="about-box anim" :style="{backgroundImage: `url(${publicPath}frontend-assets/img/home-2.jpg)`, marginLeft: '20px'}" data-effect="fadeInRight" data-duration="1s">
        <div class="inner-box">
          <h2 class="section-title">{{$t('home.brand.craft')}}</h2>
          <div class="slash hs"></div>
          <p class="hsm hxs" v-for="(item, index) in $t('home.brand.desc2')" :key="index">{{ item }}</p>
          <br>
          <br>
          <router-link :to="{ name: 'craft', params: { locale } }" class="more-btn">{{$t('btn.more')}}</router-link>
        </div>
      </div>
    </mu-flex>
  </mu-container>
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

.about-section {
  padding-top: 30px;
  padding-bottom: 67px;

  @media (min-width: 1200px) {
    max-width: 996px;
  }
  @media (min-width: 1700px) {
    max-width: 1500px;
    padding-top: 55px;
    padding-bottom: 120px;
  }

}

.about-box, .img-box {
  flex: 1; height: 380px;
  @media (min-width: 1200px) {
    height: 0; padding-top: 38%;
  }
}

.about-box {
  color: @white;
  overflow: hidden;
  background-position: center center;
  background-size: cover;
  position: relative;
  margin-top: 20px;

  @media (min-width: 1700px) {
    margin-top: 40px;
  }

  .section-title {
    font-size: 36px;
    line-height: 1em;
    text-align: left;

    &::after { display: none; }
  }

  .inner-box {
    padding: 0 46px;
    width: 100%;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    left: 0;
  }
}

.xs .inner-box {
  padding: 0 30px;
}

.xs .about-section {
  padding-top: 20px;
  padding-bottom: 30px;
}

.xs .about-box {
  height: 300px;

  .section-title {
    font-size: 26px;
  }

  .slash {
    margin-top: 30px;
    margin-bottom: 30px;
  }
}

.img-box {
  overflow: hidden;
  position: relative;
  margin-left: 5px;

  .inner-box {
    position: absolute;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    background-position: center center;
    background-size: cover;
    transition: all 0.5s;
    transform: scale(1);

    &:hover {
      transform: scale(1.1);
    }
  }
}

.slash {
  background-color: @keyColor;
  margin-top: 56.25px;
  margin-bottom: 48px;
  margin-left: 0;
  width: 66px;
  height: 1px;
}

p {
  line-height: 28px;
}

.more-btn {
  color: #e4bb95;
  margin-top: 30px;

  &:hover {
    color: #fff;
  }
}
</style>
