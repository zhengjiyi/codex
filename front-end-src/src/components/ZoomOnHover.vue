<template>
  <div @click="$emit('click')" class="zoom-on-hover" @mousemove="move" @mouseenter="zoom" @mouseleave="unzoom">
    <img class="normal" ref="normal" :src="imgNormal"/>
    <img class="zoom" ref="zoom" :src="imgZoom || imgNormal"/>
  </div>
</template>
<script>
function pageOffset(el) {
  // -> {x: number, y: number}
  // get the left and top offset of a dom block element
  const rect = el.getBoundingClientRect();
  const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
  const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  return {
    y: rect.top + scrollTop,
    x: rect.left + scrollLeft,
  };
}
export default {
  name: 'zoom-on-hover',
  props: ['imgNormal', 'imgZoom', 'scale', 'disabled'],
  data() {
    return {
      scaleFactor: 1,
      resizeCheckInterval: null,
    };
  },
  methods: {
    zoom() {
      if (this.disabled) return;
      this.$refs.zoom.style.opacity = 1;
      this.$refs.normal.style.opacity = 0;
    },
    unzoom() {
      if (this.disabled) return;
      this.$refs.zoom.style.opacity = 0;
      this.$refs.normal.style.opacity = 1;
    },
    move(event) {
      if (this.disabled) return;
      const offset = pageOffset(this.$el);
      const { zoom } = this.$refs;
      // const { normal } = this.$refs;
      const relativeX = event.clientX - offset.x + window.pageXOffset;
      const relativeY = event.clientY - offset.y + window.pageYOffset;
      const normalFactorX = relativeX / this.$el.offsetWidth;
      const normalFactorY = relativeY / this.$el.offsetHeight;
      const x = normalFactorX * (zoom.offsetWidth * this.scaleFactor - this.$el.offsetWidth);
      const y = normalFactorY * (zoom.offsetHeight * this.scaleFactor - this.$el.offsetHeight);
      zoom.style.left = `${-x}px`;
      zoom.style.top = `${-y}px`;
    },
    initEventLoaded() {
      // emit the "loaded" event if all images have been loaded
      const promises = [this.$refs.zoom, this.$refs.normal]
        .map(image => new Promise(((resolve, reject) => {
          image.addEventListener('load', resolve);
          image.addEventListener('error', reject);
        })));
      const component = this;
      Promise.all(promises).then(() => {
        component.$emit('loaded');
        component.scaleFactor = parseFloat(component.$el.offsetWidth / component.$refs.normal.offsetWidth, 10);
        // if (component.scaleFactor < 2) { component.scaleFactor = 2; }
        component.$refs.zoom.style.transform = `scale(${component.scaleFactor})`;
      });
    },
    initEventResized() {
      const { normal } = this.$refs;
      let previousWidth = normal.offsetWidth;
      let previousHeight = normal.offsetHeight;
      const component = this;
      this.resizeCheckInterval = setInterval(() => {
        if ((previousWidth !== normal.offsetWidth) || (previousHeight !== normal.offsetHeight)) {
          previousWidth = normal.offsetWidth;
          previousHeight = normal.offsetHeight;
          component.$emit('resized', {
            width: normal.width,
            height: normal.height,
            fullWidth: normal.naturalWidth,
            fullHeight: normal.naturalHeight,
          });
        }
      }, 1000);
    },
  },
  mounted() {
    if (this.$props.scale) {
      this.scaleFactor = parseInt(this.$props.scale, 10);
      this.$refs.zoom.style.transform = `scale(${this.scaleFactor})`;
    }
    this.initEventLoaded();
    this.initEventResized();
  },
  updated() {
    this.initEventLoaded();
  },
  beforeDestroy() {
    if (this.resizeCheckInterval) {
      clearInterval(this.resizeCheckInterval);
    }
  },
};
</script>
<style lang="less" scoped>
.zoom-on-hover {
  position: relative;
  overflow: hidden;
  height: 100%;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}
.zoom-on-hover .normal {
  display: block;
  margin: auto;
  max-width: 100%;
  max-height: 100%;
}
.zoom-on-hover .zoom {
  position: absolute;
  opacity: 0;
  transform-origin: top left;
}
</style>
