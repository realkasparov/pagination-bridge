<?php

namespace FDevs\Bridge\Pagination\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class FDevsPaginationExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $configs);
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $container->setParameter($this->getAlias().'.default_pagination_class', $config['pagination_class']);

        foreach ($config['type_list'] as $type) {
            $loader->load(sprintf('type/%s.xml', $type));
        }
        $loader->load('services.xml');
    }
}
