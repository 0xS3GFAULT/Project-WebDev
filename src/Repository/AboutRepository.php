<?php

namespace App\Repository;

use App\Model\About;
use Config\RepositoryBase;
use PDO;
use PDOException;

class AboutRepository extends RepositoryBase
{
    public function getInfos(): About|bool {
        $sql = "SELECT * FROM about";
        return $this->getBDD()->query($sql)->fetchObject(About::class);
    }

    public function setGeneralTerms(About $about) : bool {
        $sql = "UPDATE about SET general_terms = ?";
        try {
            $query = $this->getBDD()->prepare($sql);
            $query->execute([$about->getGeneralTerms()]);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return true;
    }

}