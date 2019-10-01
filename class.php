<?php

namespace Svarok\Component;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Application;
use Bitrix\Main\Web\Cookie;
use Bitrix\Main\Web\Uri;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

class CatalogSort extends \CBitrixComponent
{
    protected $allowSortFields = [
        'sort' => [
            'NAME' => 'популярности',
            'URL'  => '',
            'BY'   => 'desc',
        ],
        'price_discount' => [
            'NAME' => 'цене',
            'URL'  => '',
            'BY'   => 'asc',
        ],
        /*'count_reviews' => [
            'NAME' => 'отзывам',
            'URL'  => '',
            'BY'   => 'desc',
        ],
        'rating' => [
            'NAME' => 'рейтингу отзывов',
            'URL'  => '',
            'BY'   => 'desc',
        ],*/
    ];

    public function __construct($component = null)
    {
        parent::__construct($component);
    }

    /**
     * Load language file.
     */
    public function onIncludeComponentLang()
    {
        $this->includeComponentLang(basename(__FILE__));

        Loc::loadMessages(__FILE__);
    }

    /**
     * Prepare component params
     *
     * @param array $arParams
     * @return array $arParams
     */
    public function onPrepareComponentParams($arParams)
    {
        $arParams['SORT'] = trim($arParams['SORT']) ?: 'quantity';

        $arParams['BY'] = trim($arParams['BY']) ?: 'desc';

        return $arParams;
    }

    protected function prepareSort()
    {
        $sort = htmlspecialchars($this->request->getCookie('itemSort'));
        $by = htmlspecialchars($this->request->getCookie('itemSortBy'));

        $this->arResult['itemSort'] = ($sort ?: $this->arParams['SORT']);
        $this->arResult['itemSortBy'] = $by;

        $server = Application::getInstance()->getContext()->getServer();

        if (isset($this->request['sort'])) {
            $cookie = new Cookie('itemSort', $this->request['sort'], time() + 60*30);
            $cookie->setDomain($server->getServerName());
            Application::getInstance()->getContext()->getResponse()->addCookie($cookie);

            $this->arResult['itemSort'] = $this->request['sort'];
        }

        if (isset($this->request['by'])) {
            $cookie = new Cookie('itemSortBy', $this->request['by'], time() + 60*30);
            $cookie->setDomain($server->getServerName());
            Application::getInstance()->getContext()->getResponse()->addCookie($cookie);

            $this->arResult['itemSortBy'] = $this->request['by'];
        }
    }

    public function executeComponent()
    {
        $this->prepareSort();

        foreach ($this->allowSortFields as $field => $item) {

            $uri = new Uri($this->request->getRequestUri());
            $uri->deleteParams(['ajax']);

            if ($field == $this->arResult['itemSort']) {
                $by = ($item['BY'] == 'asc' ? 'desc' : 'asc');

                if (
                    isset($this->arResult['itemSortBy'])
                    && in_array($this->arResult['itemSortBy'], ['asc', 'desc'])
                ) {
                    $by = ($this->arResult['itemSortBy'] == 'asc' ? 'desc' : 'asc');
                }

                $uri->addParams([
                    'sort' => $field,
                    'by'   => $by,
                ]);

            } else {
                $uri->addParams([
                    'sort' => $field,
                    'by'   => $item['BY'],
                ]);
            }

            $this->arResult['SORT_FIELDS'][$field] = [
                'NAME' => $item['NAME'],
                'URL'  => $uri->getUri(),
                'BY'   => ($this->arResult['itemSortBy'] ?: $item['BY']),
            ];
        }

        $this->includeComponentTemplate();
    }
}
