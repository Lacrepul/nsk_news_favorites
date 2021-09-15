<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="wrapper-blog">
    <div class="cols-blog">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <div class="col-blog">
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('NEWS_DELETE_CONFIRM')));
                ?>
                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="container-blog" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <div class="front" style="background-image: url('<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>');">
                        <div class="inner">
                            <p><?= $arItem["NAME"]; ?></p>
                            <span><?= $arItem["DISPLAY_PROPERTIES"]["second_title"]["VALUE"] ?></span>
                        </div>
                    </div>
                    <div class="back">
                        <div class="inner">
                            <?= $arItem["PREVIEW_TEXT"] ?>
                        </div>
                    </div>
                </a>
            </div>
        <? endforeach; ?>
    </div>
</div>
