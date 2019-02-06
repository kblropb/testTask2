import Vue from 'vue'

Vue.component('grid', {
    template: '#grid',
    props: {
        data: Array,
        columns: Array
    }
})