<template>
    <div id="app" :class="{'disabled': loading}">
        <div class="ui container">
            <h1>Funking vue components</h1>
            <h3>Выбери значение из списка и через {{this.filterTimeout / 1000}}
                {{this.declension(this.filterTimeout / 1000, ['секунду', 'секунды', 'секунд'])}} обновятся данные</h3>
            <filter-form
                    :clientCities="clientCities"
                    :visitedCities="visitedCities"
                    @change="getGridData"
            />
            <grid
                    :columns="columns"
                    :gridData="gridData"
            />
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import FilterForm from './components/FilterForm'
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
                filterTimeoutId: null,
                filterTimeout: 1500,
            }
        },
        components: {
            FilterForm, Grid
        },
        methods: {
            getGridData(e) {
                if (this.filterTimeoutId) {
                    clearTimeout(this.filterTimeoutId)
                }
                this.filterTimeoutId = setTimeout(() => {
                    this.sendRequest(this.getFilterParams(e), this.hidePreloader);
                }, this.filterTimeout);
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
                let params = this.filter = $.extend({}, this.filter, e);
                params.clientCities = !Array.isArray(params.clientCities) ? params.clientCities.split(',') : params.clientCities;
                params.visitedCities = !Array.isArray(params.visitedCities) ? params.visitedCities.split(',') : params.visitedCities;

                return params
            },

            showPreloader() {
                this.loading = true;
            },

            hidePreloader() {
                this.loading = false;
            },

            declension(number, textForms) {
                number = Math.round(number);
                let cases = [2, 0, 1, 1, 1, 2];
                return textForms[(number % 100 > 4 && number % 100 < 20) ? 2 : cases[(number % 10 < 5) ? number % 10 : 5]];
            }
        }
    }
</script>

<style lang="less">
    #app {
        h1 {
            margin: 3.5rem 0;
        }
        h3 {
            margin: 2.5rem 0;
        }

        &.disabled {
            opacity: .6;

            * {
                cursor: not-allowed;
            }
        }

        th {
            cursor: pointer;
        }
    }
</style>