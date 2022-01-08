<?php

/**
 *
 */
class DatabaseTransactions extends PDOStatement
{
    /**
     * @var
     */
    private $connection;

    public function __construct()
    {
    }

    /**
     * @param $id
     * @param $event_name
     *
     * @return bool
     */
    public function insert($id, $event_name)
    {
        $sql = "INSERT INTO events(id, event_name) VALUES (?, ?)";
        try {
            $connection = $this->connection();
            $statement  = $connection->prepare($sql);

            $statement->bindParam(1, $id, PDO::PARAM_INT);
            $statement->bindParam(2, $event_name, PDO::PARAM_STR);

            $statement->execute();
            $connection = null;

            return true;
        } catch ( PDOException $e ) {
            echo $e->getMessage();

            return false;
        }
    }

    /**
     * @param $id
     *
     * @return array|false|mixed
     */
    public function select($id = null)
    {
        if ( isset($id) ) {
            $sql = "SELECT * FROM events WHERE id = :id";
            try {
                $connection = $this->connection();
                $statement  = $connection->prepare($sql);
                $statement->bindValue(':id', $id);
                $statement->execute();
                $result     = $statement->fetch(PDO::FETCH_ASSOC);
                $connection = null;

                return $result;
            } catch ( PDOException $e ) {
                echo $e->getMessage();

                return false;
            }
        } else {
            $sql = "SELECT * FROM events";
            try {
                $connection = $this->connection();
                $statement  = $connection->query($sql);
                $result     = $statement->fetchAll();
                $connection = null;

                return $result;
            } catch ( PDOException $e ) {
                echo $e->getMessage();

                return false;
            }
        }
    }

    /**
     * @param $event_name
     * @param $id
     *
     * @return bool
     */
    public function update($event_name, $id)
    {
        $sql = "UPDATE events set event_name = ? WHERE id = ?";
        try {
            $connection = $this->connection();
            $statement  = $connection->prepare($sql);
            $statement->bindParam(1, $event_name, PDO::PARAM_STR);
            $statement->bindParam(2, $id, PDO::PARAM_INT);
            $statement->execute();
            $connection = null;

            return true;
        } catch ( PDOException $e ) {
            echo $e->getMessage();

            return false;
        }
    }

    /**
     * @param $id
     *
     * @return bool
     */
    public function delete($id)
    {
        $sql = "DELETE FROM events WHERE id = ?";
        try {
            $connection = $this->connection();
            $statement  = $connection->prepare($sql);
            $statement->bindParam(1, $id, PDO::PARAM_INT);
            $statement->execute();
            $connection = null;

            return true;
        } catch ( PDOException $e ) {
            echo $e->getMessage();

            return false;
        }
    }

    /**
     * @return PDOConfig
     */
    private function connection()
    {
        return new PDOConfig();
    }
}

