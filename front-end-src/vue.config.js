module.exports = {
  publicPath: './',
  assetsDir: 'frontend-assets',
  css: {
    sourceMap: true,
  },
  pluginOptions: {
    i18n: {
      locale: 'cn',
      fallbackLocale: 'en',
      localeDir: 'locales',
      enableInSFC: true,
    },
  },
  devServer: {
    proxy: 'http://111.230.149.204:90/api',
  },
};
