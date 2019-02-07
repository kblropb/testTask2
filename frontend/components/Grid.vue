<template>
    <div id="grid">
        <form id="filter" class="ui form" @submit.prevent>
            <div class="field">
                <div class="four fields">
                    <div class="field">
                        <input type="text" name="name" ref="name" @change="updateName">
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
            </div>
        </form>

        <table class="ui table celled">
            <thead>
            <tr>
                <th v-for="column in columns">{{column}}</th>
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
    import list from './list'

    export default {
        name: "Grid",
        props: {
            value: String,
            columns: Array,
            gridData: Array,
            clientCities: Object,
            visitedCities: Object,
            getGridData: Function
        },
        components: {
            list
        },
        methods: {
            updateName(e) {
                console.log(e);
                this.$emit('change', {
                    name: this.$refs.name.value
                })
            },

            updateClientCities(e) {
                this.$emit('change', {
                    clientCities: e.value
                })
            },
            updateVisitedCities(e) {
                this.$emit('change', {
                    visitedCities: e.value
                })
            }
        }
    }
</script>