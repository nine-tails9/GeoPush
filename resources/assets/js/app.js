
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueGeolocation from 'vue-browser-geolocation';

import store from './store.js';

Vue.use(VueGeolocation);

export const EventBus = new Vue();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('chat-messages', require('./components/chat-messages.vue'));

Vue.component('new-chat', require('./components/new-chat.vue'));

Vue.component('my-chats', require('./components/my-chats.vue'));

Vue.component('master', require('./components/master.vue'));

Vue.component('chat-log', require('./components/chatlog.vue'));

Vue.component('area-Chat', require('./components/areaChat.vue'));
const app = new Vue({
    el: '#app',
    store,

    mounted: function() {
      
    },
});
