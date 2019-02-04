<?php
/** @var array $visits */
?>

<div id="app"></div>
<br><br>
<div class="ui container">
<table id="client-visits" class="ui table celled">
    <thead>
    <tr>
        <th>Имя</th>
        <th>Город</th>
        <th>Район</th>
        <th>Кол-во посещений</th>
        <th>Дата последнего посещения</th>
        <th>Город последнего посещения</th>
        <th>Район последнего посещения</th>

    </tr>
    </thead>
    <tbody>
    <?php foreach ($visits as $row) : ?>
        <tr>
            <td class="client-name"><?= $row['clientName'] ?></td>
            <td class="city"><?= $row['clientCity'] ?></td>
            <td class="district"><?= $row['clientDistrict'] ?></td>
            <td class="number-of-visits"><?= $row['numberOfVisits'] ?></td>
            <td class="date"><?= $row['lastVisitDate'] ?></td>
            <td class="city"><?= $row['lastVisitedCity'] ?></td>
            <td class="district"><?= $row['lastVisitedDistrict'] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
