<?php

namespace FDevs\Bridge\Pagination\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class TypePass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->hasDefinition('f_devs_pagination.paginator')) {
            $definition = $container->getDefinition('f_devs_pagination.paginator');
            $taggedServices = $container->findTaggedServiceIds('f_devs_pagination.type');
            foreach ($taggedServices as $id => $tags) {
                $definition->addMethodCall('addType', [new Reference($id)]);
            }
        }
    }
}
