<?php

namespace Only\Site\Handlers;

use Bitrix\Main\Loader;
Loader::includeModule('iblock');

class Iblock
{
    protected static $handlerDisallow = false;

    public static function addLog(&$arFields)
    {
        $elLogName = $arFields["ID"];
        $iBlock = \CIBlock::GetByID($arFields["IBLOCK_ID"]);
        $arRes = $iBlock->Fetch();
        $iBlockName = $arRes["NAME"];
        $iBlockCode = $arRes["CODE"];

        $sectionTreeObj = \CIBlockSection::GetNavChain(false, $arFields["IBLOCK_SECTION"]["0"]);
        while ($sectionTreeEl = $sectionTreeObj->Fetch()) {
            $sectionTree .= $sectionTreeEl["NAME"] . "-";
        }

        $sectionLogName = $iBlockName . "->" . $iBlockCode;
        $elName = $arFields["NAME"];
        $elPrevDesc = $iBlockName . "->" . "$sectionTree" . "->" . "$elName";

        if ($arFields["IBLOCK_ID"] != "4" && !(self::$handlerDisallow)) {
            self::$handlerDisallow = true;

            $sectionObj = \CIBlockSection::GetList([], ["IBLOCK_CODE" => "LOG"]);
            while ($loggerSections = $sectionObj->Fetch()) {
                $loggerSectionsArr[] = $loggerSections;
            }

            if(!$loggerSectionsArr) {
                $loggerSection = new \CIBlockSection;
                $arSectionProps = Array(
                    "IBLOCK_ID" => "4",
                    "NAME" => "$sectionLogName"
                );
                $loggerSection->Add($arSectionProps);

                $section = \CIBlockSection::GetList([], ["NAME" => "$sectionLogName"]);
                $arResSection = $section->Fetch();
                $IBLOCK_SECTION_ID = $arResSection["ID"];

                $el = new \CIBlockElement;
                $arLoadProductArray = Array(
                    "IBLOCK_ID"         => "4",
                    "IBLOCK_CODE"       => "LOG",
                    "NAME"              => "$elLogName",
                    "ACTIVE_FROM"       => date('d.m.Y H:i:s'),
                    "IBLOCK_SECTION_ID" => "$IBLOCK_SECTION_ID",
                    "PREVIEW_TEXT"      => "$elPrevDesc",
                );
                $el->Add($arLoadProductArray);
            } else {
                foreach ($loggerSectionsArr as $key => $value) {
                    $sectionArNames[] = $loggerSectionsArr["$key"]["NAME"];
                }

                if (in_array($sectionLogName, $sectionArNames)) {
                    $section = \CIBlockSection::GetList([], ["NAME" => "$sectionLogName"]);
                    $arResSection = $section->Fetch();
                    $IBLOCK_SECTION_ID = $arResSection["ID"];

                    $el = new \CIBlockElement;
                    $arLoadProductArray = Array(
                        "IBLOCK_ID"         => "4",
                        "IBLOCK_CODE"       => "LOG",
                        "NAME"              => "$elLogName",
                        "ACTIVE_FROM"       => date('d.m.Y H:i:s'),
                        "IBLOCK_SECTION_ID" => "$IBLOCK_SECTION_ID",
                        "PREVIEW_TEXT"      => "$elPrevDesc",
                    );
                    $el->Add($arLoadProductArray);
                } else {
                    $loggerSection = new \CIBlockSection;
                    $arSectionProps = Array(
                        "IBLOCK_ID" => "4",
                        "NAME" => "$sectionLogName"
                    );
                    $loggerSection->Add($arSectionProps);

                    $section = \CIBlockSection::GetList([], ["NAME" => "$sectionLogName"]);
                    $arResSection = $section->Fetch();
                    $IBLOCK_SECTION_ID = $arResSection["ID"];

                    $el = new \CIBlockElement;
                    $arLoadProductArray = Array(
                        "IBLOCK_ID"         => "4",
                        "IBLOCK_CODE"       => "LOG",
                        "NAME"              => "$elLogName",
                        "ACTIVE_FROM"       => date('d.m.Y H:i:s'),
                        "IBLOCK_SECTION_ID" => "$IBLOCK_SECTION_ID",
                        "PREVIEW_TEXT"      => "$elPrevDesc",
                    );
                    $el->Add($arLoadProductArray);
                }
            }
        }
        self::$handlerDisallow = false;
    }

