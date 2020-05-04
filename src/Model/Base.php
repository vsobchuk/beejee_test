<?php


namespace App\Model;


abstract class Base
{
    /**
     * @return array
     * in this method should be listed all attributes that need to be able to save in to DB
     */
    abstract public function getAttributesLabels(): array;
    abstract public function validate();
    abstract static public function getTableName(): string;

    protected $errorMessage;

    /**
     * @return mixed
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @param mixed $errorMessage
     * @return Base
     */
    public function setErrorMessage($errorMessage): Base
    {
        $this->errorMessage = $errorMessage;
        return $this;
    }

    public function setAttributes(array $attributes)
    {
        $modelAttributes = array_keys($this->getAttributesLabels());
        foreach ($modelAttributes as $modelAttribute) {
            if (isset($attributes[$modelAttribute])) {
                $this->$modelAttribute = $attributes[$modelAttribute];
            }
        }

        return $this;
    }

    public function setAttribute($attribute, $value)
    {
        $modelAttributes = $this->getAttributesLabels();
        if (isset($modelAttributes[$attribute])) {
            $this->$attribute = $value;
        }
        return $this;
    }

    public function getAttributeValue(string $attribute)
    {
        return $this->$attribute ?? null;
    }

    public function getAttributeLabel(string $attribute): string
    {
        $attributes = $this->getAttributesLabels();
        return $attributes[$attribute] ?? ucfirst($attribute);
    }

    //Active record is good when talking about small agile solutions, but not so good for big
    // as here time does matter - I preferred to use AR
    public function save()
    {
        if (empty($this->id)) {
            $this->insertModel();
            return $this;
        }

        $this->updateModel();
        return $this;
    }

    protected function insertModel()
    {
        $attributes = $this->getAttributesLabels();
        unset($attributes['id']);
        $attributes = array_keys($attributes);

        $sql = 'INSERT INTO ' . static::getTableName()
            . ' (' . implode(',', $attributes) . ')'
            . ' VALUES (:' . implode(',:', $attributes) . ')';


        $pdo = \Core\DB\MySQL::getInstance()->getPdo();
        $statement = $pdo->prepare($sql);
        foreach ($attributes as $attribute) {
            $statement->bindParam(':' . $attribute, $this->$attribute);
        }
        $statement->execute();
    }

    public function updateModel()
    {
        $attributes = $this->getAttributesLabels();
        $id = $this->id;
        unset($attributes['id']);
        $attributes = array_keys($attributes);

        $sql = 'UPDATE ' . static::getTableName() . ' SET ';
        foreach ($attributes as $attribute) {
            $sql .= $attribute . '=:' . $attribute . ', ';
        }
        $sql = trim($sql, ', ');
        $sql .= ' WHERE id=' . (int)$id;

        $pdo = \Core\DB\MySQL::getInstance()->getPdo();
        $statement = $pdo->prepare($sql);
        foreach ($attributes as $attribute) {
            $statement->bindParam(':' . $attribute, $this->$attribute);
        }
        $statement->execute();
    }
}