<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
?>

<?php if (!empty($arResult['SORT_FIELDS'])) { ?>
    <div class="products-sort">
        <div class="products-sort__title">Сортировать по:</div>
        <div class="products-sort__main">
            <?php foreach ($arResult['SORT_FIELDS'] as $field => $item) { ?>
                <?php
                $cssClass = '';
                if ($field == $arResult['itemSort']) {
                    $cssClass = ($item['BY'] == 'asc' ? ' products-sort__link--top' : ' products-sort__link--bottom');
                }
                ?>
                <div class="products-sort__main-item">
                    <a href="<?php echo $item['URL']; ?>"
                       class="products-sort__link js-sort-item<?php echo $cssClass; ?>">
                        <?php echo $item['NAME']; ?>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>

