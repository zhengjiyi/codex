<template>
  <footer id="footer">
    <mu-divider></mu-divider>
    <mu-container class="container">
      <img class="logo" src="../assets/logo-x.png" alt="codex" />
      <mu-divider></mu-divider>
      <mu-flex fill class="nav" justify-content="between">
        <mu-flex direction="column" class="nav-group xsh">
          <router-link :to="{ name: 'products', params: { seriesId: 'all', locale }}" class="title">{{ $t('nav.series') }}</router-link>
          <ul>
            <li v-for="item in goodsSeries" :key="item.id">
              <router-link :to="{ name: 'products', params: { seriesId: item.id, locale }}">{{ item.type_name }}</router-link>
            </li>
          </ul>
        </mu-flex>
        <mu-flex direction="column" class="nav-group xsh">
          <router-link :to="{ params: {locale}, name: 'history' }" class="title">{{ $t('nav.about') }}</router-link>
          <ul>
            <li><router-link :to="{ params: {locale}, name: 'history' }">{{ $t('nav.history') }}</router-link></li>
            <li><router-link :to="{ params: {locale}, name: 'craft' }">{{ $t('nav.craft') }}</router-link></li>
            <li><router-link :to="{ params: {locale}, name: 'news' }">{{ $t('nav.news') }}</router-link></li>
          </ul>
        </mu-flex>
        <mu-flex direction="column" class="nav-group xsh">
          <router-link :to="{ params: {locale}, name: 'services' }" class="title">{{ $t('nav.services') }}</router-link>
          <ul>
            <li><router-link :to="{ params: {locale}, name: 'after-sales' }">{{ $t('nav.afterSale') }}</router-link></li>
            <li><router-link :to="{ params: {locale}, name: 'legal' }">{{ $t('nav.legal') }}</router-link></li>
            <li><router-link :to="{ params: {locale}, name: 'questions' }">{{ $t('nav.questions') }}</router-link></li>
          </ul>
        </mu-flex>
        <mu-flex direction="column" class="nav-group xsh">
          <router-link :to="{ params: {locale}, name: 'contact' }" class="title">{{ $t('nav.contactUs') }}</router-link>
          <ul>
            <li><router-link :to="{ params: {locale}, name: 'contact' }">{{ $t('nav.contactMethods') }}</router-link></li>
            <li><a href="https://www.zhipin.com/gongsir/571fcc5c4e8412d41HF43d21.html?ka=company-jobs">{{ $t('nav.joinUs') }}</a></li>
          </ul>

          <router-link :to="{ params: {locale}, name: 'shops' }" class="title">{{ $t('nav.shops') }}</router-link>
        </mu-flex>
        <mu-flex direction="column" class="nav-group socails-nav">
          <div class="title xsh">{{ $t('nav.followUs') }}</div>
          <ul class="s-socails">
            <li><a href="https://www.instagram.com/codexwatch/" target="_blank"><i class="iconfont icon-instagram"></i> {{ $t('nav.twitter') }}</a></li>
            <li><a href="https://www.facebook.com/codexwatch/" target="_blank"><i class="iconfont icon-facebook"></i> {{ $t('nav.facebook') }}</a></li>
            <li><a href="http://weibo.com/codexwatch2018" target="_blank"><i class="iconfont icon-weibo"></i> {{ $t('nav.weibo') }}</a></li>
            <mu-menu class="wechat" placement="top-start" open-on-hover>
              <li><a href=""><i class="iconfont icon-wechat"></i> {{ $t('nav.wechat') }}</a></li>
              <mu-paper slot="content" class="" :z-depth="1">
                <p style="text-align: center; padding: 10px 10px 0; margin: 0">{{ $t('tips.scanQR') }}</p>
                <img style="width: 220px; padding: 10px;" :src="`${publicPath}frontend-assets/img/qr.png`" alt="">
              </mu-paper>
            </mu-menu>

          </ul>
        </mu-flex>
      </mu-flex>
      <mu-divider></mu-divider>
      <p class="copyright">{{ $t('footer.copyright') }}</p>
    </mu-container>
  </footer>
</template>

<script>
export default {
  name: 'GlobalFooter',
  props: ['goodsSeries'],
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

#footer {
  margin: auto;

  .container {
    @media (min-width: 1200px) {
      max-width: 996px;
    }
    // @media (min-width: 1700px) {
    //   max-width: 1500px;
    // }
  }

  .logo {
    display: block;
    margin-top: 25px;
    margin-bottom: 30px;
    margin-left: auto;
    margin-right: auto;
    width: 45px;
    height: 45px;
  }

  .nav {
    padding-top: 30px;
    padding-bottom: 28px;
  }

  .nav-group {
    .title {
      display: block;
      color: #7d6650;
      font-size: 18px;
      text-decoration: none;
    }

    ul {
      margin: 26px 0 0;
      padding: 0;
      list-style: none;
    }

    ul + .title {
      margin-top: 30px;
    }

    li a {
      color: #57585a;
      text-decoration: none;
      line-height: 1.5em;
      transition: all 0.5s;
      position: relative;
      left: 0px;

      &:hover {
        color: #7d6650;
        left: 5px;
      }
    }
  }

  .copyright {
    text-align: left;
    line-height: 1.5em;
    margin-top: 15px;
    margin-bottom: 40px;
  }
}

.xs #footer {
  .logo {
    margin-top: 15px;
    margin-bottom: 15px;
    width: 30px;
    height: 30px;
  }

  .nav {
    padding-top: 15px;
    padding-bottom: 15px;
  }

  .copyright {
    font-size: 13px;
    margin-top: 15px;
    margin-bottom: 30px;
  }

  .socails-nav {
    width: 100%;
  }

  .s-socails {
    margin-top: 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    font-size: 12px;
  }
}
</style>
