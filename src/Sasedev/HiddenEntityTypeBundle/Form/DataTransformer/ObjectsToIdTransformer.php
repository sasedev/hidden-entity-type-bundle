<?php
namespace Sasedev\HiddenEntityTypeBundle\Form\DataTransformer;

use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Webmozart\Assert\Assert;

/**
 *
 * Sasedev\HiddenEntityTypeBundle\Form\DataTransformer\ObjectsToIdTransformer
 *
 *
 * @author sasedev <sinus@sasedev.net>
 *         Created on: 29 mai 2020 @ 20:37:10
 */
class ObjectsToIdTransformer extends Transformer
{

    /**
     *
     * @param object[]|array|mixed $entity
     *
     * @return string|int|float|null
     */
    public function transform($entity)
    {

        if ($entity === null) {
            return null;
        }

        Assert::isArray($entity);
        Assert::allIsInstanceOf($entity, $this->class);

        $accessor = PropertyAccess::createPropertyAccessor();
        $property = $this->getProperty();

        $value = [];

        foreach ($entity as $e) {
            if (! $accessor->isReadable($e, $property)) {
                continue;
            }

            $value[] = $accessor->getValue($e, $property);
        }

        return \implode(',', $value);

    }

    /**
     *
     * @param mixed $id
     *
     * @return array|object[]
     */
    public function reverseTransform($id): array
    {

        if ($id === null) {
            return [];
        }

        $repo = $this->getRepository();
        $property = $this->getProperty();
        $class = $this->getClass();

        $ids = \explode(',', $id);

        $results = $repo->findBy([
            $property => $ids
        ]);

        if (\count($results) === 0) {
            throw new TransformationFailedException(\sprintf('Can\'t find entity of class "%s" with property "%s" = "%s".', $class, $property, $id));
        }

        Assert::isArray($results);
        Assert::allIsInstanceOf($results, $this->class);

        return $results;

    }

}

