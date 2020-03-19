<template>
  <div class="about-page">
    <div class="page-cover anim" :style="{backgroundImage: `url(${publicPath}frontend-assets/img/cover-services.jpg)`}" data-effect="fadeIn" data-duration="2s">
    </div>
    <mu-breadcrumbs class="breadcrumbs white anim" data-effect="fadeInUp" data-duration="1s">
      <mu-breadcrumbs-item :to="{ params: {locale}, name: 'home' }">{{$t('nav.home')}}</mu-breadcrumbs-item>
      <mu-breadcrumbs-item :to="{ params: { locale}, name: 'afterSale' }">{{$t('nav.services')}}</mu-breadcrumbs-item>
      <mu-breadcrumbs-item disabled>{{$t('nav.afterSale')}}</mu-breadcrumbs-item>
    </mu-breadcrumbs>
    <mu-container class="container">
      <div class="router-tabs">
        <router-link class="link" active-class="active" :to="{ params: {locale}, name: 'after-sales' }">{{$t('nav.afterSale')}}</router-link>
        <router-link class="link" active-class="active" :to="{ params: {locale}, name: 'questions' }">{{$t('nav.questions')}}</router-link>
        <router-link class="link" active-class="active" :to="{ params: {locale}, name: 'legal' }">{{$t('nav.legal')}}</router-link>
      </div>
    </mu-container>

    <mu-container class="questions-section">
      <mu-expansion-panel :z-depth="1" class="question-box" v-for="(item, index) in $t('fqa')" :key="index" :expand="activeIndex === index" @change="openQuestion(index)">
        <div class="question" style="width: 100%" slot="header">
          <p class="title">
            <i class="iconfont icon-question"></i>
            {{ item.q }}
          </p>
          <div class="status" v-if="activeIndex === index">{{ $t('btn.close')}}</div>
          <div class="status" v-else>{{ $t('btn.read')}}</div>
        </div>
        <p>{{ item.a }}</p>
      </mu-expansion-panel>
    </mu-container>
  </div>
</template>

<script>
import animateEle from '@/simple.animate';

export default {
  name: 'QuestionPage',
  data() {
    return {
      activeIndex: '',
      publicPath: process.env.BASE_URL,
    };
  },
  computed: {
    locale() {
      return this.$i18n.locale;
    },
  },
  methods: {
    openQuestion(index) {
      this.activeIndex = this.activeIndex === index ? '' : index;
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

.questions-section {
  @media (min-width: 1200px) {
    max-width: 996px;
  }
  @media (min-width: 1700px) {
    max-width: 1500px;
  }
  text-align: left;
  color: #231815;
  padding-bottom: 48px;


  .red {
    color: red;
  }

  .iconfont {
    font-size: 24px;
    color: #57585a;
  }

  .question-box {
    .question {
      padding: 15px 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
      cursor: pointer;

      .title {
        line-height: 1.5em;
        position: relative;
        padding-left: 30px;
        .iconfont {
          position: absolute;
          left: 0;
          top: 50%;
          margin-top: -15px;
        }
      }

      .iconfont {
        vertical-align: text-bottom;
      }

      .status {
        white-space: nowrap;
      }

      .status .iconfont {
        vertical-align: middle;
      }
    }

    .answer {
      overflow: hidden;
      height: 0;
      font-size: 18px;
      line-height: 1.75em;
    }

    &.active {
      .answer {
        height: auto;
        padding-bottom: 15px;
      }
    }
  }
}

.md .questions-section {
  .question-box {
    border-bottom: 1px solid #57585a;

    .question {
      padding: 7.5px 0;

      .title {
        padding-left: 28px;
        .iconfont {
          margin-top: -12px;
        }
      }
    }

    .answer {
      font-size: 12px;
    }

    &.active {
      .answer {
        padding-bottom: 7.5px;
      }
    }
  }
}

.sm, .xs {
.questions-section {
  .container {
    width: 100%;
    padding-left: 12px;
    padding-right: 12px;
    padding-bottom: 24px;
    box-sizing: border-box;
  }

  .iconfont {
    font-size: 15px;
  }

  .question-box {

    .question {
      padding: 7.5px 0;

      .title {
        padding-left: 15px;
        .iconfont {
          margin-top: -7.5px;
        }
      }
    }

    .answer {
      font-size: 14px;
    }

    &.active {
      .answer {
        padding-bottom: 7.5px;
      }
    }
  }
}
}
</style>
