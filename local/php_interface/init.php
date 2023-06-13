<?php

\Bitrix\Main\Loader::includeModule('devsite');

AddEventHandler("iblock", "OnAfterIBlockElementAdd", ["Only\Site\Handlers\Iblock", "addLog"]);
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", ["Only\Site\Handlers\Iblock", "updateLog"]);
