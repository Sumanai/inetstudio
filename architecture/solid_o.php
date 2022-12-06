<?php

interface ObjectInterface
{
    public function getHandle(): string;
}

abstract class AbstractObject implements ObjectInterface
{
    public function getHandle(): string
    {
        return 'handle_object_' . (string) spl_object_id($this);
    }
}

class SomeObject extends AbstractObject
{
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getObjectName(): string
    {
        return $this->name;
    }
}

class SomeObjectsHandler
{
    public function __construct()
    {
    }

    public function handleObjects(array $objects): array
    {
        $handlers = [];
        foreach ($objects as $object) {
            if (!($object instanceof ObjectInterface)) {
                // TODO: Логирование вывода ошибки вместо исключения?
                throw new Exception('Wrong object type');
            }
            $handlers[] = $object->getHandle();
        }

        return $handlers;
    }
}

$objects = [
    new SomeObject('object_1'),
    new SomeObject('object_2')
];

$soh = new SomeObjectsHandler();
$soh->handleObjects($objects);
