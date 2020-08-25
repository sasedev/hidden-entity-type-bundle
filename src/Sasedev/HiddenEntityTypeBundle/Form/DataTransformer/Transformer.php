<?php
namespace Sasedev\HiddenEntityTypeBundle\Form\DataTransformer;

use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\PropertyAccess\Exception\NoSuchPropertyException;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Webmozart\Assert\Assert;

/**
 *
 * Sasedev\HiddenEntityTypeBundle\Form\DataTransformer\Transformer
 *
 *
 * @author sasedev <sinus@sasedev.net>
 *         Created on: 29 mai 2020 @ 20:32:34
 */
abstract class Transformer implements DataTransformerInterface
{

    /**
     *
     * @var ManagerRegistry
     */
    protected $registry;

    /**
     *
     * @var string
     */
    protected $class;

    /**
     *
     * @var string
     */
    protected $property;

    /**
     *
     * @param ManagerRegistry $registry
     * @param string $class
     * @param string $property
     */
    public function __construct(ManagerRegistry $registry, string $class, string $property = 'id')
    {

        Assert::classExists($class);

        $this->registry = $registry;
        $this->class = $class;
        $this->property = $property;

        $this->validate();

    }

    /**
     *
     * @return ObjectRepository
     */
    protected function getRepository(): ObjectRepository
    {

        return $this->registry->getRepository($this->getClass());

    }

    /**
     *
     * @return string
     */
    protected function getClass(): string
    {

        return $this->class;

    }

    /**
     *
     * @return string
     */
    protected function getProperty(): string
    {

        return $this->property;

    }

    /**
     *
     * @throws NoSuchPropertyException
     */
    protected function validate(): void
    {

        $reflectionExtractor = new ReflectionExtractor();
        $propertyInfo = new PropertyInfoExtractor([
            $reflectionExtractor
        ]);

        $properties = $propertyInfo->getProperties($this->class) ?? [];

        if (! \in_array($this->property, $properties, true))
        {
            throw new NoSuchPropertyException(\sprintf('property %s is missing in class %s', $this->property, $this->class));
        }

    }

}

