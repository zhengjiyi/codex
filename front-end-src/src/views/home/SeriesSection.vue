<template>
  <mu-container class="goods-series">
    <h2 class="section-title anim" data-effect="fadeInUp" data-duration="1s">{{$t('home.series')}}</h2>
    <swiper class="series-slide anim" data-effect="fadeInUp" data-duration="1s" ref="seriesSlide" :options="swiperOption">
      <swiper-slide
        class="series-slide-item"
        v-for="item in items"
        :key="item.id"
      >
        <router-link :to="{ name: 'products', params: { seriesId: item.id, locale }}" class="series-slide-item-info">
          <!-- <div
            class="pic"
            :style="{backgroundImage: `url(${item.image})`}"
          ></div> -->
         <div class="pic">
              <!-- <p>{{item.id}}</p> -->
              <img class="code_img" :src="item.image" ref="cd_img" alt="">
          </div>
          <div class="name">{{item.type_name}}</div>
        </router-link>
      </swiper-slide>
      <div class="swiper-pagination series-slide-pagination" slot="pagination"></div>
    </swiper>
    <router-link :to="{ name: 'products', params: { seriesId: 'all', locale}}" class="more-btn anim" data-effect="fadeInUp" data-duration="1s">{{$t('btn.all')}}</router-link>
  </mu-container>
</template>

<script>
import * as swiperAni from '@/swiper.animate.min';

export default {
  name: 'SeriesSection',
  props: {
    items: Array,
  },
  data() {
    return {
      arr:[],
      swiperOption: {
        // loop: true,
        direction: 'horizontal',
        slidesPerView: 5,
        slidesPerGroup: 5,
        spaceBetween: 0,
        // init: false,
        pagination: {
          el: '.series-slide-pagination',
          clickable: true,
        },
        breakpoints: {
          992: {
            slidesPerView: 3,
            slidesPerGroup: 3,
            spaceBetween: 0,
          },
          640: {
            slidesPerView: 2,
            slidesPerGroup: 2,
            spaceBetween: 0,
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
          resize() {
            setTimeout(() => {
              this.update();
            }, 100);
          },
        },
      },
    };
  },
  computed: {
    swiper() {
      return this.$refs.seriesSlide.swiper;
    },
    locale() {
      return this.$i18n.locale;
    },
  },
  mounted() {
    let atr = this.$refs.cd_img;
     atr.forEach((i,v)=>{
       this.arr.push(i)
         if(v==0){
          this.arr[0].alt="codex豪度表";
         }else if(v==1){
           this.arr[1].alt="豪度腕表";
         }else if(v==2){
           this.arr[2].alt="瑞士豪度表";
         }else if(v==3){
           this.arr[3].alt="豪度手表";
         }else if(v==4){
           this.arr[4].alt="codex豪度表";
         }

     })

  }
};
</script>

<style lang="less" scoped>
@import '../../styles/vars.less';

.goods-series {
  @media (min-width: 1200px) {
    max-width: 996px;
  }
  @media (min-width: 1700px) {
    max-width: 1500px;
  }
  padding-top: 30px;
  padding-bottom: 50px;
  position: relative;

  .more-btn {
    margin-right: auto;
    margin-left: auto;
  }
}

.series-slide {
  width: 100%;
  // height: 500px;
  padding-bottom: 80px;
  margin-bottom: 75px;
  background-color: @white;

  @media (max-width: 640px) {
    padding-left: 10%;
    padding-right: 10%;
    padding-bottom: 48px;
    margin-bottom: 50px;
  }

  .series-slide-item {

    .series-slide-item-info {
      text-decoration: none;
      display: block;
      cursor: pointer;
      position: relative;
      overflow: hidden;

      &::after {
        content: "";
        display: block;
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0);
        transition: all 0.3s;
      }

      &:hover::after {
        // background-color: #ececec;
        // display: block;
        left: 0;
        background: rgba(0,0,0,0.1);
      }
    }

    .pic {
      background-size: contain;
      background-position: center center;
      background-repeat: no-repeat;
      width: 100%;
      max-width: 240px;
      height: 0;
      padding-top: 152%;
      margin-left: auto;
      margin-right: auto;
      position:replace;
      .code_img{
        position: absolute;
        top: 0;
      }
    }

    .name {
      color: @black;
      padding-top: 3px;
      padding-bottom: 3px;
      text-align: center;
    }
  }
}

.xs .goods-series {
  padding-bottom: 50px;
  .section-title::after {
    margin-bottom: 10px;
  }
}
</style>
