<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Localization\Loc;

$arComponentDescription = [
    "NAME" => Loc::getMessage("NFK_COMPONENT"),
    "DESCRIPTION" => Loc::getMessage("NFK_COMPONENT_DESCRIPTION"),
    "COMPLEX" => "N",
    "PATH" => [
        "ID" => Loc::getMessage("NFK_COMPONENT_PATH_ID"),
        "NAME" => Loc::getMessage("NFK_COMPONENT_PATH_NAME"),
        "CHILD" => [
            "ID" => Loc::getMessage("NFK_COMPONENT_CHILD_PATH_ID"),
            "NAME" => GetMessage("NFK_BRANCH_NAME")
        ]
    ],
];
?>