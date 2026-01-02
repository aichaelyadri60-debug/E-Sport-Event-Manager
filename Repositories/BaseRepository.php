<?php


class BaseRepository{
    protected string $table ;
    protected string $entityClass;
    public PDO $pdo;
    public function __construct(){
        $this->pdo=Database::getInstance()->getConnection();
    }

    public function findAll(){
        $entities =[];
        $sql = "SELECT * FROM {$this->table}";
        $stmt =$this->pdo->query($sql);
        $results =$stmt->fetchAll();
        foreach ($results as $result) {
            $entity =new $this->entityClass();
            $entity->hydrate($result);
            $entities[]=$entity;
        }
        return $entities;

    }

    public function findOne(int $id){
        $stmt =$this->pdo->prepare("SELECT * FROM ${this->table} where id=?");
        $stmt->execute([$id]);
        $result =$stmt->fetch();
        if(!$result) return null;
        $entity=new $this->entityClass();
        $entity->hydrate($result);
        return $entity;
    }

    public function Create(object $entity){
        $ref =new ReflectionClass($entity);
        $props =$ref->getProperties();
        $params =[];
        $values =[];
        $keys =[];
        foreach($props as $prop ){
            $props->setAccessible(true);
            $name =$prop->getName();
            if($name ==='id')continue;
            $keys[] =$name;
            $values[$name]=$prop.getValue();
            $params[]=':'.$name;
        }

        $stmt =$this->pdo->prepare("INSERT INTO {$this->table} (".implode (',',$keys).") VALUES(".implode(',',$params).")");
        return $stmt->execute($values);
    }

    public function delete(int $id){
        $stmt =$this->pdo->prepare("DELETE * FROM {$this->table} where id =?");
        $stmt->execute([$id]);
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

            if ($name === 'id') {
                $id = $value;
                continue;
            }

            $set[] = "$name = :$name";
            $data[$name] = $value;
        }

        $data['id'] = $id;

        $sql = "UPDATE {$this->table} SET " . implode(',', $set) . " WHERE id = :id";
        return $this->conn->prepare($sql)->execute($data);
    }
}