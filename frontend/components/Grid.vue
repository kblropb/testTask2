<template>
    <div id="grid">
        <form id="filter" class="ui form">
            <div class="field">
                <div class="two fields">
                    <list
                            :listName="clientCities.listName"
                            :items="clientCities.items"
                            :placeholder="clientCities.placeholder"
                    />
                    <list
                            :listName="lastVisitedCities.listName"
                            :items="lastVisitedCities.items"
                            :placeholder="lastVisitedCities.placeholder"
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
            columns: Array,
            gridData: Array,
            clientCities: Object,
            lastVisitedCities: Object
        },
        components: {
            list
        }
    }

</script>