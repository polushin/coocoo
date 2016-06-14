<?php

namespace app\core;

class Table
{
    protected $db;
    protected $tableClassName;
    protected $tableName;

    protected $fields = [];

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        $this->tableClassName = (new \ReflectionClass(get_called_class()))->getShortName();
        $this->tableName = $this->camelCaseToUnderscore($this->tableClassName);
    }

    private function camelCaseToUnderscore($input) {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }

    public function get($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM `$this->tableName` WHERE `id`=:id");
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();
        if (empty($row)) {
            throw new \Exception(sprintf('Get Entity error. [%s, %d]', $this->tableName, $id));
        }
        return $this->newEntity($row);
    }

    public function findAll()
    {
        return $this->getEntities(sprintf('SELECT * FROM `%s`', $this->tableName));
    }

    public function getEntities($sql)
    {
        $rows = $this->db->query($sql);
        $entities = [];
        foreach($rows as $row) {
            $entities[] = $this->newEntity($row);
        }
        return $entities;
    }

    protected function insert(Entity $entity)
    {
        if (empty($this->fields)) {
            throw new \exception('No field set for '.$this->tableClassName);
        }

        $setList = [];
        $values = [];

        $entity->created = (new \DateTime())->format("Y-m-d H:i:s");

        foreach ($this->fields as $fieldName => $fieldType) {
            if ($fieldName == 'id') {
                continue;
            }
            $setList[] = "`$fieldName` = :$fieldName";
            $values[$fieldName] = $entity->$fieldName;
        }

        if (empty($setList)) {
            return;
        }

        $stmt = $this->db->prepare("INSERT INTO `$this->tableName` SET " . implode(',', $setList));
        $stmt->execute($values);
    }

    protected function update(Entity $entity)
    {
        throw new \Exception('Sorry. This functional not completed');
    }

    public function save(Entity $entity)
    {
        if ($entity->id) {
            $this->update($entity);
            return;
        }

        $this->insert($entity);
    }

    public function newEntity(array $data = [], $onlyTableFields = false)
    {
        if ($onlyTableFields) {
            $data = array_intersect_key($data, $this->fields);
        }

        return Entity::create($this->tableClassName, $data);
    }

    public function patchEntity(Entity $entity, array $data)
    {
        if (empty($data)) {
            return;
        }

        foreach($data as $key => $val) {
            $entity->$key = $val;
        }
    }

}