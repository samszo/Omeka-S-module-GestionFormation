<?php declare(strict_types=1);

namespace GestionFormation\View\Helper;

use Datetime;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use Laminas\Filter\RealPath;
use Laminas\Log\Logger;
use Laminas\View\Helper\AbstractHelper;
use Omeka\Api\Exception\RuntimeException;
use Omeka\Api\Manager as ApiManager;
use Omeka\Api\Representation\ItemRepresentation;
use Omeka\Api\Representation\MediaRepresentation;
use Omeka\Api\Representation\PropertyRepresentation;
use Omeka\Api\Representation\ResourceTemplateRepresentation;
use Omeka\Api\Representation\ResourceClassRepresentation;
use Omeka\File\TempFileFactory;
use Omeka\File\Store\StoreInterface;
use Omeka\Stdlib\Cli;

class GestionFormation extends AbstractHelper
{
    /**
     * @var ApiManager
     */
    protected $api;

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var Connection
     */
    protected $connection;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var Cli
     */
    protected $cli;

    /**
     * @var TempFileFactory
     */
    protected $tempFileFactory;

    /**
     * @var StoreInterface
     */
    protected $store;

    /**
     * @var string
     */
    protected $basePath;

    /**
     * @var array
     */
    protected $properties = [];

    /**
     * @var
     */
    protected $resourceClasses = [];

    /**
     * @var array
     */
    protected $resourceTemplates = [];

    public function __construct(
        ApiManager $api,
        EntityManager $entityManager,
        Connection $connection,
        Logger $logger,
        Cli $cli,
        TempFileFactory $tempFileFactory,
        StoreInterface $store,
        string $basePath
    ) {
        $this->api = $api;
        $this->entityManager = $entityManager;
        $this->connection = $connection;
        $this->logger = $logger;
        $this->cli = $cli;
        $this->tempFileFactory = $tempFileFactory;
        $this->store = $store;
        $this->basePath = $basePath;
    }


    public function __invoke(array $params = [])
    {
        $action = $params['action'] ?? null;
        switch ($action) {
            case 'getStatCompetences':
                $result = $this->getStatCompetences($params);
                break;
        }
        return $result;
    }

    /**
     * récupère les stats de compétence
     * 
     * @param array $params
     * 
     */
    protected function getStatCompetences($params){
        $rs=[];

        return $rs;
    }
        
    public function getProperty($term): PropertyRepresentation
    {
        if (!isset($this->properties[$term])) {
            $this->properties[$term] = $this->api->search('properties', ['term' => $term])->getContent()[0];
        }
        return $this->properties[$term];
    }

    public function getResourceClass($term): ResourceClassRepresentation
    {
        if (!isset($this->resourceClasses[$term])) {
            $this->resourceClasses[$term] = $this->api->search('resource_classes', ['term' => $term])->getContent()[0];
        }
        return $this->resourceClasses[$term];
    }

    public function getResourceTemplate($label): ResourceTemplateRepresentation
    {
        if (!isset($this->resourceTemplates[$label])) {
            $this->resourceTemplates[$label] = $this->api->read('resource_templates', ['label' => $label])->getContent();
        }
        return $this->resourceTemplates[$label];
    }
}
