<template>
    <div id="app" :class="{'disabled': loading}">
        <div class="ui container">
            <h1>Funcking vue components</h1>
            <grid
                    :columns="columns"
                    :gridData="gridData"
                    :clientCities="clientCities"
                    :visitedCities="visitedCities"

                    @change="getGridData"
            />
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import Grid from './components/Grid'

    export default {
        name: "App",
        data() {
            return {
                filter: {
                    clientCities: '',
                    visitedCities: '',
                },
                loading: false,
                columns: [
                    'Имя',
                    'Город',
                    'Район',
                    'Кол-во посещений',
                    'Дата последнего посещения',
                    'Город последнего посещения',
                    'Район последнего посещения'
                ],
                gridData: visits,
                clientCities: {
                    listName: 'clientCities',
                    placeholder: 'Из какого города клиент?',
                    items: clientCities
                },
                visitedCities: {
                    listName: 'visitedCities',
                    placeholder: 'Город последнего посещения',
                    items: clientCities
                },
                filterTimeout: null
            }
        },
        components: {
            Grid
        },
        methods: {
            getGridData(e) {
                if (this.filterTimeout) {
                    clearTimeout(this.filterTimeout)
                }
                this.filterTimeout = setTimeout(() => {
                    this.sendRequest(this.getFilterParams(e), this.hidePreloader);
                }, 1500);
            },

            sendRequest(filterParams, next) {
                this.showPreloader();
                axios.post('visitor/getList', filterParams)
                    .then((response) => {
                        this.gridData = response.data
                    })
                    .catch((error) => {
                        console.log(error)
                    })
                    .finally(() => {
                        next()
                    })
            },

            getFilterParams(e) {
                this.filter = $.extend({}, this.filter, e);
                let params = $.extend({}, this.filter, e);
                params.clientCities = params.clientCities.split(',');
                params.visitedCities = params.visitedCities.split(',');

                return params
            },

            showPreloader() {
                this.loading = true;
            },

            hidePreloader() {
                this.loading = false;
            }
        }
    }
</script>

<style lang="css">
    #app.disabled {
        opacity: .6;
    }

    #app.disabled * {
        cursor: not-allowed;
    }
</style>