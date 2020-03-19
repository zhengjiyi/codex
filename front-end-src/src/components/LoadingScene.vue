<template>
  <transition name="slide-fade">
    <div v-if="visible" class="loading-scene">
      <img :src="`${baseUrl}frontend-assets/img/logo-x-white.png`" class="loading-logo">
      <div class="loading-progress-bar nostripes">
        <span :style="`width: ${precent}%`"></span>
      </div>
    </div>
  </transition>
</template>

<script>
export default {
  name: 'LoadingScene',
  data() {
    return {
      baseUrl: process.env.BASE_URL,
      visible: true,
    };
  },
  computed: {
    precent() {
      return this.$store.state.loadingScene.precent;
    },
  },
  mounted() {
    if (this.precent === 100) {
      setTimeout(() => {
        this.visible = false;
      }, 800);
    }
  },
  watch: {
    precent(val) {
      if (val === 100) {
        setTimeout(() => {
          this.visible = false;
        }, 800);
      } else {
        this.visible = true;
      }
    },
  },
};
</script>

<style scoped lang="less">
.slide-fade-enter-active {
  transition: all 0.5s cubic-bezier(0.075, 0.82, 0.165, 1);
}
.slide-fade-leave-active {
  transition: all 1s ease;
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active for below version 2.1.8 */ {
  transform: translateX(100%);
  // opacity: 0;
}
</style>
