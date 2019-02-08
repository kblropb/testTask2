window.$ = window.jQuery = require("jquery");

import Vue from 'vue'
import App from './App'

let app = new Vue({
    el: '#app',
    template: '<App/>',
    components: {
        App
    }
});

$(function () {
    $('.dropdown').dropdown();
})