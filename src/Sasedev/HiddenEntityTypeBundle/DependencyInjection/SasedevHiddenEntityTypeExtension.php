<?php
namespace Sasedev\HiddenEntityTypeBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 *
 * Sasedev\HiddenEntityTypeBundle\DependencyInjection\SasedevHiddenEntityTypeExtension
 *
 *
 * @author sasedev <sinus@sasedev.net>
 *         Created on: 29 mai 2020 @ 20:23:48
 */
class SasedevHiddenEntityTypeExtension extends Extension
{

    /**
     *
     * @inheritdoc
     */
    public function load(array $configs, ContainerBuilder $container): void
    {

        $locator = new FileLocator(__DIR__ . '/../Resources/config');
        $loader = new Loader\YamlFileLoader($container, $locator);
        $loader->load('form.yaml');

    }

}

