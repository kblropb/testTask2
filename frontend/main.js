window.$ = window.jQuery = require("jquery");

import Vue from 'vue'
import './js/grid';

let app = new Vue({
    el: '#app',
    data: {
        columns: [
            'Имя',
            'Город',
            'Район',
            'Кол-во посещений',
            'Дата последнего посещения',
            'Город последнего посещения',
            'Район последнего посещения'
        ],
        visits: visits,
    }
});