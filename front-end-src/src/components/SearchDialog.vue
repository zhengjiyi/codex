<template>
  <transition
    enter-active-class="animated fadeIn"
    leave-active-class="animated fadeOut"
  >
    <div
      v-show="searchDialogVisible"
      @click.self.prevent="hide"
      id="searchDialog" class="dialog"
    >
      <transition
        enter-active-class="animated slideInDown"
        leave-active-class="animated slideOutUp"
      >
        <div v-show="searchDialogVisible" class="container">
          <menu-btn
            class="close-btn"
            @click="hide" active simple>
          </menu-btn>
          <div class="title">{{$t('btn.search')}}</div>
          <form action="" class="search-form">
            <div class="field">
              <input v-model="keyword" type="text" :placeholder="$t('search.keywordPlaceholder')">
              <button class="button" type="button" @click="handleSearch">
                <i class="iconfont icon-search"></i>
              </button>
            </div>
          </form>
          <div class="tips">{{$t('search.needHelp')}}</div>
          <a href="tel:0755-82371248" class="button">{{$t('nav.contactUs')}}</a>
        </div>
      </transition>
    </div>
  </transition>
</template>

<script>
import { mapState, mapMutations } from 'vuex';
import MenuBtn from './MenuBtn.vue';

export default {
  name: 'searchDialog',
  components: {
    MenuBtn,
  },
  data() {
    return {
      keyword: '',
    };
  },
  computed: {
    ...mapState(['searchDialogVisible']),
  },
  methods: {
    ...mapMutations(['updateSearchDialogVisible']),
    hide() {
      this.updateSearchDialogVisible(false);
    },
    handleSearch() {
      this.$router.push({ name: 'search', query: { keyword: this.keyword } });
      this.hide();
    },
  },
};
</script>

<style lang="less" scoped>
.search-form {
  margin-top: 50px;
  margin-bottom: 15px;
}

.dialog {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.7);
  z-index: 100;
  animation-duration: 0.5s;

  .container {
    position: relative;
    background-color: #fff;
    margin-left: auto;
    margin-right: auto;
    box-sizing: border-box;
    margin-top: 144px;
    width: 345px;
    max-width: 90%;
    padding: 60px 30px 40px;
    animation-duration: 0.5s;

    .title {
      text-align: center;
      font-size: 30px;
      font-weight: 300;
      line-height: 1em;

      &:after {
        content: "";
        display: block;
        width: 60px;
        height: 1px;
        background-color: #e4bb95;
        margin: 22px auto 15px;
      }
    }

    .tips {
      margin-top: 45px;
      color: #57585a;
      margin-bottom: 18px;
      text-align: center;
    }

    .button {
      display: block;
      box-sizing: border-box;
      text-align: center;
      font-size: 16px;
      color: #fff;
      padding: 10px 15px;
      background-color: #0b0b0b;
      cursor: pointer;
      outline: none;
      border: none;

      .iconfont {
        font-size: 18px;
      }
    }
  }

  .field {
    border: 1px solid #000;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    background-color: #fff;
  }

  input {
    font-size: 16x;
    line-height: 1em;
    border: none;
    padding: 12px 7px;
    color: #57585a;
    flex: 1;
    outline-color: #e4bb95;
  }

  .close-btn {
    position: absolute;
    top: 15px;
    right: 15px;
    transform-origin: top right;
  }
}


.md {
  .dialog {
    .container {
      margin-top: 100px;
      padding: 60px 30px 30px;

      .title {
        font-size: 24px;
      }

      .tips {
        margin-top: 45px;
      }

      .search-form {
        margin-top: 20px;
        margin-bottom: 0;
      }
    }
  }
}

.sm, .xs {
  .dialog {
    .container {
      margin-top: 60px;
      padding: 60px 20px 20px;

      .title {
        font-size: 24px;
      }

      .tips {
        margin-top: 25px;
      }

      .search-form {
        margin-top: 20px;
        margin-bottom: 0;
      }
    }
  }
}
</style>
