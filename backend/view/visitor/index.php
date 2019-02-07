<?php
/** @var array $visits */
?>

<script>
    <?= 'const visits = ' . json_encode($visits, JSON_UNESCAPED_UNICODE)?>;
    <?= 'const clientCities = ' . json_encode($clientCities, JSON_UNESCAPED_UNICODE)?>;
</script>

<div id="app"></div>