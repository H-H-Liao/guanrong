import vuetify from './plugins/vuetify';
/**
 * jQuery
 */
window.$ = window.jQuery = require('jquery');

/**
 * Bootstrap
 */
import Dropdown from 'bootstrap/js/dist/dropdown';
import Tab from 'bootstrap/js/dist/tab';
import Collapse from 'bootstrap/js/dist/collapse';
import Alert from 'bootstrap/js/dist/alert';

/**
 * Axios HTTP library
 */
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * API Token
 */
let apiToken = document.head.querySelector('meta[name="api-token"]');

if (apiToken) {
    window.axios.defaults.headers.common['Authorization'] = `Bearer ${apiToken.content}`;
} else {
    console.error('API token not found.');
}

/**
 * Vue
 */
import Vue from 'vue';
window.Vue = Vue;

/**
 * i18n
 */
import VueI18n from 'vue-i18n';
import cht from '../lang/cht.json';
const messages = { cht };
const i18n = new VueI18n({ locale: window.TypiCMS.locale, messages });

/**
 * Permissions mixin
 */
import Permissions from './mixins/Permissions';
Vue.mixin(Permissions);

/**
 * Date Filter
 */
import date from './filters/Date.js';
Vue.filter('date', date);

/**
 * Datetime Filter
 */
import datetime from './filters/Datetime.js';
Vue.filter('datetime', datetime);

/**
 * Lists
 */
import ItemListColumnHeader from './components/ItemListColumnHeader.vue';
import ItemList from './components/ItemList.vue';
import ItemListWithQuery from './components/ItemListWithQuery.vue';
import ItemListTree from './components/ItemListTree.vue';
import ItemListStatusButton from './components/ItemListStatusButton.vue';
import ItemListCheckbox from './components/ItemListCheckbox.vue';
import ItemListPositionInput from './components/ItemListPositionInput.vue';

/**
 * 促銷
 */
import Promotion from './components/shop/Promotion.vue'
/**
 * History
 */
import History from './components/History.vue';

/**
 * Files
 */
import FileManager from './components/FileManager.vue';
import FileField from './components/FileField.vue';
import FilesField from './components/FilesField.vue';

/**
 * 客製化元件
 */
import ArticleSelect from './components/ArticleSelect.vue'
import DeliveryArea from './components/project/DeliveryArea.vue'
import DeliveryAreaSelectDiv from './components/project/DeliveryAreaSelectDiv.vue';
import ProductSpecification from './components/shop/ProductSpecification.vue'
import Addproduct from './components/Addproduct.vue'

window.EventBus = new Vue({});

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import locale from 'element-ui/lib/locale/lang/zh-TW'

Vue.use(ElementUI, { locale })

new Vue({
    vuetify,
    i18n,
    components: {
        Addproduct,
        DeliveryArea,
        ArticleSelect,
        ItemListWithQuery,
        ItemListColumnHeader,
        ItemList,
        ItemListTree,
        ItemListStatusButton,
        ItemListCheckbox,
        ItemListPositionInput,
        FileManager,
        FilesField,
        FileField,
        History,
        Promotion,
        DeliveryAreaSelectDiv,
        ProductSpecification
    },
}).$mount('#app');

/**
 * Alertify
 */
window.alertify = require('alertify.js');

/**
 * Selectize
 */
require('selectize');

/**
 * All files in /reources/js/admin
 */
var req = require.context('./admin', true, /^(.*\.(js$))[^.]*$/im);
req.keys().forEach(function (key) {
    req(key);
});
