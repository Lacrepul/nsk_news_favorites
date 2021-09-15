<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;?>
<div class="blog-detail">
    <? if (!empty($arResult["DETAIL_PICTURE"]["SRC"])): ?>
        <div class="blog-detail-img">
            <img src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" width="<?= $arResult["DETAIL_PICTURE"]["WIDTH"] ?>"
                 height="<?= $arResult["DETAIL_PICTURE"]["HEIGHT"] ?>" alt="<?= $arResult["NAME"] ?>"
                 title="<?= $arResult["NAME"] ?>">
        </div>
    <? endif; ?>
    <div class="blog-info">
        <span><?= $arResult["DISPLAY_PROPERTIES"]["second_title"]["VALUE"] ?></span>
        <span class="blog-post-date"><?= $arResult["DISPLAY_ACTIVE_FROM"] ?></span>
    </div>
    <div class="blog-detail-text">
        <?= $arResult["DETAIL_TEXT"] ?>
    </div>
    <? if($GLOBALS["USER"]->isAuthorized()):?>
    <a data-element-id="<?= $arResult["ID"] ?>" class="blog_add-button"><?= Loc::getMessage("NEWS_DETAIL_ADD_BUTTON"); ?></a>
    <?endif;?>
</div>
<script>
    BX.ready(function () {
        var ajaxAddObj = new ajaxAdd(<?= json_encode([
                "HLB_ID" => $arParams["HIGHLOAD_IBLOCK_ID"],
                "LANG_INSIDE_FAVORITES" => Loc::getMessage("NEWS_DETAIL_ADDED_BUTTON"),
                "LINK" => $arParams["LINK_TO_FAVORITES"]
        ]) ?>);
    });
</script>