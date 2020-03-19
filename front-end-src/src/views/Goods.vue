<template>
  <div class="collections-page">
    <mu-breadcrumbs class="breadcrumbs black anim" data-effect="fadeInUp" data-duration="1s">
      <mu-breadcrumbs-item :to="{name: 'home', params: {locale}}">{{$t('nav.home')}}</mu-breadcrumbs-item>
      <mu-breadcrumbs-item replace :to="{ name: 'products', params: { seriesId: 'all', locale}}">{{$t('nav.series')}}</mu-breadcrumbs-item>
      <!-- <mu-breadcrumbs-item disabled>{{currentSeries.type_name}}</mu-breadcrumbs-item> -->
    </mu-breadcrumbs>

    <mu-container class="prev-next">
      <router-link v-if="prevId" class="prev anim" data-effect="fadeInRight" data-duration="1s" :to="{ name: 'product-detail', params: {id: prevId, locale}}"> <i class="iconfont icon-left"></i> {{$t('btn.prev')}}</router-link>
      <router-link v-if="nextId" class="next anim" data-effect="fadeInLeft" data-duration="1s" :to="{ name: 'product-detail', params: {id: nextId, locale}}">{{$t('btn.next')}} <i class="iconfont icon-right"></i></router-link>
    </mu-container>

    <mu-container class="goods-info">
      <mu-row>
        <mu-col span="12" md="4" class="base-info hxl hmd hlg anim" data-effect="fadeInUp" data-duration="1s">
          <div class="type">{{typeName}}</div>
          <div class="model">{{product.model}}</div>

          <mu-row class="price-row">
            <mu-col span="6">
              <div class="price">{{$t('goods.unit')}} {{product.price}}</div>
              <div class="tips">{{$t('goods.priceType')}}</div>
            </mu-col>
            <mu-col span="6">
              <div @click="handleBuy" class="buy-btn"><i class="iconfont icon-cart"></i> {{$t('btn.buy')}}</div>
            </mu-col>
          </mu-row>
        </mu-col>
        <mu-col span="12" md='8' class="image-box-wrap anim" data-effect="fadeInUp" data-duration="1s">
          <div class="image-box">
            <swiper class="goodsimages" ref="goodsimages" id="goodsimages" :options="imageSlideOption">
              <swiper-slide
                class="goodsimages-item"
                v-for="(item, index) in product.img"
                :key="index"
              >
                <zoom-on-hover @click="previewImage(item, index)" :disabled="isMobile" :img-normal="item"></zoom-on-hover>
              </swiper-slide>
              <div class="swiper-pagination goodsimages-pagination" slot="pagination"></div>
            </swiper>
          </div>
        </mu-col>

        <mu-col span="12" md="4" class="base-info anim" data-effect="fadeInUp" data-duration="1s">
          <div class="type hsm hxs">{{typeName}}</div>
          <div class="model hsm hxs">{{product.model}}</div>

          <mu-row class="price-row hsm hxs">
            <mu-col span="6">
              <div class="price">{{$t('goods.unit')}} {{product.price}}</div>
              <div class="tips">{{$t('goods.priceType')}}</div>
            </mu-col>
            <mu-col span="6">
              <div @click="handleBuy" class="buy-btn"><i class="iconfont icon-cart"></i> {{$t('btn.buy')}}</div>
            </mu-col>
          </mu-row>

          <hr />

          <h2 class="section-title anim" data-effect="fadeInUp" data-duration="1s">{{$t('goods.params.name')}}</h2>
          <mu-row class="params">
            <mu-col class="param anim" data-effect="fadeInUp" data-duration="1s" span="12" md="12">
              <p class="key">{{$t('goods.params.jx')}}</p>
              <p class="value">{{product.jx}}</p>
            </mu-col>
            <mu-col class="param anim" data-effect="fadeInUp" data-duration="1s" span="12" md="12">
              <p class="key">{{$t('goods.params.gn')}}</p>
              <p class="value">{{product.gn}}</p>
            </mu-col>
            <mu-col class="param anim" data-effect="fadeInUp" data-duration="1s" span="12" md="12">
              <p class="key">{{$t('goods.params.bk')}}</p>
              <p class="value">{{product.bk}}</p>
            </mu-col>
            <mu-col class="param anim" data-effect="fadeInUp" data-duration="1s" span="12" md="12">
              <p class="key">{{$t('goods.params.bkzj')}}</p>
              <p class="value">{{product.bkzj}}</p>
            </mu-col>
            <mu-col class="param anim" data-effect="fadeInUp" data-duration="1s" span="12" md="12">
              <p class="key">{{$t('goods.params.bj')}}</p>
              <p class="value">{{product.bj}}</p>
            </mu-col>
            <mu-col class="param anim" data-effect="fadeInUp" data-duration="1s" span="12" md="12">
              <p class="key">{{$t('goods.params.bd')}}</p>
              <p class="value">{{product.bd}}</p>
            </mu-col>
            <mu-col class="param anim" data-effect="fadeInUp" data-duration="1s" span="12" md="12">
              <p class="key">{{$t('goods.params.dg')}}</p>
              <p class="value">{{product.dg}}</p>
            </mu-col>
            <mu-col class="param anim" data-effect="fadeInUp" data-duration="1s" span="12" md="12">
              <p class="key">{{$t('goods.params.fs')}}</p>
              <p class="value">{{product.fs}}</p>
            </mu-col>
          </mu-row>

          <hr />

          <mu-list class="share-buttons">
            <li><a target="_blank" :href="shareUrl.facebook" class="mu-item-wrapper">
              <i class="iconfont icon-facebook"></i>
            </a></li>
            <li><a target="_blank" :href="shareUrl.twitter" class="mu-item-wrapper">
              <i class="iconfont icon-twitter"></i>
            </a></li>
            <li><a target="_blank" :href="shareUrl.weibo" class="mu-item-wrapper">
              <i class="iconfont icon-weibo"></i>
            </a></li>
            <li><a target="_blank" :href="shareUrl.qq" class="mu-item-wrapper">
              <i class="iconfont icon-qq"></i>
            </a></li>
            <li @click="wxDialogVisible = true">
              <i class="iconfont icon-wechat"></i>
            </li>
          </mu-list>
        </mu-col>
      </mu-row>
    </mu-container>

    <!-- <mu-container class="goods-params">
      <h2 class="section-title anim" data-effect="fadeInUp" data-duration="1s">{{$t('goods.params.name')}}</h2>
      <mu-row class="params">
        <mu-col class="param anim" data-effect="fadeInUp" data-duration="1s" span="12" md="12">
          <p class="key">-{{$t('goods.params.jx')}}-</p>
          <p class="value">{{product.jx}}</p>
        </mu-col>
        <mu-col class="param anim" data-effect="fadeInUp" data-duration="1s" span="12" md="12">
          <p class="key">-{{$t('goods.params.gn')}}-</p>
          <p class="value">{{product.gn}}</p>
        </mu-col>
        <mu-col class="param anim" data-effect="fadeInUp" data-duration="1s" span="12" md="12">
          <p class="key">-{{$t('goods.params.bk')}}-</p>
          <p class="value">{{product.bk}}</p>
        </mu-col>
        <mu-col class="param anim" data-effect="fadeInUp" data-duration="1s" span="12" md="12">
          <p class="key">-{{$t('goods.params.bkzj')}}-</p>
          <p class="value">{{product.bkzj}}</p>
        </mu-col>
        <mu-col class="param anim" data-effect="fadeInUp" data-duration="1s" span="12" md="12">
          <p class="key">-{{$t('goods.params.bj')}}-</p>
          <p class="value">{{product.bj}}</p>
        </mu-col>
        <mu-col class="param anim" data-effect="fadeInUp" data-duration="1s" span="12" md="12">
          <p class="key">-{{$t('goods.params.bd')}}-</p>
          <p class="value">{{product.bd}}</p>
        </mu-col>
        <mu-col class="param anim" data-effect="fadeInUp" data-duration="1s" span="12" md="12">
          <p class="key">-{{$t('goods.params.dg')}}-</p>
          <p class="value">{{product.dg}}</p>
        </mu-col>
      </mu-row>
    </mu-container> -->

    <section class="ad-img" v-if="product.ad_img && product.ad_img.length > 0">
      <img v-for="(img, index) in product.ad_img" :key="index" :src="img" alt="">
    </section>

    <mu-container class="relative-goods" v-show="recommends.length > 0">
      <h2 class="section-title">{{$t('goods.relative')}}</h2>
      <swiper class="goods-slide anim" data-effect="fadeInUp" data-duration="1s" ref="goodsSlide" :options="goodsSwiperOption">
        <swiper-slide
          class="goods-slide-item"
          v-for="item in recommends"
          :key="item.id"
        >
          <router-link :to="{ name: 'product-detail', params: { id: item.id, locale, seriesId: item.product_type }}" class="goods-card">
            <div class="img-box">
              <div
                class="img"
                :style="{backgroundImage: `url(${item.img[0]})`}"
              ></div>
            </div>
            <div class="type">{{item.type}}</div>
            <div class="name">{{item.model}}</div>
            <div class="price">￥{{item.price}}</div>
          </router-link>
        </swiper-slide>
        <div class="goods-swiper-button-prev swiper-button-prev" slot="button-prev">
          <i class="iconfont icon-left"></i>
        </div><!--左箭头-->
        <div class="goods-swiper-button-next swiper-button-next" slot="button-next">
          <i class="iconfont icon-right"></i>
        </div><!--右箭头-->
        <div class="swiper-pagination goods-slide-pagination" slot="pagination"></div>
      </swiper>
    </mu-container>

    <mu-dialog width="270" :open.sync="wxDialogVisible">
      <qrcode :value="shareUrl.wechat" :options="{ width: 220 }"></qrcode>
    </mu-dialog>
  </div>
