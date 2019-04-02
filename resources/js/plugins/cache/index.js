import Storage from 'web-storage-cache'

const cache = new Storage({
  storage: 'sessionStorage'
});

export default {
  install (Vue) {
    Vue.prototype.$cache = cache
    Vue.cache = cache
  }
}

export const $cache = cache