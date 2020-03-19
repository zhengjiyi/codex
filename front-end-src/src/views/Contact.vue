<template>
  <div class="about-page">
    <div class="page-cover anim" :style="{backgroundImage: `url(${publicPath}frontend-assets/img/cover-contact.jpg)`}" data-effect="fadeIn" data-duration="2s">
    </div>
    <mu-breadcrumbs class="breadcrumbs white anim" data-effect="fadeInUp" data-duration="1s">
      <mu-breadcrumbs-item :to="{ params: { locale }, name: 'home' }">{{$t('nav.home')}}</mu-breadcrumbs-item>
      <mu-breadcrumbs-item disabled>{{$t(`nav.contactUs`)}}</mu-breadcrumbs-item>
    </mu-breadcrumbs>
    <mu-container class="contact-box">
      <div class="wrap">
        <div class="swiss">
          <h4>{{$t('contact.swiss')}}</h4>
          <p>
            <i class="iconfont icon-dizhi"></i>
            <span class="label">{{$t('contact.address')}}：</span> <br />
            <span class="value">Rue des Perrieres 8, 2340 Le Noirmont</span>
          </p>
          <p>
            <i class="iconfont icon-tel"></i>
            <span class="label">{{$t('contact.tel')}}：</span> <br />
            <span class="value">+41  325661652</span>
          </p>
          <p>
            <i class="iconfont icon-chuanzhen"></i>
            <span class="label">{{$t('contact.fax')}}：</span> <br />
            <span class="value">+41  325661652</span>
          </p>
          <p>
            <i class="iconfont icon-email"></i>
            <span class="label">Email：</span> <br />
            <span class="value">contact@codex-watches.ch</span>
          </p>
        </div>
        <div class="china">
          <h4>{{$t('contact.shenzhen')}}</h4>
          <p>
            <i class="iconfont icon-dizhi"></i>
            <span class="label">{{$t('contact.address')}}：</span> <br />
            <span class="value">中国广东省深圳市</span>
          </p>
          <p>
            <i class="iconfont icon-tel"></i>
            <span class="label">{{$t('contact.tel')}}：</span> <br />
            <span class="value">0755-82371248-801</span>
          </p>
          <p>
            <i class="iconfont icon-chuanzhen"></i>
            <span class="label">{{$t('contact.fax')}}：</span> <br />
            <span class="value">0755-86359374</span>
          </p>
          <p>
            <i class="iconfont icon-kefu"></i>
            <span class="label">{{$t('contact.hotline')}}：</span> <br />
            <span class="value">+ 4008737518</span>
          </p>
        </div>
      </div>
      <div class="img-box">
        <img :src="`${publicPath}frontend-assets/img/contact-1.png`" alt="">
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
  updated() {
    this.$store.commit('toggleLoadingScene', 100);
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
  .router-tabs {
    max-width: 50%;
  }
  @media (min-width: 1200px) {
    max-width: 996px;
  }

  @media (min-width: 1700px) {
    max-width: 1500px;
  }
}

.router-tabs {
  display: flex;
  justify-content: space-between;
  padding-top: 37px;
  padding-bottom: 33px;
  margin-left: auto;
  margin-right: auto;

  .link {
    display: block;
    font-size: 18px;
    padding: 12px 23px;
    color: #000;
    text-decoration: none;
    border-bottom: 1px solid #fff;

    &.active {
      border-color: #000;
    }
  }
}


.contact-box {
  text-align: left;
  color: #231815;
  line-height: 1.75em;
  padding-top: 30px;
  padding-bottom: 48px;

  .wrap {
    display: flex;

  }

  .img-box {
    margin-top: 5%;
    width: 100%;
    overflow: hidden;

    img {
      display: block;
      width: 100%;
      transform: scale(1);
      transition: all 0.5s;

      &:hover {
      transform: scale(1.1);
      }
    }
  }
  .swiss {
    flex: 1;
    box-sizing: border-box;
    padding-right: 24px;
  }
  .china {
    flex: 1;
    box-sizing: border-box;
    padding-left: 21px;
    border-left: 1px solid #ccc;
  }

  h4 {
    font-size: 24px;
    font-weight: 500;
    clear: both;
  }

  p {
    clear: both;
    margin-top: 30px;

    .iconfont {
      font-size: 50px;
      float: left;
      vertical-align: top;
      margin: 12px 7px 12px 0;
    }

    .value {
      font-size: 15px;
    }
  }
}

.md {
  .router-tabs {
    width: 100%;
    padding-top: 18px;
    padding-bottom: 15px;

    .link {
      font-size: 16px;
      padding: 6px 12px;
    }
  }

  .contact-box {
      width: 100%;
      padding-top: 14px;
      padding-bottom: 24px;
      line-height: 1.6em;

      .img {
        margin-top: 30px;
      }

      .swiss {
        padding-right: 0;
      }

      h4 {
        font-size: 18px;
      }

      p {
        margin-top: 15px;

        .iconfont {
          font-size: 24px;
          margin: 13px 10px 10px 0;
        }

        .value {
          font-size: 16px;
        }
      }
  }
}

.sm, .xs {
  .router-tabs {
    width: 100%;
    padding-top: 18px;
    padding-bottom: 15px;

    .link {
      font-size: 16px;
      padding: 8px 15px;
    }
  }

  .contact-box {
      width: 100%;
      padding-top: 14px;
      padding-bottom: 24px;
      line-height: 1.6em;

      .img {
        margin-top: 30px;
      }

      .wrap {
        flex-direction: column;
      }

      .swiss {
        padding-right: 0;
      }

      .china {
        padding-left: 0;
        border-left: 0 solid #ccc;
        border-top: 2px solid #ccc;
        padding-top: 15px;
        margin-top: 15px;
      }

      h4 {
        font-size: 18px;
      }

      p {
        margin-top: 15px;

        .iconfont {
          font-size: 26px;
          margin: 10px 5px 10px 0;
        }

        .value {
          font-size: 16px;
        }
      }
  }
}
</style>
