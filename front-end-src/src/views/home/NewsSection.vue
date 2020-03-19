<template>
  <mu-container class="news-section">
    <h2 class="section-title anim" data-effect="fadeInUp" data-duration="1s">{{$t('nav.news')}}</h2>
    <swiper class="news-slide" ref="newsSlide" :options="swiperOption">
      <swiper-slide
        class="news-slide-item"
        v-for="item in items"
        :key="item.id"
      >
        <router-link
          :class="['news-card', item.head && 'head' ]"
          :to="{ name: 'news-detail', params: {id: item.id, locale }}"
        >
          <mu-col span="12" :lg="item.head ? 8 : 12" class="pic-box">
            <div
              class="pic"
              :style="{backgroundImage: `url(${item.img})`}"
            ></div>
          </mu-col>
          <mu-col span="12" :lg="item.head ? 4 : 12" class="text">
            <div class="time">{{item.pub_date}}</div>
            <div class="title">{{item.title}}</div>
          </mu-col>
        </router-link>
      </swiper-slide>
      <div class="swiper-pagination news-slide-pagination" slot="pagination"></div>
    </swiper>

    <router-link :to="{ name: 'news', params: { locale } }" class="more-btn anim" data-effect="fadeInUp" data-duration="1s">{{$t('btn.all')}}</router-link>
  </mu-container>
</template>

<script>
import * as swiperAni from '@/swiper.animate.min';

export default {
  name: 'NewsSection',
  props: ['items'],
  data() {
    return {
      swiperOption: {
        // loop: true,
        // effect: 'fade',
        // grabCursor: true,
        // initialSlide: 0,
        // 滑动方向，水平horizontal，垂直vertical
        direction: 'horizontal',
        autoplay: {
          delay: 5000,
        },
        slidesPerView: 3,
        // slidesPerGroup: 3,
        spaceBetween: 22,
        // init: false,
        pagination: {
          el: '.news-slide-pagination',
          clickable: true,
        },
        breakpoints: {
          1280: {
            slidesPerView: 2,
            // slidesPerGroup: 3,
            spaceBetween: 30,
          },
          640: {
            slidesPerView: 1,
            // slidesPerGroup: 1,
            spaceBetween: 30,
          },
        },
        on: {
          init() {
            swiperAni.swiperAnimateCache(this);
            swiperAni.swiperAnimate(this);
          },
          slideChange() {
            swiperAni.swiperAnimate(this);
          },
        },
      },
    };
  },
  computed: {
    locale() {
      return this.$i18n.locale;
    },
  },
};
</script>


<style lang="less" scoped>
@import '../../styles/vars.less';

.news-slide {
  padding-bottom: 40px;
  padding-top: 20px;

  @media (min-width: 1700px) {
    padding-bottom: 80px;
    padding-top: 35px;
  }
}

.news-section {
  padding-top: 30px;
  padding-bottom: 60px;

  @media (min-width: 1200px) {
    max-width: 996px;
  }
  @media (min-width: 1700px) {
    max-width: 1500px;
    padding-top: 60px;
  }

  .more-btn {
    margin-top: 20px;
    margin-right: auto;
    margin-left: auto;

    @media (min-width: 1700px) {
      margin-top: 55px;
    }
  }
}

.xs, .sm {
  .news-section {
    padding-top: 15px;
    padding-bottom: 40px;

    .more-btn {
      margin-top: 15px;
    }
  }
}

.news-slide-item {
  background-color: #f1f1f1;
}

.news-card {
  display: block;
  text-align: left;
  cursor: pointer;
  text-decoration: none;
  overflow: hidden;
  margin-bottom: 20px;

  &:hover {
    .pic {
      transform: translate(-50%, -50%) scale(1.1);
    }

    .title {
      position: relative;
      transition: all 0.5s;
    }
  }
}

.pic-box {
  width: 100%;
  height: 0;
  padding-top: 62.38%;
  overflow: hidden;
  position: relative;
}

.pic {
  position: absolute;
  top: 50%;
  left: 50%;
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
  width: 100%;
  height: 100%;
  transform: translate(-50%, -50%);
  transition: all 0.5s;
}

.time {
  color: #57585a;
  margin-top: 1.5em;
  margin-bottom: 7.5px;
}

.title {
  color: #18181c;
  line-height: 1.75em;
  height: 4.5em;
}

.lg, .xl {
  .head.news-card {
    display: flex;
    background-color: #000;
    height: 322px !important;

    .pic-box {
      padding-top: 0;
      height: 100%;
      box-sizing: border-box;
    }

    .text {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      padding: 20px;
      text-align: center;

      .time {
        color: #fff;
        margin-bottom: 50px;
        margin-top: 0;
      }

      .title {
        color: #fff;
      }
    }
  }
}

.sm, .xs {
  .time {
    margin-top: 8px;
    margin-bottom: 3px;
  }
}
</style>
