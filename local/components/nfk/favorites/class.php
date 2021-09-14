<?php

use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;
use \Bitrix\Highloadblock as HL;
use \Bitrix\Main\Entity;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class NfkFavorites extends CBitrixComponent
{
    private $_request;
    private $highloadIblock;
    private $hlbItems;

    /**
     * Проверка наличия модулей требуемых для работы компонента
     * @return bool
     * @throws Exception
     */
    private function _checkModules()
    {
        if (!Loader::includeModule('iblock')
            || !Loader::includeModule("highloadblock")
        ) {
            throw new \Exception('Не загружены модули необходимые для работы модуля');
        }

        return true;
    }

    /**
     * Обертка над глобальной переменной
     * @return CAllMain|CMain
     */
    private function _app()
    {
        global $APPLICATION;
        return $APPLICATION;
    }

    /**
     * Обертка над глобальной переменной
     * @return CAllUser|CUser
     */
    private function _user()
    {
        global $USER;
        return $USER;
    }

    /**
     * Обертка над глобальной переменной
     * @return CACHE_MANAGER|CCacheManager
     */
    private function _cache_manager()
    {
        global $CACHE_MANAGER;
        return $CACHE_MANAGER;
    }

    /**
     * Подготовка параметров компонента
     * @param $arParams
     * @return mixed
     */
    public function onPrepareComponentParams($params)
    {
        if ($params['CACHE_TYPE'] == 'Y' || ($params['CACHE_TYPE'] == 'A' && Bitrix\Main\Config\Option::get('main', 'component_cache_on', 'Y') == 'Y')) {
            $params['CACHE_TIME'] = intval($params['CACHE_TIME']);
        } else {
            $params['CACHE_TIME'] = 0;
        }
        if ($params["IBLOCK_TYPE"] == '')
            $arParams["IBLOCK_TYPE"] = "blog";
        if (empty($params["HIGHLOAD_IBLOCK_ID"])) {
            throw new \Exception('Не заполнен идентификатор хайлоад блока');
        } else {
            $params["HIGHLOAD_IBLOCK_ID"] = intval($params["HIGHLOAD_IBLOCK_ID"]);
        }

        $arParams["IBLOCK_ID"] = trim($arParams["IBLOCK_ID"]);

        return $params;
    }

    /**
     * Получаем хайлоадблок
     * @throws Exception
     */
    public function getHighloadIblock()
    {
        try {
            $hlblock = HL\HighloadBlockTable::getById($this->arParams["HIGHLOAD_IBLOCK_ID"])->fetch();
            $entity = HL\HighloadBlockTable::compileEntity($hlblock);
            $entityData = $entity->getDataClass();
            $this->highloadIblock = $entityData;
        } catch (Exception $e) {
            throw new \Exception("Данного HLB не существует");
        }
    }

    /**
     * Получаем данные из хайлоад блока
     */
    public function getUserFavorites()
    {
        $currentUser = $this->_user()->GetID();
        $rsData = $this->highloadIblock::getList(array(
            "select" => array("*"),
            "order" => array("ID" => "ASC"),
            "filter" => array("UF_USER_ID" => $currentUser)
        ));

        $this->hlbItems = $rsData->fetchAll();
    }

    /**
     * Получаем данные из инфоблока
     */
    public function getIblockData()
    {
        $elementIds = array_reduce($this->hlbItems, function ($acc, $item) {
            $acc[$item["ID"]] = $item["UF_BLOG_ELEMENT_ID"];
            $this->arResult["ITEMS"][$item["UF_BLOG_ELEMENT_ID"]]["HLB_ID"] = $item["ID"];
            return $acc;
        });
        $dbItems = \Bitrix\Iblock\Elements\ElementBlogTable::getList([
            'select' => ['ID', 'NAME', 'IBLOCK_ID', 'PREVIEW_PICTURE', 'PREVIEW_TEXT', 'CODE', 'SECONDS_TITLE_' => 'second_title', 'DETAIL_PAGE_URL' => 'IBLOCK.DETAIL_PAGE_URL'],
            'filter' => [
                'ID' => $elementIds,
                "ACTIVE" => "Y"
            ],
        ]);
        while ($element = $dbItems->fetch()) {
            $this->arResult["ITEMS"][$element["ID"]]["ID"] = $element["ID"];
            $this->arResult["ITEMS"][$element["ID"]]["NAME"] = $element["NAME"];
            $this->arResult["ITEMS"][$element["ID"]]["PREVIEW_PICTURE"] = CFile::GetFileArray($element['PREVIEW_PICTURE']);
            $this->arResult["ITEMS"][$element["ID"]]["PROPERTY_SECOND_TITLE"] = $element["SECONDS_TITLE_VALUE"];
            $this->arResult["ITEMS"][$element["ID"]]["PREVIEW_TEXT"] = $element["PREVIEW_TEXT"];
            $this->arResult["ITEMS"][$element["ID"]]["DETAIL_PAGE_URL"] = CIBlock::ReplaceDetailUrl($element['DETAIL_PAGE_URL'], $element, false, 'E');
        }
        foreach ($this->arResult["ITEMS"] as $key => $item) {
            if (!isset($item["ID"])) {
                unset($this->arResult["ITEMS"][$key]);
            }
        }
    }

    /**
     * @param $id
     * Удаляем данные из хайлоад блока
     */
    public function deleteFavorite($id)
    {
        $this->highloadIblock::Delete($id);
    }

    /**
     * @param $idElement
     * @throws Exception
     * Добавляем данные в хайлоад блок
     */
    public function addFavorite($elementId)
    {
        if ($this->isHlbElementExist($elementId)) {
            $data = array(
                "UF_USER_ID" => $this->_user()->GetID(),
                "UF_BLOG_ELEMENT_ID" => $elementId
            );
            $this->highloadIblock::add($data);
        }
    }

    public function isHlbElementExist($elementId)
    {
        $currentUser = $this->_user()->GetID();
        $rsData = $this->highloadIblock::getList([
            "select" => ["*"],
            "order" => ["ID" => "ASC"],
            "filter" => [
                "UF_USER_ID" => $currentUser,
                "UF_BLOG_ELEMENT_ID" => $elementId
            ]
        ])->fetch();

        return is_array($rsData) ? false : true;
    }

    public function executeComponent()
    {
        $this->_checkModules();
        $this->_request = Application::getInstance()->getContext()->getRequest();
        if ($this->StartResultCache($this->arParams["CACHE_TIME"], [$this->_request->getPost("delete"), $this->_request->getPost("add")])) {
            $this->getHighloadIblock();
            if (null !== $this->_request->getPost("delete")) {
                $this->deleteFavorite($this->_request->getPost("delete"));
                header("Location: {$this->_app()->GetCurPage()}");
            }
            if (null !== $this->_request->getPost("add")) {
                $this->addFavorite($this->_request->getPost("add"));
                header("Location: {$this->_app()->GetCurPage()}");
            }
            $this->_cache_manager()->RegisterTag("iblock_id_" . $this->arParams["IBLOCK_ID"]);
            $this->_cache_manager()->RegisterTag("favorites_custom_tag");
            $this->getUserFavorites();
            $this->getIblockData();
            $this->_cache_manager()->EndTagCache();
            $this->includeComponentTemplate();
        } else {
            $this->AbortResultCache();
        }
    }
}