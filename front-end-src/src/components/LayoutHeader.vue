<template>
  <div id="header" :class="{ stick, dark }">
    <mu-container ref="headerContent">
      <mu-flex align-items="center">
        <mu-flex class="header-part" justify-content="start" fill>
          <menu-btn ref="menuBtn" :dark="stick || dark" :active="active" @click="openDrawer">
            {{$t('btn.menu')}}
          </menu-btn>
        </mu-flex>
        <mu-flex class="header-part" justify-content="center" fill>
          <router-link :to="{ name: 'home', params: { locale} }" id="logo"></router-link>
        </mu-flex>
        <mu-flex class="header-part" justify-content="end" fill>
          <i @click="switchLang" :class="`iconfont icon-${locale === 'cn' ? 'en' : 'cn' }`"></i>
          <i @click="handleLogin" class="iconfont icon-user"></i>
          <i @click="openSearchDialog" class="iconfont icon-search"></i>
        </mu-flex>
      </mu-flex>
    </mu-container>
  </div>
</template>

<script>
import MenuBtn from './MenuBtn';

export default {
  name: 'layout-header',
  components: { MenuBtn },
  props: ['stick', 'dark'],
  data() {
    return {
      menuBtnTop: 0,
      menuBtnLeft: 0,
    };
  },
  computed: {
    active() {
      return this.$store.state.drawer.visible;
    },
    locale() {
      return this.$i18n.locale;
    },
  },
  mounted() {
  },

  methods: {
    openDrawer() {
      const top = this.$refs.menuBtn.$el.offsetTop;
      const left = this.$refs.menuBtn.$el.offsetLeft;
      this.$store.commit('setDrawer', { visible: true, top, left });
    },
    switchLang() {
      const nextLocale = this.$route.params.locale === 'cn' ? 'en' : 'cn';
      const route = { ...this.$route, params: { ...this.$route.params } };
      this.$i18n.locale = nextLocale;
      route.params.locale = nextLocale;
      this.$router.replace(route);
    },
    handleLogin() {
      // this.$alert(this.$t('tips.todo'), this.$t('tips.name'), {
      //   type: 'info',
      //   okLabel: this.$t('btn.close'),
      // });
      this.$store.commit('updateTipsDialogVisible', true);
    },
    openSearchDialog() {
      this.$store.commit('updateSearchDialogVisible', true);
    },
  },
};
</script>

<style lang="less" scoped>
@import '../styles/vars.less';

#header {
  z-index: 10;
  position: fixed; top: 0; left: 0; width: 100%;
  padding: 10px 0 0;
  transition: all 0.5s;
  background-color: rgba(0, 0, 0, 0.1);
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
  transition: all 0.5s;

  .header-part {
    width: 33.33%;
  }

  .iconfont {
    font-size: 24px; color: @white; margin-left: 20px;
    transition: all 0.5s;
    cursor: pointer;
    position: relative;
    transform: scale(1.0);
    transition: all 0.2s;

    &:hover {
      transform: scale(1.3);
    }
  }

  .iconfont:nth-child(1) {
    margin-left: 0
  }

  #logo {
    display: inline-block;
    width: 160px;
    height: 76px;
    background-image: url(../assets/logo.png);
    background-size: contain;
    background-position: center center;
    background-repeat: no-repeat;
    transition: width 0.5s, height 0.5s;
  }

  &.stick {
    #logo { width: 113px; height: 53px; }
  }

  &.stick, &.dark {
    background-color: @white;
    // border-bottom: 1px solid rgba(0, 0, 0, 1);

    .iconfont { color: #5f5d5d; }
  }

  &.dark {
    #logo {
      background-image: url(../assets/dark-logo.png);
    }
  }

  &.stick {
    #logo {
      background-size: auto 70%;
      background-image: url(../assets/logo-x.png);
    }
  }
}

.xs #header {
  padding-top: 0px;

  #logo {
    margin-top: 5px;
    width: 90px;
    height: 43px;
  }

  .iconfont { margin-left: 10px; }
}
</style>
