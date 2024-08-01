<?php

use app\models\CasIdy;

$identity = '';

$csCasIdy = new CasIdy();
$csCasIdy->setCasIdyChv($token);

if($csCasIdy->getIdentity()) {
    if($csCasIdy->getCasIdyBlq() == 'N') {
        $identity = $csCasIdy->getCasIdyCod();
    }
}

$GLOBALS['identity'] = $identity;
