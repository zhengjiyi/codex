import fetch from '@/utils/fetch';

export async function fetchBanner() {
  return fetch({
    url: '/banner',
    method: 'get',
  });
}

export async function fetchGoodsSeries() {
  return fetch({
    url: '/series',
    method: 'get',
  });
}

export async function fetchNews(params) {
  return fetch({
    url: '/news',
    method: 'get',
    params,
  });
}

export async function fetchGoods(params) {
  return fetch({
    url: '/product',
    method: 'get',
    params,
  });
}

export async function fetchTags() {
  return fetch({
    url: '/tag',
    method: 'get',
  });
}

export async function fetchGoodsDetail(id) {
  return fetch({
    url: '/product_detail',
    method: 'get',
    params: {
      id,
    },
  });
}

export async function fetchNewsDetail(id) {
  return fetch({
    url: '/news_detail',
    method: 'get',
    params: {
      id,
    },
  });
}

export async function fetchSearch(keyword) {
  return fetch({
    url: '/search',
    method: 'get',
    params: {
      keyword,
    },
  });
}

export async function fetchShops(params) {
  return fetch({
    url: '/shop',
    method: 'get',
    params,
  });
}

export async function fetchShopDetail(id) {
  return fetch({
    url: '/shop_detail',
    method: 'get',
    params: {
      id,
    },
  });
}
