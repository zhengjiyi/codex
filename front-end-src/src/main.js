import Vue from 'vue';
import MuseUI from 'muse-ui';
import Toast from 'muse-ui-toast';
import Message from 'muse-ui-message';
import Loading from 'muse-ui-loading';
import 'animate.css';
import 'muse-ui-message/dist/muse-ui-message.css';
import 'muse-ui-loading/dist/muse-ui-loading.css';
import 'vue-social-share/dist/client.css';

import MtaH5 from 'mta-h5-analysis';

import './theme';
import './styles/index.less';
import './swiper';
import App from './App.vue';
import router from './router';
import store from './store';
import i18n from './i18n';

Vue.use(MuseUI);
Vue.use(Toast);
Vue.use(Message);
Vue.use(Loading);

Vue.config.productionTip = false;

// prod env do not load vconsole
if (process.env.NODE_ENV === 'production') {
  // 初始化
  MtaH5.init({
    sid: '500668159', // 必填，统计用的appid
    cid: '500680178', // 如果开启自定义事件，此项目为必填，否则不填
    autoReport: 1, // 是否开启自动上报(1:init完成则上报一次,0:使用pgv方法才上报)
    senseHash: 1, // hash锚点是否进入url统计
    senseQuery: 1, // url参数是否进入url统计
    performanceMonitor: 1, // 是否开启性能监控
    ignoreParams: ['token', 'v', 'from'], // 开启url参数上报时，可忽略部分参数拼接上报
  });
}

new Vue({
  router,
  store,
  i18n,
  render: h => h(App),
}).$mount('#app');
