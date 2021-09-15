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
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "360000",
		"HIGHLOAD_IBLOCK_ID" => "2"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>