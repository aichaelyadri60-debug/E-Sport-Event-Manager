<?php

abstract class BaseEntity
{
    public function hydrate(array $data): void
    {
        $ref = new ReflectionClass($this);

        foreach ($data as $key => $value) {

            if (!$ref->hasProperty($key)) {
                continue;
            }

            $prop = $ref->getProperty($key);
            $prop->setAccessible(true);
            $type = $prop->getType();
            if ($prop->isReadOnly()) {
                continue;
            }

            if ($type instanceof ReflectionNamedType) {
                $typeName = $type->getName();

                if ($typeName === DateTime::class && $value !== null) {
                    $value = new DateTime($value);
                }
            }

            $prop->setValue($this, $value);
        }
    }
}
