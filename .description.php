<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentDescription = [
    'NAME'        => Loc::getMessage('CATALOG_SORT_NAME'),
    'DESCRIPTION' => Loc::getMessage('CATALOG_SORT_DESCRIPTION'),
    'ICON'        => '/images/icon.gif',
    'SORT'        => 25,
    'CACHE_PATH'  => 'Y',
    'PATH'        => [
        'ID'    => 'sv_component',
        'NAME'  => Loc::getMessage('COMPONENT_PATH_NAME'),
        'CHILD' => [
            'ID'    => 'sv_catalog',
            'NAME'  => Loc::getMessage('COMPONENT_PATH_CHILD_NAME'),
            'SORT'  => 30
        ],
    ],
    'COMPLEX'     => 'N',
];