    public static function updateLog(&$arFields)
    {
        $iBlock = \CIBlock::GetByID($arFields["IBLOCK_ID"]);
        $arRes = $iBlock->Fetch();
        $iBlockName = $arRes["NAME"];
        $iBlockCode = $arRes["CODE"];

        $sectionTreeObj = \CIBlockSection::GetNavChain(false, $arFields["IBLOCK_SECTION"]["0"]);
        while ($sectionTreeEl = $sectionTreeObj->Fetch()) {
            $sectionTree .= $sectionTreeEl["NAME"] . "-";
        }

        $sectionLogName = $iBlockName . "->" . $iBlockCode;
        $elName = $arFields["NAME"];
        $elPrevDesc = $iBlockName . "->" . "$sectionTree" . "->" . "$elName";
        $elLogName = $arFields["ID"];

        $record = \CIBlockElement::GetList([], ["IBLOCK_CODE" => "LOG", "NAME" => "$elLogName"]);
        $arResRecord = $record->Fetch();
        $recordID = $arResRecord["ID"];

        if ($arFields["IBLOCK_ID"] != "4" && !(self::$handlerDisallow)) {
            self::$handlerDisallow = true;

            $sectionObj = \CIBlockSection::GetList([], ["IBLOCK_CODE" => "LOG"]);
            while ($loggerSections = $sectionObj->Fetch()) {
                $loggerSectionsArr[] = $loggerSections;
            }

            if(!$loggerSectionsArr) {
                $loggerSection = new \CIBlockSection;
                $arSectionProps = Array(
                    "IBLOCK_ID" => "4",
                    "NAME" => "$sectionLogName"
                );
                $loggerSection->Add($arSectionProps);

                $section = \CIBlockSection::GetList([], ["NAME" => "$sectionLogName"]);
                $arResSection = $section->Fetch();
                $IBLOCK_SECTION_ID = $arResSection["ID"];

                $el = new \CIBlockElement;
                $arLoadProductArray = Array(
                    "ACTIVE_FROM"       => date('d.m.Y H:i:s'),
                    "IBLOCK_SECTION_ID" => "$IBLOCK_SECTION_ID",
                    "PREVIEW_TEXT"      => "$elPrevDesc",
                );
                $el->Update($recordID, $arLoadProductArray);
            } else {
                foreach ($loggerSectionsArr as $key => $value) {
                    $sectionArNames[] = $loggerSectionsArr["$key"]["NAME"];
                }

                if (in_array($sectionLogName, $sectionArNames)) {
                    $section = \CIBlockSection::GetList([], ["NAME" => "$sectionLogName"]);
                    $arResSection = $section->Fetch();
                    $IBLOCK_SECTION_ID = $arResSection["ID"];

                    $el = new \CIBlockElement;
                    $arLoadProductArray = Array(
                        "ACTIVE_FROM"       => date('d.m.Y H:i:s'),
                        "IBLOCK_SECTION_ID" => "$IBLOCK_SECTION_ID",
                        "PREVIEW_TEXT"      => "$elPrevDesc",
                    );
                    $el->Update($recordID, $arLoadProductArray);
                } else {
                    $loggerSection = new \CIBlockSection;
                    $arSectionProps = Array(
                        "IBLOCK_ID" => "4",
                        "NAME" => "$sectionLogName"
                    );
                    $loggerSection->Add($arSectionProps);

                    $section = \CIBlockSection::GetList([], ["NAME" => "$sectionLogName"]);
                    $arResSection = $section->Fetch();
                    $IBLOCK_SECTION_ID = $arResSection["ID"];

                    $el = new \CIBlockElement;
                    $arLoadProductArray = Array(
                        "ACTIVE_FROM"       => date('d.m.Y H:i:s'),
                        "IBLOCK_SECTION_ID" => "$IBLOCK_SECTION_ID",
                        "PREVIEW_TEXT"      => "$elPrevDesc",
                    );
                    $el->Update($recordID, $arLoadProductArray);
                }
            }
        }
        self::$handlerDisallow = false;
    }
}
