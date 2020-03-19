/* eslint-disable no-param-reassign */
import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

// eslint-disable-next-line radix
const initPrecent = parseInt(document.getElementById('init-progress-value').style.width);
document.getElementById('init-loading-scene').remove();

export default new Vuex.Store({
  state: {
    loadingScene: {
      precent: initPrecent,
    },
    drawer: {
      visible: false,
      top: 0,
      left: 0,
    },
    goodsSeries: [],
    tagTypes: [],
    searchDialogVisible: false,
    tipsDialogVisible: false,
  },
  mutations: {
    toggleLoadingScene(state, precent) {
      state.loadingScene.precent = precent || 0;
    },
    setDrawer(state, { visible, top, left }) {
      if (visible !== undefined) state.drawer.visible = visible;
      if (top !== undefined) state.drawer.top = top;
      if (left !== undefined) state.drawer.left = left;
    },
    updateSeries(state, payload) {
      state.goodsSeries = payload;
    },
    updateTags(state, payload) {
      state.tagTypes = payload;
    },
    updateSearchDialogVisible(state, val) {
      state.searchDialogVisible = val;
    },
    updateTipsDialogVisible(state, val) {
      state.tipsDialogVisible = val;
    },
  },
  actions: {

  },
});
