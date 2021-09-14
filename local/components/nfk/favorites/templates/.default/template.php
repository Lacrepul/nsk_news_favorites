<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

?>
<div class="wrapper-blog">
    <div class="cols-blog">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <div class="col-blog" ontouchstart="this.classList.toggle('hover');">
                <div class="container-blog" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <div class="front" style="background-image: url('<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>');">
                        <div class="inner">
                            <p><?= $arItem["NAME"]; ?></p>
                        </div>
                    </div>
                    <div class="back">
                        <div class="inner">
                            <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="inner_link-button"><?= Loc::getMessage("FAVORITES_TEMPLATE_LINK_BUTTON"); ?></a>
                            <form method="post">
                                <input name="delete" value="<?= $arItem["HLB_ID"] ?>" hidden/>
                                <button class="inner_delete-button"><?= Loc::getMessage("FAVORITES_TEMPLATE_DELETE_BUTTON"); ?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
    </div>
</div>
