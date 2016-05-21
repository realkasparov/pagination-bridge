<?php

namespace FDevs\Bridge\Pagination\DependencyInjection;

use FDevs\Cron\Cron;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class FDevsPaginationExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
//        $config = $this->processConfiguration(new Configuration(), $configs);
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $loader->load('services.xml');
    }
}
