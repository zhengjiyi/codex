<template>
  <div @click="handleClick" :class="{'menu-btn': true, active, dark, simple }">
    <div class="box">
      <div class="line line-1"></div>
      <div class="line line-2"></div>
      <div class="line line-3"></div>
    </div>
    <div class="text" v-if="!simple">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  name: 'MenuBtn',
  props: {
    active: Boolean,
    dark: Boolean,
    simple: Boolean,
  },
  methods: {
    handleClick() {
      this.$emit('click');
    },
  },
};
</script>

<style lang="less" scoped>
@import '../styles/vars.less';

.menu-btn {
  cursor: pointer;
  display: inline;

  .box {
    display: inline-block;
    box-sizing: border-box;
    width: 30px;
    height: 30px;
    padding: 1px 5px;
    border: 1px solid @white;
    vertical-align: middle;
    transition: all 0.5s;

    .line {
      width: 18px;
      height: 2px;
      background-color: @white;
      margin-top: 5px;
      margin-bottom: 5px;
      transition: all 0.5s;
    }
  }

  .text {
    display: inline-block;
    vertical-align: middle;
    color: @white;
    transition: all 0.5s;
    margin-left: 25px;
  }

  &.dark {
    .box {
      border-color: #5f5d5d;

      .line {
        background-color: #5f5d5d;
      }
    }

    .text {
      color: #5f5d5d;
    }
  }

  &.active {
    .box {
      border-color: #5f5d5d;

      .line-1 {
        background-color: #5f5d5d;
        transform-origin: 0px 5px;
        transform: rotate(45deg);
      }

      .line-2 {
        background-color: transparent;
      }

      .line-3 {
        background-color: #5f5d5d;
        transform-origin: 1px -2px;
        transform: rotate(-45deg);
      }
    }

    .text {
      color: #5f5d5d;
    }
  }
}

.xs .menu-btn {
  .text {
    margin-left: 10px;
  }
}
</style>
