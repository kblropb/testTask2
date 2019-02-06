<template>
    <div id="app">
        <div class="ui container">
            <h1>Funcking vue components</h1>
            <grid
                    :columns="columns"
                    :gridData="gridData"
                    :clientCities="clientCities"
                    :lastVisitedCities="lastVisitedCities"
            />
        </div>
    </div>
</template>

<script>

    import Grid from './components/Grid'

    export default {
        name: "App",
        data() {
            return {
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
                    listName: 'clientCity',
                    placeholder: 'Из какого города клиент?',
                    items: [
                        {
                            value: 1,
                            text: 'Жлобин'
                        },
                        {
                            value: 2,
                            text: 'Гомель',
                        }
                    ]
                },
                lastVisitedCities: {
                    listName: 'lastVisitedCity',
                    placeholder: 'Город последнего посещения',
                    items: [
                        {
                            value: 1,
                            text: 'Жлобин'
                        },
                        {
                            value: 2,
                            text: 'Гомель',
                        }
                    ]
                }
            }
        },
        components: {
            Grid
        }
    }
</script>