</template>

<script>
import { mapState } from 'vuex';
import VueQrcode from '@chenfengyuan/vue-qrcode';
import ImagePreview from 'vant/lib/image-preview';
import 'vant/lib/image-preview/index.css';
import 'vant/lib/overlay/index.css';
import 'vant/lib/swipe/index.css';
import 'vant/lib/swipe-item/index.css';
import animateEle from '@/simple.animate';
import { fetchGoodsDetail } from '@/api/index';
import ZoomOnHover from '@/components/ZoomOnHover';

export default {
  name: 'GoodsDetail',
  components: {
    [VueQrcode.name]: VueQrcode,
    ZoomOnHover,
  },
  data() {
    return {
      wxDialogVisible: false,
      imageSlideOption: {
        loop: true,
        initialSlide: 0,
        direction: 'horizontal',
        autoplay: {
          delay: 5000,
        },
        pagination: { el: '.goodsimages-pagination', clickable: true },
        on: {
          resize() {
            setTimeout(() => {
              this.update();
            }, 100);
          },
        },
      },
      goodsSwiperOption: {
        // loop: true,
        // centeredSlides: true,
        direction: 'horizontal',
        slidesPerView: 3,
        slidesPerGroup: 3,
        spaceBetween: 40,
        // init: false,
        pagination: {
          el: '.goods-slide-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: '.goods-swiper-button-next',
          prevEl: '.goods-swiper-button-prev',
        },
        breakpoints: {
          992: {
            slidesPerView: 3,
            slidesPerGroup: 3,
            spaceBetween: 30,
          },
          640: {
            slidesPerView: 2,
            slidesPerGroup: 2,
            spaceBetween: 0,
          },
        },
        on: {
          resize() {
            setTimeout(() => {
              this.update();
            }, 100);
          },
        },
      },
      shareMenuVisible: false,
      sharePopoverVisible: false,
      product: {
        img: [],
      },
      recommends: [],
      nextId: '',
      prevId: '',
    };
  },
  computed: {
    isMobile() {
      return window.innerWidth < 600;
    },
    ...mapState(['goodsSeries']),
    typeName() {
      const type = this.goodsSeries.find(i => i.id === this.product.product_type);
      if (type) return type.type_name;
      return '';
    },
    locale() {
      return this.$i18n.locale;
    },
    shareUrl() {
      const url = encodeURIComponent(window.location.href);
      const origin = encodeURIComponent(window.location.origin);
      const title = encodeURIComponent(`#CODEX - ${this.typeName} - ${this.product.model}`);
      const image = encodeURIComponent(this.product.img[0]);

      return {
        wechat: window.location.href,
        facebook: `https://www.facebook.com/sharer/sharer.php?u=${url}`,
        twitter: `https://twitter.com/intent/tweet?text=&url=${url}&via=${origin}`,
        weibo: `http://service.weibo.com/share/share.php?url=${url}&title=${title}&pic=${image}&appkey=`,
        qq: `http://connect.qq.com/widget/shareqq/index.html?url=${url}&title=${title}&source=&desc=&pics=${image}`,
      };
    },
  },
  async beforeRouteUpdate(to, from, next) {
    if (to.params.id !== from.params.id) {
      this.$store.commit('toggleLoadingScene', 0);
    }
    await next();
    await this.fetchData();
    this.$store.commit('toggleLoadingScene', 100);
    this.$nextTick(() => {
      animateEle(0);
    });
  },
  async mounted() {
    await this.fetchData();
    this.$store.commit('toggleLoadingScene', 100);
    this.$nextTick(() => {
      animateEle(0);
      const { goodsimages } = this.$refs;
      goodsimages.$el.onmouseenter = () => {
        goodsimages.swiper.autoplay.stop();
      };

      goodsimages.$el.onmouseleave = () => {
        goodsimages.swiper.autoplay.start();
      };
    });
  },
  methods: {
    async fetchData() {
      const { id } = this.$route.params;
      const {
        product, recommend, next_id, prev_id,
      } = await fetchGoodsDetail(id);
      this.product = product;
      this.recommends = recommend;
      this.nextId = next_id;
      this.prevId = prev_id;
      this.$nextTick(() => {
        if (this.swiper) {
          this.swiper.update();
          this.swiper.slideTo(0, 1000, false);// 切换到第一个slide，速度为1秒
        }
      });
    },
    toggleShareMenu() {
      this.shareMenuVisible = !this.shareMenuVisible;
      this.sharePopoverVisible = !this.sharePopoverVisible;
    },
    handleBuy() {
      // this.$alert(this.$t('tips.todo'), this.$t('tips.name'), {
      //   type: 'info',
      //   okLabel: this.$t('btn.close'),
      // });
      this.$store.commit('updateTipsDialogVisible', true);
    },
    previewImage(image, index) {
      console.log(image, index, this.isMobile, ImagePreview, this.product.img);
      if (this.isMobile) {
        ImagePreview({
          images: this.product.img,
          startPosition: index,
        });
      }
    },
  },
};
</script>

