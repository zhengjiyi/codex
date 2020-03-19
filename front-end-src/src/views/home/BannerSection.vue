<template>
  <div class="banner-wrap">
    <swiper id="banner" class="banner" ref="banner" :options="swiperOption">
      <swiper-slide
        class="banner-item"
        v-for="item in items"
        :key="item.id"
      >
        <div class="bg ani"
          :style="{backgroundImage: `url(${item.img})`}"
          swiper-animate-effect="fadeIn"
          swiper-animate-duration="3s"
          swiper-animate-delay="0s"
          @click="goTo(item.url)"
        >
          <video v-if="!isMobile && item.video" class="video" muted="muted" preload="auto">
            <source :src="item.video" type="video/mp4">
            <img src="theme/gdlng/images/carousel-img.png" alt="">
            您的浏览器不支持 video 标签
          </video>
        </div>
        <mu-container class="container">
          <div class="banner-item-info">
            <div
              class="sub-title ani"
              swiper-animate-effect="fadeInRight"
              swiper-animate-duration="0.5s"
              swiper-animate-delay="0.1s"
            >{{item.title2}}</div>
            <div
              class="title ani"
              swiper-animate-effect="fadeInRight"
              swiper-animate-duration="0.5s"
              swiper-animate-delay="0.3s"
              v-html="item.title1"
            ></div>
            <a
              :href="item.url"
              class="more-btn ani"
              swiper-animate-effect="fadeInRight"
              swiper-animate-duration="0.5s"
              swiper-animate-delay="0.5s"
            >{{$t('btn.more')}}</a>
          </div>
        </mu-container>
      </swiper-slide>
      <div class="swiper-pagination banner-pagination" slot="pagination"></div>
    </swiper>
  </div>
</template>

<script>
import * as swiperAni from '@/swiper.animate.min';

export default {
  name: 'BannerSection',
  props: {
    items: Array,
  },
  data() {
    return {
      swiperOption: {
        loop: true,
        // effect: 'fade',
        // grabCursor: true,
        initialSlide: 0,
        // 滑动方向，水平horizontal，垂直vertical
        direction: 'horizontal',
        autoplay: {
          delay: 5000,
        },
        pagination: {
          el: '.banner-pagination',
        },
        on: {
          init() {
            swiperAni.swiperAnimateCache(this);
            swiperAni.swiperAnimate(this);
            const slide = this.slides.eq(this.activeIndex);
            const video = slide.find('video')[0];
            if (video) {
              this.autoplay.stop();
              const swiper = this;
              video.play();
              video.onended = function handleVideoEnded() {
                swiper.autoplay.start();
                swiper.slideNext();
                video.onended = null;
              };
            } else {
              this.autoplay.stop();
            }
          },
          slideChange() {
            swiperAni.swiperAnimate(this);
            const videos = document.querySelectorAll('#banner video');
            videos.forEach((ele) => { ele.pause(); });
            const slide = this.slides.eq(this.activeIndex);
            const video = slide.find('video')[0];
            if (video) {
              this.autoplay.stop();
              const swiper = this;
              video.play();
              video.onended = function handleVideoEnded() {
                swiper.autoplay.start();
                swiper.slideNext();
                video.onended = null;
              };
            } else {
              this.autoplay.start();
            }
          },
        },
      },
    };
  },
  computed: {
    isMobile() {
      return window.innerWidth < 760;
    },
    swiper() {
      return this.$refs.banner.swiper;
    },
    locale() {
      return this.$i18n.locale;
    },
  },
  mounted() {
    const banner = this.$refs.banner.$el;
    banner.onmouseenter = () => {
      this.swiper.autoplay.stop();
    };

    banner.onmouseleave = () => {
      this.swiper.autoplay.start();
    };
  },
  watch: {
    // 修复初始化banner不触发
    items() {
      this.$nextTick(() => {
        if (this.swiper) {
          swiperAni.swiperAnimate(this.swiper);
        }
      });
    },
  },
  methods: {
    goTo(url) {
      if (window.innerWidth < 768) {
        window.location.href = url;
      }
    },
  },
};
</script>

<style lang="less" scoped>
.banner-wrap {
  position: relative;
  width: 100%;
  height: 0;
  padding-top: 49.7%;
}
#banner {
  width: 100%;
  height: 100%;
  position: absolute; top: 0; left: 0;
  background-color: #000;
}

.video {
  margin: auto;
  height: 100%;
  background-color: #fff;
  position: absolute;
  top: 0;
  left: 50%;
  transform: translateX(-50%);
}
.banner {
  .banner-item {
    width: 100%;
    height: 100%;

    .bg {
      width: 100%;
      height: 100%;
      background-position: center center;
      background-size: cover;
      position: absolute;
      top: 0;
      left: 0;
    }

    .container {
      position: relative;
      z-index: 1;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      max-width: 996px;
    }

    .banner-item-info {
      width: 35%;
    }

    .sub-title {
      font-size: 18px;
      color: #e4bb95;
      line-height: 1em;
      text-align: left;

      &:after {
        content: "";
        display: block;
        width: 4em;
        height: 2px;
        background-color: #e4bb95;
        margin-top: 20px;
        margin-bottom: 41px;
      }
    }

    .title {
      font-size: 38px;
      color: #fff;
      text-align: left;
      line-height: 1.56em;
    }

    .more-btn {
      margin-top: 80px;
      z-index: 11;
      color: #fff;
    }
  }
}

.lg {
  .banner {
    .banner-item {
      .banner-item-info {
        width: 40%;

        .sub-title {
          &:after {
            margin-top: 10px;
            margin-bottom: 30px;
          }
        }

        .title {
          font-size: 24px;
        }

        .more-btn {
          margin-top: 50px;
        }
      }
    }
  }
}

.md {
  .banner {
    .banner-item {
      .banner-item-info {
        width: 40%;

        .sub-title {
          margin-top: 40px;

          &:after {
            margin-top: 10px;
            margin-bottom: 30px;
          }
        }

        .title {
          font-size: 24px;
        }

        .more-btn {
          margin-top: 50px;
        }
      }
    }
  }
}

.sm {
  .banner-wrap {
    padding-top: 50%;
  }
  .banner {
    .banner-item {
      .banner-item-info {
        display: none;
        width: 70%;
        margin: auto;

        .sub-title {
          font-size: 14px;

          &:after {
            margin-top: 6px;
            margin-bottom: 12px;
          }
        }

        .title {
          font-size: 20px;
        }

        .more-btn {
          display: none;
        }
      }
    }
  }
}

.xs {
  .banner-wrap {
    padding-top: 60%;
  }
  .banner {
    .banner-item {
      .banner-item-info {
        display: none;
        width: 80%;
        margin: auto;

        .sub-title {
          font-size: 14px;

          &:after {
            margin-top: 6px;
            margin-bottom: 12px;
          }
        }

        .title {
          font-size: 18px;
        }

        .more-btn {
          display: none;
        }
      }
    }
  }
}
</style>
