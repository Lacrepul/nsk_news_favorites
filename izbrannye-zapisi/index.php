<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Избранные записи");
?><?$APPLICATION->IncludeComponent(
	"nfk:favorites", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_TYPE" => "news",
		"IBLOCK_ID" => "5",
		"SECTION_IDS" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>