<style lang="less" scoped>

.goodsimages {
  position: absolute;
  top: 0; left: 0;
  width: 100%;
  height: 100%;
  border: 1px solid #ccc;

  .goodsimages-item {
    width: 100%;
    height: 100%;
    background-position: center center;
    background-size: contain;
    background-repeat: no-repeat;
  }

  > .swiper-pagination-bullets {
    bottom: 0;
  }
}

.goods-info {
  margin-bottom: 30px;

  @media (min-width: 1200px) {
    max-width: 1000px;
    margin-bottom: 70px;
  }


  .image-box-wrap {
    padding-right: 40px;
    max-width: 630px;
  }

  .image-box {
    width: 100%;
    height: 0;
    padding-top: 135.48%;
    position: relative;
  }

  .base-info {
    text-align: left;

    .model {
      font-size: 20px;
      font-weight: 800;
      line-height: 1em;
      margin-bottom: 1em;
    }
    .type {
      font-size: 20px;
      line-height: 1em;
      margin-bottom: 0.5em;
      font-weight: 600;
    }
    .intro {
      line-height: 28px;
      margin-bottom: 18px;
    }
    .price {
      font-size: 20px;
      line-height: 1em;
      margin-bottom: 0.2em;
    }
    .tips {
      line-height: 18px;
      color: #5f5d5d;
    }

    .price-row {
      margin-bottom: 10px;
    }

    .params {
      margin-bottom: 10px;
      margin-top: 20px;
    }

    .section-title {
      font-size: 20px;
      font-weight: 600;
      text-align: left;
      margin-top: 20px;

      &:after {
        margin-left: 0;
        margin-right: 0;
        margin-top: 15px;
        margin-bottom: 20px;
      }
    }

    .param {
      margin-bottom: 1em;

      .key {
        font-weight: 900;
        font-size: 1.1em;
      }

      .value {
        color: #5f5d5d;
      }
    }

    .buy-btn,
    .share-btn {
      display: block;
      box-sizing: border-box;
      text-align: center;
      font-size: 16px;
      color: #fff;
      padding: 7px;
      background-color: #0b0b0b;
      cursor: pointer;
      outline: none;
      border: none;

      .iconfont {
        font-size: 18px;
      }
    }

    .share-btn {
      margin-top: 20px;
      background-color: #fff;
      border: 1px solid #000;
      color: #000;
    }
  }

  .share-buttons {
    li {
      cursor: pointer;
      color: #5f5d5d;

      &:hover {
        color: #e4bb95;
      }
    }
  }
}

