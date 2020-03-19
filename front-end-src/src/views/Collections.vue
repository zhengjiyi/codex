<template>
  <div class="collections-page">
    <div class="page-cover anim" :style="{backgroundImage: `url(${publicPath}frontend-assets/img/cover-collections.jpg)`}" data-effect="fadeIn" data-duration="2s">
    </div>
    <mu-breadcrumbs class="breadcrumbs white anim" data-effect="fadeInUp" data-duration="2s">
      <mu-breadcrumbs-item :to="{ name: 'home', params: { locale } }">{{$t('nav.home')}}</mu-breadcrumbs-item>
      <mu-breadcrumbs-item replace :to="{ name: 'products', params: { seriesId: 'all', locale} }">{{$t('nav.series')}}</mu-breadcrumbs-item>
      <mu-breadcrumbs-item disabled>{{currentSeries.type_name}}</mu-breadcrumbs-item>
    </mu-breadcrumbs>
    <mu-container v-if="!isMobile" class="tabs-container anim" data-effect="fadeInDown" data-duration="2s">
      <mu-tabs class="tabs tabs-header" indicator-color="transparent" :value="activeTabKey" inverse full-width>
        <mu-tab @click="handleTabClick(0)" :value="0" class="tab">{{ $t('nav.simpleSeries')}}</mu-tab>
        <mu-tab @click="handleTabClick(tag.id)" :value="tag.id" class="tab" v-for="tag in tagTypes" :key="tag.id">{{ tag.type }}</mu-tab>
        <div @click="clear" class="mu-tab tab">
          <div class="mu-tab-wrapper">{{ $t('btn.clear')}}</div>
        </div>
      </mu-tabs>
      <mu-form :model="form">
        <mu-form-item class="tab-content" prop="radio" v-show="activeTabKey === 0">
          <mu-col span="6" md="4" lg="3">
            <router-link replace :to="{ name: 'products', params: { seriesId: 'all', locale } }">
              <mu-radio class="radio" v-model="$route.params.seriesId" value="all" :label="$t('nav.allSeries')"></mu-radio>
            </router-link>
          </mu-col>
          <mu-col span="6" md="4" lg="3" v-for="item in goodsSeries" :key="item.id">
            <router-link replace :to="{ name: 'products', params: { seriesId: item.id, locale} }">
              <mu-radio class="radio" v-model="$route.params.seriesId" :value="`${item.id}`" :label="item.type_name"></mu-radio>
            </router-link>
          </mu-col>
        </mu-form-item>
        <mu-form-item v-for="tagType in tagTypes" :key="tagType.id" class="tab-content" prop="checkbox" v-show="activeTabKey === tagType.id">
          <mu-col span="6" md="4" lg="3" v-for="item in tagType.tags" :key="item.id">
          <mu-checkbox class="checkbox" v-model="form.tagIds" :value="item.id" :label="item.tag"></mu-checkbox>
          </mu-col>
        </mu-form-item>
      </mu-form>
    </mu-container>

    <mu-container v-if="isMobile" style="z-index: 3; position: relative;">
      <div style="margin: -40px auto 0; padding: 5px 10px; color: #fff" @click="openFilterDrawer" class="more-btn">{{$t('btn.filter')}}</div>
    </mu-container>
    <mu-container ref="container" class="loadmore-content" data-mu-loading-color="#e4bb95" data-mu-loading-overlay-color="rgba(255, 255, 255, .3)" v-loading="refreshing">
      <mu-load-more @refresh="refresh" :refreshing="refreshing" :loading="loading" @load="load" :loaded-all="total <= goodsList.length">
        <mu-row>
          <mu-col span="6" sm="4" md="4" lg="3" v-for="item in goodsList" :key="item.id">
            <router-link :to="{ name: 'product-detail', params: { id: item.id, seriesId: item.product_type, locale }}" class="goods-card">
              <div class="img-box">
                <div
                  class="img"
                  :style="{backgroundImage: `url(${item.img[0]})`}"
                ></div>
              </div>
              <div class="type">{{item.type}}</div>
              <div class="name">{{item.model}}</div>
              <div class="price">{{$t('goods.unit')}}{{item.price}}</div>
            </router-link>
          </mu-col>
        </mu-row>
      </mu-load-more>
    </mu-container>

    <p v-if="goodsList.length === 0" style="padding: 20px 0 60px; text-align: center; font-size: 1.2em">{{$t('series.notFound')}}</p>

    <mu-drawer
      right
      id="filter-drawer"
      ref="drawer"
      width="300px"
      :open.sync="drawerVisible" :docked="false"
    >
      <menu-btn class="menu-btn" dark :active="drawerVisible" @click="closeFilterDrawer"></menu-btn>
      <mu-button flat class="clear-btn" @click="clear">
        {{$t('btn.clear')}}
        <mu-icon right value="delete"></mu-icon>
      </mu-button>
      <div style="height: 100%; overflow-y: auto; border-top: 1px solid rgba(0,0,0,0.3)">
        <mu-expansion-panel :expand="activeTabKey === 0" @change="toggleFilterDrawerTab(0)">
          <div slot="header">{{$t('nav.simpleSeries')}}</div>
            <mu-col span="12">
              <router-link replace :to="{ name: 'products', params: { seriesId: 'all', locale } }">
                <mu-radio class="radio" v-model="$route.params.seriesId" value="all" :label="$t('nav.allSeries')"></mu-radio>
              </router-link>
            </mu-col>
            <mu-col span="12" v-for="item in goodsSeries" :key="item.id">
              <router-link replace :to="{ name: 'products', params: { seriesId: item.id, locale } }">
                <mu-radio class="radio" v-model="$route.params.seriesId" :value="`${item.id}`" :label="item.type_name"></mu-radio>
              </router-link>
            </mu-col>
        </mu-expansion-panel>
        <mu-expansion-panel v-for="tagType in tagTypes" :key="tagType.id" :expand="activeTabKey === tagType.id" @change="toggleFilterDrawerTab(tagType.id)">
          <div slot="header">{{ tagType.type }}</div>
          <mu-col span="12" v-for="item in tagType.tags" :key="item.id">
            <mu-checkbox class="checkbox" v-model="form.tagIds" :value="item.id" :label="item.tag"></mu-checkbox>
          </mu-col>
        </mu-expansion-panel>
      </div>
    </mu-drawer>
  </div>
