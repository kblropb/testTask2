<template>
    <form id="filter-form" class="ui form" @submit.prevent>
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
</template>

<script>
    import list from './List'
    export default {
        name: "FilterForm",
        components: {
            list
        },

        props: {
            clientCities: Object,
            visitedCities: Object,
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
                this.$emit('change', {
                    clientCities: e.value
                })
            },
            updateVisitedCities(e) {
                this.$emit('change', {
                    visitedCities: e.value
                })
            },
        }
    }
</script>

<style scoped>

</style>