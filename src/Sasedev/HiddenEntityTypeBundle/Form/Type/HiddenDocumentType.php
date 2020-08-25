<?php
namespace Sasedev\HiddenEntityTypeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 *
 * Sasedev\HiddenEntityTypeBundle\Form\Type\HiddenDocumentType
 *
 *
 * @author sasedev <sinus@sasedev.net>
 *         Created on: 29 mai 2020 @ 20:43:29
 */
class HiddenDocumentType extends AbstractType
{

    /**
     *
     * {@inheritdoc}
     * @see \Symfony\Component\Form\AbstractType::configureOptions()
     */
    public function configureOptions(OptionsResolver $resolver): void
    {

        $resolver->setDefaults([
            'invalid_message' => 'The document does not exist.'
        ]);

    }

    /**
     *
     * {@inheritdoc}
     * @see \Symfony\Component\Form\AbstractType::getParent()
     */
    public function getParent(): string
    {

        return HiddenObjectType::class;

    }

    /**
     *
     * {@inheritdoc}
     * @see \Symfony\Component\Form\AbstractType::getBlockPrefix()
     */
    public function getBlockPrefix(): string
    {

        return 'sasedev_hidden_document';

    }

}