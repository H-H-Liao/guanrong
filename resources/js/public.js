/**
 * Vue
 */
import Vue from 'vue';

import QuickSearch from './components/QuickSearch.vue'
import Cart from './components/shop/Cart.vue'
import ProductCart from './components/shop/ProductCart.vue'
import MiniCart from './components/shop/MiniCart.vue'
import MiniCartNumber from './components/shop/MiniCartNumber.vue'
import Combo from './components/shop/Combo.vue'
import Vuex from 'vuex'

window.Vue = Vue;


Vue.config.productionTip = false

// 创建一个新的 store 实例
const store = new Vuex.Store({
  state () {
    return {
      count: 0,
      state:false
    }
  },
  mutations: {
    increment (state,$value) {
      state.count = $value;
    },
    setState(state,$value){
        state.state = $value
    }
  }
})



new Vue({
    store,
    components: {
        QuickSearch,
        ProductCart,
        Cart,
        MiniCart,
        MiniCartNumber,
        Combo
    },
}).$mount('#app');
