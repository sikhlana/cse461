
require('./bootstrap');

import Vue from 'vue';

import App from './pages/App';
import ItemList from './modules/ItemList';
import ImageUploader from './modules/ImageUploader';

Vue.component('item-list', ItemList);
Vue.component('image-uploader', ImageUploader);

window.Vue = Vue;
window.app = new Vue({...App}).$mount('#app');
