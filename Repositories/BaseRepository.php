<?php

abstract class BaseRepository
{
    protected string $table;
    protected string $entityClass;
    protected string $primaryKey ='id';
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table}");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function ($row) {
            $entity = new $this->entityClass();
            $entity->hydrate($row);
            return $entity;
        }, $rows);
    }

    public function find(int $id): ?object
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;

        $entity = new $this->entityClass();
        $entity->hydrate($row);
        return $entity;
    }

    public function create(object $entity): bool
    {
        $ref = new ReflectionClass($entity);
        $props = $ref->getProperties();

        $fields = [];
        $params = [];
        $values = [];

        foreach ($props as $prop) {
    $prop->setAccessible(true);
    $name = $prop->getName();

    if ($name === 'id') continue;

    $value = $prop->getValue($entity);

    if ($value instanceof DateTime) {
        $value = $value->format('Y-m-d');
    }

    $fields[] = $name;
    $params[] = ':' . $name;
    $values[$name] = $value;
}


        $sql = "INSERT INTO {$this->table} (" . implode(',', $fields) . ")
                VALUES (" . implode(',', $params) . ")";

        return $this->pdo->prepare($sql)->execute($values);
    }

    public function update(object $entity): bool
    {
        $ref = new ReflectionClass($entity);
        $props = $ref->getProperties();

        $set = [];
        $data = [];
        $id = null;

        foreach ($props as $prop) {
            $prop->setAccessible(true);
            $name = $prop->getName();
            $value = $prop->getValue($entity);

            if ($name === $this->primaryKey) {
                $id = $value;
                continue;
            }

            $set[] = "$name = :$name";
            $data[$name] = $value;
        }

        $data["{$this->primaryKey}"] = $id;

        $sql = "UPDATE {$this->table} SET " . implode(', ', $set) . " WHERE {$this->primaryKey} = :{$this->primaryKey}";
        return $this->pdo->prepare($sql)->execute($data);
    }

    public function delete(int $id): bool
    {
        return $this->pdo
            ->prepare("DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id ")
            ->execute(['id' => $id]);
    }
}
