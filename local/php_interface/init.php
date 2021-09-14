<?php

// Composer
require_once (__DIR__ . '/../vendor/autoload.php');

$eventManager = \Bitrix\Main\EventManager::getInstance();
$eventManager->addEventHandler(
    "",
    "FavoritesOnAfterDelete",
    array("\\Citrus\\Events\\Hlb", "OnDeleteUpdateAdd")
);
$eventManager->addEventHandler(
    "",
    "FavoritesOnAfterAdd",
    array("\\Citrus\\Events\\Hlb", "OnDeleteUpdateAdd")
);
$eventManager->addEventHandler(
    "",
    "FavoritesOnAfterUpdate",
    array("\\Citrus\\Events\\Hlb", "OnDeleteUpdateAdd")
);

/*
todo: Агент, который удаляет "неактуальные записи" в хайлоад блоке, т.е. если такой новости уже нет, то и в хайлоад блоке ее хранить незачем.
*/