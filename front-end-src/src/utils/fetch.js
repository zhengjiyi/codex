/* eslint-disable no-param-reassign */
import axios from 'axios';
import Toast from 'muse-ui-toast';
import store from '../store';
import i18n from '../i18n';
import { getToken } from './auth';

const baseURL ="http://www.codex-watch.ch/api" ; //线上http://www.codex-watch.ch/api  //本地process.env.VUE_APP_API_BASE_URL
console.log('baseURL', baseURL, process.env);
// 创建axios实例
const service = axios.create({
  baseURL, // api的base_url
  timeout: 10000, // 请求超时时间
});

// request拦截器
service.interceptors.request.use((config) => {
  // Do something before request is sent
  if (store.getters.token) {
    config.headers.authorization = getToken(); // 让每个请求携带token--['X-Token']为自定义key 请根据实际情况自行修改
  }
  config.headers.lang = i18n.locale;

  return config;
}, (error) => {
  // Do something with request error
  console.log(error); // for debug
  Promise.reject(error);
});

// respone拦截器
service.interceptors.response.use((response) => {
  /**
      * 下面的注释为通过response自定义code来标示请求状态，当code返回如下情况为权限有问题，登出并返回到登录页
      * 如通过xmlhttprequest 状态码标识 逻辑可写在下面error中
      */
  const res = response.data;
  if (res.err) {
    console.log(res);
    return Promise.reject(new Error(res.msg));
  }
  return res.data;
}, (error) => {
  let { message } = error;
  const { response } = error;
  if (response) {
    const { data } = response;
    if (typeof data === 'object' && typeof data.error === 'string') {
      message = data.error;
    }
  }

  Toast.error(message);
  console.log('afsd', message);
  return Promise.reject(error);
});

export default service;