.md .goods-info {
  .image-box-wrap {
    padding-right: 30px;
  }

  .base-info {

    .model {
      font-size: 16px;
    }
    .type {
      font-size: 16px;
    }
    .price {
      font-size: 18px;
    }
    .tips {
      line-height: 16px;
    }

    .section-title {
      font-size: 16px;
      display: none;

      &:after {
        margin-top: 5px;
        margin-bottom: 10px;
      }
    }

    .params {
      margin-bottom: 10px;
      margin-top: 15px;
    }

    .param {
      margin-bottom: 0.3em;

      .key {
        font-size: 1em;
        font-weight: 600;
      }

      .value {
        font-size: 1em;
      }
    }

    .share-buttons {
      padding-top: 0;
    }
  }
}

.sm .goods-info {
  .image-box-wrap {
    padding-right: 0;
    margin-bottom: 30px;
  }

  .base-info {

    .model {
      font-size: 16px;
    }
    .type {
      font-size: 16px;
    }

    .price {
      font-size: 24px;
    }
    .tips {
      line-height: 16px;
    }

    .share-btn {
      margin-top: 17px;
    }
  }
}

.xs .goods-info {
  .image-box-wrap {
    padding-right: 0;
    margin-bottom: 30px;
  }

  .base-info {

    .model {
      font-size: 14px;
    }
    .type {
      font-size: 14px;
    }
    .price {
      font-size: 20px;
    }
    .tips {
      line-height: 14px;
    }

    .buy-btn,
    .share-btn {
      padding: 6px;
    }

    .share-btn {
      margin-top: 15px;
    }
  }
}