</template>

<script>
import { mapState } from 'vuex';
import animateEle from '@/simple.animate';
import { fetchGoods } from '@/api/index';
import MenuBtn from '@/components/MenuBtn.vue';

export default {
  name: 'CollectionsPage',
  components: { MenuBtn },
  data() {
    return {
      drawerVisible: false,
      activeTabKey: '',
      form: {
        seriesId: '',
        tagIds: [],
      },
      goodsList: [],
      refreshing: false,
      loading: false,
      total: 0,
      p: 1,
      limit: 20,
      publicPath: process.env.BASE_URL,
    };
  },
  computed: {
    ...mapState(['goodsSeries', 'tagTypes']),
    locale() {
      return this.$i18n.locale;
    },
    isMobile() {
      return window.innerWidth < 760;
    },
    currentSeries() {
      if (this.form.seriesId === 'all') return { id: 'all', type_name: this.$t('nav.allSeries') };
      return this.goodsSeries.find(item => item.id === this.form.seriesId) || {};
    },
  },
  watch: {
    'form.tagIds': () => {
      this.refresh();
    },
  },
  async beforeRouteUpdate(to, from, next) {
    this.form.seriesId = to.params.seriesId;
    await next();
    await this.refresh();
    this.$nextTick(async () => {
      this.$store.commit('toggleLoadingScene', 100);
    });
  },
  async mounted() {
    this.form.seriesId = this.$route.params.seriesId;
    await this.refresh();
    this.$store.commit('toggleLoadingScene', 100);
    this.$nextTick(() => {
      animateEle(0);
    });

    const thisPage = this;
    document.onclick = function handleDocumentClick(e) {
      const { path } = e;

      const target = path.find((ele) => {
        const className = ele.className || '';
        return className.includes('tab-content') || className.includes('tabs-header');
      });

      if (!target) {
        thisPage.activeTabKey = '';
      }
    };
  },
  destroyed() {
    document.onclick = null;
  },
  methods: {
    openFilterDrawer() {
      if (this.isMobile) {
        this.drawerVisible = true;
      }
    },
    closeFilterDrawer() {
      this.drawerVisible = false;
    },
    toggleFilterDrawerTab(val) {
      this.activeTabKey = this.activeTabKey === val ? '' : val;
    },
    handleTabClick(val) {
      this.activeTabKey = this.activeTabKey !== val ? val : '';
    },
    clear() {
      this.form.tagIds = [];
      this.activeTabKey = '';
    },
    async load() {
      if (this.total <= this.goodsList.length || this.loading) {
        return false;
      }
      this.loading = true;
      if (this.goodsList.length > 0) {
        this.page = this.page + 1;
      }
      const newData = await this.fetchData();
      this.goodsList = [...this.goodsList, ...newData];
      this.loading = false;
    },
    async refresh() {
      this.refreshing = true;
      this.$refs.container.scrollTop = 0;
      this.page = 1;
      const newData = await this.fetchData();
      this.goodsList = [...newData];
      this.refreshing = false;
    },
    async fetchData() {
      const productRes = await fetchGoods({
        typeid: this.form.seriesId,
        tag: this.form.tagIds.join(','),
        p: this.p,
        limit: this.limit,
      });

      this.total = productRes.total;
      return productRes.data;
    },
  },
};
</script>

