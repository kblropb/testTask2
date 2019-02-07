<template>
    <div id="app" :class="{'disabled': loading}">
        <div class="ui container">
            <h1>Funcking vue components</h1>
            <h3>Выбери значение из спика и через 1.5 секунды обновятся данные</h3>
            <grid
                    :columns="columns"
                    :gridData="gridData"
                    :clientCities="clientCities"
                    :visitedCities="visitedCities"
                    @change="getGridData"
                    @sortBy="sortBy"
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
                    name: '',
                    dateFrom: null,
                    dateTo: null
                },
                loading: false,
                columns: [
                    {key: 'clientName', value: 'Имя'},
                    {key: 'clientCity', value: 'Город'},
                    {key: 'clientDistrict', value: 'Район'},
                    {key: 'numberOfVisits', value: 'Кол-во посещений'},
                    {key: 'lastVisitDate', value: 'Дата последнего посещения'},
                    {key: 'lastVisitedCity', value: 'Город последнего посещения'},
                    {key: 'lastVisitedDistrict', value: 'Район последнего посещения'},
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
                prevOrderKey: null,
                isReverse: false,
                filterTimeout: null
            }
        },
        components: {
            Grid
        },
        methods: {
            sortBy(e) {
                let _this = this;
                if (_this.prevOrderKey === e.key) {
                    _this.isReverse = !_this.isReverse;
                }
                _this.gridData.sort((a, b) => {
                    if (a[e.key] < b[e.key]) {

                        return _this.isReverse ? 1 : -1;
                    }
                    if (a[e.key] > b[e.key]) {
                        return _this.isReverse ? -1 : 1;
                    }
                    return 0;
                });
                _this.prevOrderKey = e.key
            },

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

    #app th {
        cursor: pointer;
    }
</style>