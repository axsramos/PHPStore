<?php

namespace app\models;

use app\core\Database;
use PDO;


class CasIdy {
    private $attCasIdyCod;
    private $attCasIdyDca;
    private $attCasIdyDsc;
    private $attCasIdyBlq;
    private $attCasIdyChv;
    private $attCasIdyUpt;

    private $cnx;
    private $tbl = 'CasIdy';

    public function __construct(){
        $this->cnx = new Database();
    }

    public function setCasIdyCod($inCasIdyCod) { 
        $this->attCasIdyCod = $inCasIdyCod; 
    }
    private function setCasIdyDca($inCasIdyDca) { 
        $this->attCasIdyDca = $inCasIdyDca; 
    }
    private function setCasIdyDsc($inCasIdyDsc) { 
        $this->attCasIdyDsc = $inCasIdyDsc; 
    }
    private function setCasIdyBlq($inCasIdyBlq) { 
        $this->attCasIdyBlq = $inCasIdyBlq; 
    }
    public function setCasIdyChv($inCasIdyChv) { 
        $this->attCasIdyChv = $inCasIdyChv; 
    }
    private function setCasIdyUpt($inCasIdyUpt) { 
        $this->attCasIdyUpt = $inCasIdyUpt; 
    }

    public function getCasIdyCod() { 
        return $this->attCasIdyCod;
    }
    public function getCasIdyBlq() { 
        return $this->attCasIdyBlq;
    }
    public function getCasIdyChv() { 
        return $this->attCasIdyChv; 
    }

    public function validateIdentity() {
        $qry = "
        SELECT
            CasIdyCod,
            CasIdyBlq
        FROM
        " . $this->tbl . "
        WHERE
            CasIdyCod = :CasIdyCod
        ";

        $parameters = array(
            ":CasIdyCod" => $this->attCasIdyCod
        );

        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();
        
        if($rows) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->attCasIdyCod = $row['CasIdyCod'];
            $this->attCasIdyBlq = $row['CasIdyBlq'];
        }

        return $rows;
    }

    public function getIdentity() {
        $qry = "
        SELECT
            CasIdyCod,
            CasIdyChv,
            CasIdyBlq
        FROM
        " . $this->tbl . "
        WHERE
            CasIdyChv = :CasIdyChv
        ";

        $parameters = array(
            ":CasIdyChv" => $this->attCasIdyChv
        );

        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();
        
        if($rows) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->attCasIdyCod = $row['CasIdyCod'];
            $this->attCasIdyBlq = $row['CasIdyBlq'];
        }

        return $rows;
    }

    public function newToken() {
        $vCasIdyChv = uniqid();
        $this->setCasIdyChv($vCasIdyChv);

        $vCasIdyUpt = date("Y-m-d H:i:s");
        $this->setCasIdyUpt($vCasIdyUpt);

        $qry = "
        UPDATE
        " . $this->tbl . "
        SET
            CasIdyChv = :CasIdyChv,
            CasIdyUpt = :CasIdyUpt
        WHERE
            CasIdyCod = :CasIdyCod
        ";

        $parameters = array(
            ":CasIdyCod" => $this->attCasIdyCod,
            ":CasIdyChv" => $this->attCasIdyChv,
            ":CasIdyUpt" => $this->attCasIdyUpt
        );

        $stmt = $this->cnx->executeQuery($qry, $parameters);
        $rows = $stmt->rowCount();

        return $rows;
    }
}

