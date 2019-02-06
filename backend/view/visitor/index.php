<?php
/** @var array $visits */
?>

<script>
    <?= 'const visits = ' . json_encode($visits, JSON_UNESCAPED_UNICODE)?>
</script>

<script type="text/x-template" id="grid">
    <div class="ui container">

        <div id="filter"></div>

        <table class="ui table celled">
            <thead>
            <tr>
                <th v-for="column in columns">{{column}}</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="row in data">
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
</script>

<div id="app">
    <grid :columns="columns" :data="visits"></grid>
</div>