<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var $arCurrentValues
 */

use Bitrix\Main\Localization\Loc;

$arSort = [
    'sort'           => Loc::getMessage('SORT_SORT'),
    'price'          => Loc::getMessage('SORT_PRICE'),
    'price_discount' => Loc::getMessage('SORT_PRICE_DISCOUNT'),
    'count_reviews'  => Loc::getMessage('SORT_COUNT_REVIEWS'),
    'rating'         => Loc::getMessage('SORT_RATING'),
];

$arAscDesc = [
    'asc'  => Loc::getMessage('SORT_ASC'),
    'desc' => Loc::getMessage('SORT_DESC'),
];


$arComponentParameters = [
    'GROUPS'     => [],
    'PARAMETERS' => [
        'SORT' => [
            'PARENT'   => 'BASE',
            'NAME'     => Loc::getMessage('SORT'),
            'TYPE'     => 'LIST',
            'VALUES'   => $arSort,
            'DEFAULT'  => 'sort',
            'MULTIPLE' => 'N',
            'REFRESH'  => 'N',
        ],
        'BY' => [
            'PARENT'   => 'BASE',
            'NAME'     => Loc::getMessage('BY'),
            'TYPE'     => 'LIST',
            'VALUES'   => $arAscDesc,
            'DEFAULT'  => 'sort',
            'MULTIPLE' => 'N',
            'REFRESH'  => 'N',
        ],
    ],
];
