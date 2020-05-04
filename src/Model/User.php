<?php


namespace App\Model;


use Core\RequestHandler;

class User extends Base
{
    static public function getTableName(): string
    {
        return 'user';
    }

    public function getAttributesLabels(): array
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'pass' => 'Pass',
        ];
    }

    public function validate(): User
    {
        foreach (['login', 'pass'] as $requiredAttribute) {
            if (empty($this->$requiredAttribute)) {
                throw new \Exception($requiredAttribute . ' is required');
            }
        }

        return $this;
    }

    public function processLogin($attributes)
    {
        try {
            $this->setAttributes($attributes)
                ->validate();

            $pass = md5($attributes['pass']);

            $sql = 'SELECT * FROM ' . self::getTableName() . ' WHERE login=:login AND pass=:pass LIMIT 1';
            $pdo = \Core\DB\MySQL::getInstance()->getPdo();
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':login', $attributes['login']);
            $statement->bindParam(':pass', $pass);
            $statement->execute();
            $user = $statement->fetchObject();
            if (!$user) {
                throw new \Exception('Credentials are wrong');
            }

            $_SESSION[RequestHandler::SESSION_KEY_USER_ID] = $user->id;
        } catch (\Throwable $e) {
            $this->setErrorMessage($e->getMessage());
        }

        return $this;
    }
}