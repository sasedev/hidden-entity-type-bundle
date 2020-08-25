<?php
namespace Sasedev\HiddenEntityTypeBundle;

use Sasedev\HiddenEntityTypeBundle\DependencyInjection\SasedevHiddenEntityTypeExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 *
 * Sasedev\HiddenEntityTypeBundle\SasedevHiddenEntityTypeBundle
 *
 *
 * @author sasedev <sinus@sasedev.net>
 *         Created on: 29 mai 2020 @ 20:21:44
 */
class SasedevHiddenEntityTypeBundle extends Bundle
{

    /**
     *
     * {@inheritdoc}
     * @see \Symfony\Component\HttpKernel\Bundle\Bundle::getContainerExtension()
     */
    public function getContainerExtension()
    {

        return new SasedevHiddenEntityTypeExtension();

    }

}

