<?php
use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class NfkFavorites extends CBitrixComponent {
    private $_request;
    /**
     * Проверка наличия модулей требуемых для работы компонента
     * @return bool
     * @throws Exception
     */
    private function _checkModules() {
        if (   !Loader::includeModule('iblock')
            || !Loader::includeModule('sale')
        ) {
            throw new \Exception('Не загружены модули необходимые для работы модуля');
        }

        return true;
    }

    /**
     * Обертка над глобальной переменной
     * @return CAllMain|CMain
     */
    private function _app() {
        global $APPLICATION;
        return $APPLICATION;
    }

    /**
     * Обертка над глобальной переменной
     * @return CAllUser|CUser
     */
    private function _user() {
        global $USER;
        return $USER;
    }

    /**
     * Подготовка параметров компонента
     * @param $arParams
     * @return mixed
     */
    public function onPrepareComponentParams($arParams) {
        return $arParams;
    }

    public function executeComponent() {
        $this->_checkModules();

        $this->_request = Application::getInstance()->getContext()->getRequest();

        $this->includeComponentTemplate();
    }
}