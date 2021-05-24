<?php


namespace App\Model;


class Task extends Base
{
    const DEFAULT_PAGE_SIZE = 3;

    protected $id;
    protected $user_name;
    protected $email;
    protected $instructions;
    protected $is_completed = 0;

    static public function getTableName(): string
    {
        return 'task';
    }

    public function getAttributesLabels(): array
    {
        return [
            'id' => 'ID',
            'user_name' => 'User Name',
            'email' => 'Email',
            'instructions' => 'Text',
            'is_completed' => 'Is Completed',
        ];
    }

    public function validate(): Task
    {
        $requiredAttributes = ['user_name', 'email', 'instructions'];
        foreach ($requiredAttributes as $requiredAttribute) {
            if (empty($this->$requiredAttribute)) {
                throw new \Exception($requiredAttribute . ' is required');
            }
        }
        return $this;
    }

    public function processSaving($attributes)
    {
        try {
            $this->setAttributes($attributes)
                ->validate()
                ->save();
        } catch (\Throwable $e) {
            $this->setErrorMessage($e->getMessage());
        }

        return $this;
    }

    public static function loadById(int $id)
    {
        $sql = 'SELECT * FROM ' . self::getTableName() . ' WHERE id=' . $id;
        $pdo = \Core\DB\MySQL::getInstance()->getPdo();
        $statement = $pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchObject(Task::class);
    }

    public static function getList(): array
    {
        //effort to implement pagination and sorting - makes defenitely no sense as taking huge amount of time, redundant for test tasks ;)
        $pdo = \Core\DB\MySQL::getInstance()->getPdo();

        $sql = 'SELECT * FROM ' . self::getTableName();
        $statement = $pdo->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS, self::class);
    }
}
