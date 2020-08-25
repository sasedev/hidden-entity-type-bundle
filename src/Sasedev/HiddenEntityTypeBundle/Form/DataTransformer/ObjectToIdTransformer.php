<?php
namespace Sasedev\HiddenEntityTypeBundle\Form\DataTransformer;

use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Webmozart\Assert\Assert;

/**
 *
 * Sasedev\HiddenEntityTypeBundle\Form\DataTransformer\ObjectToIdTransformer
 *
 *
 * @author sasedev <sinus@sasedev.net>
 *         Created on: 29 mai 2020 @ 20:35:30
 */
class ObjectToIdTransformer extends Transformer
{

    /**
     *
     * @param mixed $entity
     *
     * @return string|int|float|null
     */
    public function transform($entity)
    {

        if ($entity === null) {
            return null;
        }

        Assert::object($entity);
        Assert::isInstanceOf($entity, $this->class);

        $accessor = PropertyAccess::createPropertyAccessor();
        $property = $this->getProperty();

        if (! $accessor->isReadable($entity, $property)) {
            return null;
        }

        return $accessor->getValue($entity, $property);

    }

    /**
     *
     * @param mixed $id
     */
    public function reverseTransform($id): ?object
    {

        if ($id === null) {
            return null;
        }

        $repo = $this->getRepository();
        $property = $this->getProperty();
        $class = $this->getClass();

        $result = $repo->findOneBy([
            $property => $id
        ]);

        if ($result === null) {
            throw new TransformationFailedException(\sprintf('Can\'t find entity of class "%s" with property "%s" = "%s".', $class, $property, $id));
        }

        Assert::object($result);
        Assert::isInstanceOf($result, $this->class);

        return $result;

    }

}