.goods-params {
  @media (min-width: 1200px) {
    max-width: 996px;
  }

  @media (min-width: 1700px) {
    max-width: 1500px;
  }
  padding-top: 70px;
  padding-bottom: 80px;
  text-align: left;

  .params {
    display: flex;
    flex-direction: row;
    line-height: 24px;

    .param {
      padding: 0 24px;
    }

    .key {
      font-size: 18px;
      margin-bottom: 0.7em;
      font-weight: 500;
    }

    .value {
      margin-bottom: 3em;
    }
  }
}

.sm, .xs {
  .goods-params {
    padding-top: 40px;
    padding-bottom: 40px;
  }
}

.ad-img {
  background-size: contain;
  background-position: center center;

  img {
    display: block;
    margin: auto;
    margin-top: 5px;
    width: 100%;
  }
}

.relative-goods {
  padding-top: 80px;
  padding-bottom: 50px;
  @media (min-width: 1200px) {
    max-width: 996px;
  }

  @media (min-width: 1700px) {
    max-width: 1500px;
  }
}

.goods-slide {
  padding-bottom: 40px;
  padding-left: 40px;
  padding-right: 40px;
  @media (max-width: 640px) {
    padding-left: 10%;
    padding-right: 10%;
    .goods-swiper-button-prev,
    .goods-swiper-button-next {
      display: none;
    }
  }
}

.goods-card {
  max-width: 220px;
  margin: auto;
  box-sizing: border-box;
  text-align: center;
  text-decoration: none;
  display: block;
  position: relative;
  overflow: hidden;
  cursor: pointer;
  color: #332c2b;
  transition: all 0.5s;

  &:hover::after {
    left: 0;
  }

  &::after {
    content: "";
    display: block;
    left: -100%;
    top: 0;
    width: 100%;
    height: 100%;
    position: absolute;
    background: rgba(0,0,0,0.1);
    transition: all 0.5s;
  }

  .img-box {
    overflow: hidden;
    height: 0;
    width: 100%;
    padding-bottom: 175%;
    position: relative;

    .img {
      background-repeat: no-repeat;
      background-size: contain;
      background-position: center center;
      width: 100%;
      height: 100%;
      position: absolute;
      top: 0;
      left: 0;
    }
  }

  .type {
    margin-top: 5px;
    margin-bottom: 4px;
    color: #595757;
  }

  .name, .price {
    font-size: 1.1em;
    line-height: 1.5em;
  }
}

.goods-swiper-button-prev,
.goods-swiper-button-next {
  background: none;
  outline: none;
  display: flex;
  align-items: center;
  justify-content: center;

  .iconfont {
    font-size: 55px;
    font-weight: 600;
    line-height: 1em;
    color: #e4bb95;
  }
}

.share-buttons {
  li {
    display: inline-block;
    margin-right: 10px;
  }
  .iconfont {
    font-size: 24px;
  }
}
</style>
