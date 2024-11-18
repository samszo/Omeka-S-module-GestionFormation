<?php
namespace GestionFormation\Service\ViewHelper;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use GestionFormation\View\Helper\GestionFormationSql;

class GestionFormationSqlFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        $api = $services->get('Omeka\ApiManager');
        $conn = $services->get('Omeka\Connection');

        return new GestionFormationSql($api, $conn);
    }
}