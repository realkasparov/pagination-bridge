<?php

namespace FDevs\Bridge\Pagination;

use FDevs\Bridge\Pagination\DependencyInjection\Compiler\ExtensionPass;
use FDevs\Bridge\Pagination\DependencyInjection\Compiler\TypePass;
use FDevs\Bridge\Pagination\DependencyInjection\FDevsPaginationExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class FDevsPaginationBundle extends Bundle
{
    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        $container
            ->addCompilerPass(new TypePass())
            ->addCompilerPass(new ExtensionPass())
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function createContainerExtension()
    {
        return new FDevsPaginationExtension();
    }
}
