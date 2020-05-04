<?php


namespace App\Model;


class Task extends Base
{
    const DEFAULT_PAGE_SIZE = 3;

    protected $id;
    protected $user_name;
    protected $email;
    protected $instructions;
    protected $is_completed;

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

        //@todo check if it is update - any one can create but update - only admin

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

    public function updateModel()
    {

    }

    public static function getList(): array
    {
        $pdo = \Core\DB\MySQL::getInstance()->getPdo();

        $sql = 'SELECT * FROM ' . self::getTableName();
        $statement = $pdo->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    //effort to implement pagination and sorting - makes defenitely no sense as taking huge amount of time, when present in all frameworks ;)
    public static function _getList(int $limit, int $offset = 0, $orderBy = 'id', $orderDirection = 'ASC'): array
    {
        $pdo = \Core\DB\MySQL::getInstance()->getPdo();

        $sql = 'SELECT * FROM ' . self::getTableName() . ' ORDER BY :orderBy :orderDirection LIMIT :offset, :limit';

        $statement = $pdo->prepare($sql);
        $statement->bindParam(':offset', $offset, \PDO::PARAM_INT);
        $statement->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $statement->bindParam(':orderBy', $orderBy);
        $statement->bindParam(':orderDirection', $orderDirection);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}