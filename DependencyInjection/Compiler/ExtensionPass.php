<?php

namespace FDevs\Bridge\Pagination\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ExtensionPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->hasDefinition('f_devs_pagination.paginator')) {
            $definition = $container->getDefinition('f_devs_pagination.paginator');
            $taggedServices = $container->findTaggedServiceIds('f_devs_pagination.extension');
            foreach ($taggedServices as $id => $tags) {
                foreach ($tags as $tag) {
                    $type = trim($tag['type'], '%');
                    $definition->addMethodCall('addTypeExtension', [
                        $container->hasParameter($type) ? $container->getParameter($type) : $type,
                        new Reference($id),
                        isset($tag['priority']) ? $tag['priority'] : 0,
                    ]);

                }
            }
        }
    }
}
