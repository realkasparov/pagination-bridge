<?php

namespace FDevs\Bridge\Pagination\DependencyInjection;

use FDevs\Pagination\Model\Pagination;
use FDevs\Pagination\Model\PaginationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('f_devs_pagination');
        $allowedTypes = ['array', 'doctrine_mongodb', 'doctrine_orm'];
        $rootNode
            ->children()
                ->scalarNode('pagination_class')
                    ->info(sprintf('set default pagination class MUST implement "%s".', PaginationInterface::class))
                    ->defaultValue(Pagination::class)
                ->end()
                ->arrayNode('type_list')
                    ->info(sprintf('Select the types, allowed "%s".', implode(',', $allowedTypes)))
                    ->prototype('scalar')
                        ->validate()
                        ->ifNotInArray($allowedTypes)
                            ->thenInvalid('Invalid type %s')
                        ->end()
                    ->end()
                    ->defaultValue($allowedTypes)
                ->end()
            ->end();

        return $treeBuilder;
    }
}
