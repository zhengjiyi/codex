<template>
  <transition
    enter-active-class="animated fadeIn"
    leave-active-class="animated fadeOut"
  >
    <div
      v-show="tipsDialogVisible"
      @click.self.prevent="hide"
      id="searchDialog" class="dialog"
    >
      <transition
        enter-active-class="animated slideInDown"
        leave-active-class="animated slideOutUp"
      >
        <div v-show="tipsDialogVisible" class="container">
          <menu-btn
            class="close-btn"
            @click="hide" active simple>
          </menu-btn>
          <div class="title">{{$t('tips.name')}}</div>
          <p style="padding: 40px 30px 50px; text-align: center" v-t="'tips.todo'"></p>
          <div @click="hide" class="button">{{$t('btn.ok')}}</div>
        </div>
      </transition>
    </div>
  </transition>
</template>

<script>
import { mapState, mapMutations } from 'vuex';
import MenuBtn from './MenuBtn.vue';

export default {
  name: 'TipsDialog',
  components: {
    MenuBtn,
  },
  data() {
    return {
      keyword: '',
    };
  },
  computed: {
    ...mapState(['tipsDialogVisible']),
  },
  methods: {
    ...mapMutations(['updateTipsDialogVisible']),
    hide() {
      this.updateTipsDialogVisible(false);
    },
  },
};
</script>

<style lang="less" scoped>
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
    }
  }
}
</style>
