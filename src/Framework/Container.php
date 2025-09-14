<?php
namespace Framework;

use ReflectionClass;
use ReflectionNamedType;
use Framework\Exceptions\ContainerException;

class Container
{
    private array $definitions = [];

    // Add factory definitions to the container
    public function addDefinitions(array $newDefinitions): void
    {
        $this->definitions = [...$this->definitions, ...$newDefinitions];
    }

    // Resolve a class and its dependencies
    public function resolve(string $className): object
    {
        $reflectionClass = new ReflectionClass($className);

        if (!$reflectionClass->isInstantiable()) {
            throw new ContainerException("Class {$className} is not instantiable.");
        }

        $constructor = $reflectionClass->getConstructor();

        // No constructor or no parameters? Just create the object
        if (!$constructor || count($constructor->getParameters()) === 0) {
            return new $className();
        }

        $dependencies = [];
        foreach ($constructor->getParameters() as $parameter) {
            $paramType = $parameter->getType();

            if (!$paramType instanceof ReflectionNamedType || $paramType->isBuiltin()) {
                throw new ContainerException(
                    "Cannot resolve the parameter \${$parameter->getName()} of class {$className}."
                );
            }

            $paramClassName = $paramType->getName();

            // If a factory is defined, use it
            if (isset($this->definitions[$paramClassName])) {
                $dependencies[] = ($this->definitions[$paramClassName])();
            } else {
                // Otherwise, recursively resolve the dependency
                $dependencies[] = $this->resolve($paramClassName);
            }
        }

        return $reflectionClass->newInstanceArgs($dependencies);
    }

    // Get a service from the container
    public function get(string $id): object
    {
        if (isset($this->definitions[$id])) {
            return ($this->definitions[$id])();
        }

        return $this->resolve($id);
    }
}
