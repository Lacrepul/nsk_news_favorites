<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"DISPLAY_DATE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_DATE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_NAME" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_NAME"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_PICTURE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_PICTURE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_PREVIEW_TEXT" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_TEXT"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"HIGHLOAD_IBLOCK_ID" => [
		"PARENT" => "SETTINGS",
		"NAME" => Loc::getMessage('T_IBLOCK_DESC_PROP_HIGHLOAD_IBLOCK_ID'),
		"TYPE" => "STRING",
	],
	"LINK_TO_FAVORITES" => [
		"PARENT" => "SETTINGS",
		"NAME" => Loc::getMessage('T_IBLOCK_DESC_LINK_TO_FAVORITES'),
		"TYPE" => "STRING",
	],
);
?>
