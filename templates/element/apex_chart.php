<?php
/**
 * @var \App\View\AppView|\AppAdmin\View\AppView|\Cake\View\View $this
 * @var \Toolkit\ApexCharts\ApexChart $apexChart
 * @var int|false $refreshTime
 * @var bool $lastItem
 */

$optionsVar = $apexChart->getId() . '_options';
$chartVar = $apexChart->getId();
$htmlId = $apexChart->getHtmlId();

?>
<div id="<?= $htmlId ?>" class="w-100">
</div>

<script type="text/javascript">
    window.addEventListener("load", function () {
        <?php if ($refreshTime !== false): ?>
        Toolkit.apexCharts.refreshTime = <?= $refreshTime * 1000 ?>;
        <?php endif; ?>
        let <?= $optionsVar ?> = <?= $apexChart->getOptionsJson() ?>;
        let <?= $chartVar ?> = new ApexCharts(document.querySelector("#<?= $htmlId ?>"), <?= $optionsVar ?>);
        Toolkit.apexCharts.appendChart('<?= $chartVar ?>', <?= $chartVar ?>, <?= $lastItem ? 'true' : 'false' ?>);
    }, false);
</script>
