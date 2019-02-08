<template>
    <div id="grid">
        <form id="filter" class="ui form" @submit.prevent>
            <div class="field">
                <div class="two fields">
                    <div class="field">
                        <input type="text" name="name" ref="name" @change="updateName" placeholder="Имя клиента">
                    </div>
                    <list
                            :listName="clientCities.listName"
                            :items="clientCities.items"
                            :placeholder="clientCities.placeholder"
                            @change="updateClientCities"
                    />
                    <list
                            :listName="visitedCities.listName"
                            :items="visitedCities.items"
                            :placeholder="visitedCities.placeholder"
                            :afterSelect="getGridData"
                            @change="updateVisitedCities"
                    />
                </div>

                <div class="two fields">
                    <div class="field">
                        <input type="date" name="from" ref="from" @change="updatePeriod" placeholder="Начиная с">
                    </div>
                    <div class="field">
                        <input type="date" name="to" ref="to" @change="updatePeriod" placeholder="Заканчива по">
                    </div>
                </div>
            </div>
        </form>

        <table class="ui table celled">
            <thead>
            <tr>
                <th v-for="column in columns" @click="sortBy(column.key)">{{column.value}}</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="row in gridData">
                <td class="client-name">{{row.clientName}}</td>
                <td class="city">{{row.clientCity}}</td>
                <td class="district">{{row.clientDistrict}}</td>
                <td class="number-of-visits">{{row.numberOfVisits}}</td>
                <td class="date">{{row.lastVisitDate}}</td>
                <td class="city">{{row.lastVisitedCity}}</td>
                <td class="district">{{row.lastVisitedDistrict}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import list from './List'

    export default {
        name: "Grid",
        props: {
            value: String,
            columns: Array,
            gridData: Array,
            sortKey: String,
            clientCities: Object,
            visitedCities: Object,
            getGridData: Function
        },

        data() {
            return {
                propGridData: this.gridData,

                prevOrderKey: null,
                isReverse: false
            }
        },

        components: {
            list
        },
        methods: {
            updateName() {
                this.$emit('change', {
                    name: this.$refs.name.value
                })
            },

            updatePeriod() {
                this.$emit('change', {
                    dateFrom: this.$refs.from.value,
                    dateTo: this.$refs.to.value,
                })
            },

            updateClientCities(e) {
                console.log(this.propGridData);
                this.$emit('change', {
                    clientCities: e.value
                })
            },
            updateVisitedCities(e) {
                this.$emit('change', {
                    visitedCities: e.value
                })
            },
            sortBy(key) {
                let _this = this;
                if (_this.prevOrderKey === key) {
                    _this.isReverse = !_this.isReverse;
                }
                _this.propGridData.sort((a, b) => {
                    if (a[key] < b[key]) {

                        return _this.isReverse ? 1 : -1;
                    }
                    if (a[key] > b[key]) {
                        return _this.isReverse ? -1 : 1;
                    }
                    return 0;
                });
                _this.prevOrderKey = key;

                this.$emit('sortBy', {
                    data: _this.propGridData
                })
            },
        },
        computed: {
            orderedGridData() {
                return this.propGridData;
            }
        }
    }
</script>
