<?php

namespace Citrus\Events;

/**
 * Если в инфоблоке с блогамми, изменяется новость, то необходимо скинуть кэш
 * @package Citrus\Events
 */
class Hlb
{
    public function OnDeleteUpdateAdd(\Bitrix\Main\Entity\Event $event)
    {
        $GLOBALS['CACHE_MANAGER']->ClearByTag('favorites_custom_tag');
    }
}