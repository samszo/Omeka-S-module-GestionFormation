<?php
namespace GestionFormation\View\Helper;

use Laminas\View\Helper\AbstractHelper;

class GestionFormationSql extends AbstractHelper
{
    protected $api;
    protected $conn;

    public function __construct($api, $conn)
    {
      $this->api = $api;
      $this->conn = $conn;
    }

    /**
     * Execution de requêtes sql directement dans la base sql
     *
     * @param array     $params paramètre de l'action
     * @return array
     */
    public function __invoke($params=[])
    {
        if($params==[])return[];
        switch ($params['action']) {
            case 'statCompetences':
                $result = $this->statCompetences($params);
                break;                                                        
            }            

        return $result;

    }


    /**
     * récupère les stats sur les compétences
     *
     * @param array    $params paramètre de la requête
     * @return array
     */
    function statCompetences($params){
        $query='SELECT 
            tn.idFrag
        FROM
            transcriptions t
                INNER JOIN
            transcriptions tn ON tn.idDisque = t.idDisque
                AND tn.start = t.end
        WHERE
            t.idFrag = ?';
        $rs = $this->conn->fetchAll($query,[$params['idFrag']]);            
        return $rs;        
    }     

}
