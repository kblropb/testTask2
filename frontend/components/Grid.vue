<template>
    <div id="grid">
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
    export default {
        name: "Grid",
        props: {
            columns: Array,
            gridData: Array,
            sortKey: String,
            getGridData: Function
        },

        data() {
            return {
                propGridData: this.gridData,

                prevOrderKey: null,
                isReverse: false
            }
        },

        methods: {
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
        }
    }
</script>
