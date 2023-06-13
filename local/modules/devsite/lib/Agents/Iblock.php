<?php

namespace Only\Site\Agents;

use Bitrix\Main\Loader;
Loader::includeModule('iblock');

class Iblock
{
    public static function clearOldLogs()
    {
        $elEdgeObj = \CIBlockElement::GetList(
            ['TIMESTAMP_X' => 'DESC'],
            ['IBLOCK_CODE' => "LOG"],
            false,
            ['nTopCount' => 10],
            ["ID"]);
        while ($arEdge = $elEdgeObj->Fetch()) {
            $arRes[] = $arEdge;
        }
        $edgeDate = $arRes[array_key_last($arRes)]["TIMESTAMP_X"];

        $elLogsObj = \CIBlockElement::GetList(
            ['TIMESTAMP_X' => 'DESC'],
            ['IBLOCK_CODE' => "LOG", '<TIMESTAMP_X' => $edgeDate],
            false,
            false,
            ["ID"]);
        while ($arLog = $elLogsObj->Fetch()) {
            \CIBlockElement::Delete($arLog['ID']);
        }
        return '\\' . __CLASS__ . '::' . __FUNCTION__ . '();';
    }
}
