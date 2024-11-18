<?php declare(strict_types=1);

namespace GestionFormation\Service\ViewHelper;

use GestionFormation\View\Helper\GestionFormation;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

/**
 */
class GestionFormationFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        return new GestionFormation(
            $services->get('Omeka\ApiManager'),
            $services->get('Omeka\EntityManager'),
            $services->get('Omeka\Connection'),
            $services->get('Omeka\Logger'),
            $services->get('Omeka\Cli'),
            $services->get('Omeka\File\TempFileFactory'),
            $services->get('Omeka\File\Store'),
            $services->get('Config')['file_store']['local']['base_path'] ?: (OMEKA_PATH . '/files')
        );
    }
}
