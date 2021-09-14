<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

CBitrixComponent::includeComponentClass("nfk:favorites");
$favorites = new NfkFavorites;
//$favorites->addFavorite();
?>

<div class="blog-detail">
    <form action="/izbrannye-zapisi/" method="post">
        <input name="add" value="<?= $arResult["ID"] ?>" hidden/>
        <button class="blog_add-button"><?= Loc::getMessage("NEWS_DETAIL_ADD_BUTTON"); ?></button>
    </form>
    <? if (!empty($arResult["DETAIL_PICTURE"]["SRC"])): ?>
        <div class="blog-detail-img">
            <img src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" width="<?= $arResult["DETAIL_PICTURE"]["WIDTH"] ?>"
                 height="<?= $arResult["DETAIL_PICTURE"]["HEIGHT"] ?>" alt="<?= $arResult["NAME"] ?>"
                 title="<?= $arResult["NAME"] ?>" alt="img">
        </div>
    <? endif; ?>
    <div class="blog-info">
        <span><?= $arResult["DISPLAY_PROPERTIES"]["second_title"]["VALUE"] ?></span>
        <span class="blog-post-date"><?= $arResult["DISPLAY_ACTIVE_FROM"] ?></span>
    </div>
    <div class="blog-detail-text">
        <?= $arResult["DETAIL_TEXT"] ?>
    </div>
</div>
