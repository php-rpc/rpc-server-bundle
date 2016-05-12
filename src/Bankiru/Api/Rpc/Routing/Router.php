<?php
/**
 * Created by PhpStorm.
 * User: batanov.pavel
 * Date: 16.02.2016
 * Time: 10:25
 */

namespace Bankiru\Api\Rpc\Routing;

class Router
{
    /** @var  MethodCollection */
    private $collection;

    /**
     * Router constructor.
     *
     * @param LoaderResolverInterface $resolver
     * @param array $resources
     * @param MethodCollection|null $collection
     */
    public function __construct(
        LoaderResolverInterface $resolver,
        array $resources = [],
        MethodCollection $collection = null)
    {
        $this->collection = $collection;

        if (null === $this->collection) {
            $this->collection = new MethodCollection();
        }

        foreach ($resources as $resource) {
            $this->collection->addCollection($resolver->resolve($resource)->load($resource));
        }
    }

    /**
     * @return MethodCollection
     */
    public function getCollection()
    {
        return $this->collection;
    }
}