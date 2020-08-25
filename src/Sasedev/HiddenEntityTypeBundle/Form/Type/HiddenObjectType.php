<?php
namespace Sasedev\HiddenEntityTypeBundle\Form\Type;

use Doctrine\Persistence\ManagerRegistry;
use Sasedev\HiddenEntityTypeBundle\Form\DataTransformer\ObjectToIdTransformer;
use Sasedev\HiddenEntityTypeBundle\Form\DataTransformer\ObjectsToIdTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 *
 * Sasedev\HiddenEntityTypeBundle\Form\Type$HiddenObjectType
 *
 *
 * @author sasedev <sinus@sasedev.net>
 *         Created on: 29 mai 2020 @ 20:40:03
 */
class HiddenObjectType extends AbstractType
{

    /** @var ManagerRegistry */
    protected $registry;

    public function __construct(ManagerRegistry $registry)
    {

        $this->registry = $registry;

    }

    /**
     *
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $transformerClassName = $options['multiple'] ? ObjectsToIdTransformer::class : ObjectToIdTransformer::class;

        $transformer = new $transformerClassName($this->registry, $options['class'], $options['property']);

        $builder->addModelTransformer($transformer);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {

        $resolver->setRequired([
            'class'
        ]);

        $resolver->setDefaults([
            'multiple' => false,
            'data_class' => null,
            'invalid_message' => 'The object does not exist.',
            'property' => 'id'
        ]);

        $resolver->setAllowedTypes('invalid_message', [
            'null',
            'string'
        ]);
        $resolver->setAllowedTypes('property', [
            'null',
            'string'
        ]);
        $resolver->setAllowedTypes('multiple', [
            'boolean'
        ]);

    }

    public function getParent(): string
    {

        return HiddenType::class;

    }

    public function getBlockPrefix(): string
    {

        return 'sasedev_hidden_object';

    }

}