<style lang="less" scoped>
.page-cover {
  width: 100%;
  height: 800px;
  background-color: #000;
  position: relative;
  box-sizing: border-box;
  overflow: hidden;
  background-repeat: no-repeat;
  background-position: center bottom;
  background-size: auto 100%;
}

.xl {
  .page-cover { height: 800px; }
  .breadcrumbs { padding-top: 120px; }
  .tabs-container { margin-top: 700px; }

  @media (max-width: 1380px) {
    .page-cover { height: 670px; background-size: contain;}
    .tabs-container { margin-top: 580px; }
  }
}

.lg {
  .page-cover { height: 550px; background-size: contain; }
  .breadcrumbs { padding-top: 110px; }
  .tabs-container { margin-top: 470px; }
}

.md {
  .page-cover { height: 440px; background-size: contain; }
  .breadcrumbs { padding-top: 120px; }
  .tabs-container {
    margin-top: 370px;
    .mu-tab-wrapper {
      padding: 5px
    }
  }
}

.sm {
  .page-cover { height: 350px; background-size: auto 300px; }
  .breadcrumbs { padding-top: 100px; }
}

.xs {
  .page-cover { height: 260px; background-size: auto 220px; }
  .breadcrumbs { padding-top: 85px; }
}

.breadcrumbs {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 1;
  padding-top: 105px;
}

.tabs-container {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  margin: 700px auto 0;
  z-index: 2;

  .tabs,
  .tab-content {
    max-width: 980px;
    margin: auto;
  }

  .tab {
    min-width: auto;
    color: #332c2b;
    transition: all 0.3s;

    &:hover {
      color: #e4bb95;
    }
  }

  .mu-tab-active.is-inverse {
    background-color:#e4bb95;
    color: #fff;
  }
}

.tab-content {
  background-color: #fff;
  padding: 20px 30px;
  box-sizing: border-box;
  border-top: 2px solid #ccc;
  box-shadow: 0 5px 5px rgba(0, 0, 0, 0.5);

  a {
    color: rgba(0,0,0,0.54);
  }

  .radio,
  .checkbox {
    margin: 15px 0;
  }
}

.sm {
  .tab-content {
    padding: 10px 10px;

    .radio,
    .checkbox {
      margin: 15px 0;
    }
  }
}

.xs {
  .tab-content {
    padding: 8px 0px;
    .radio,
    .checkbox {
      margin: 10px 0;
    }
  }
}

#filter-drawer {
  padding-top: 55px;

  .menu-btn {
    position: absolute;
    top: 12px;
    right: 5px;
  }

  .clear-btn {
    position: absolute;
    top: 10px;
    left: 0px;
  }
}

.loadmore-content {
  position: relative;
  max-width: 996px;
  margin-bottom: 30px;
}

.goods-card {
  box-sizing: border-box;
  text-align: center;
  text-decoration: none;
  display: block;
  position: relative;
  overflow: hidden;
  cursor: pointer;
  color: #332c2b;
  transition: all 0.5s;
  margin-top: 30px;
  padding-bottom: 15px;

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
    padding-bottom: 140%;
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

.more-btn {
  margin-top: 20px;
}
</style>
