<?php
require '../Utils/DatabaseTransactions.php';
require '../Config/PDOConfig.php';

/**
 *
 */
class Event
{
    /**
     * @var
     */
    public $event_name;
    /**
     * @var
     */
    public $id;
    /**
     * @var
     */
    private $db;

    /**
     *
     */
    public function __construct()
    {
    }

    /**
     * @param $id
     * @param $event_name
     *
     * @return string
     */
    public function addEvent($id, $event_name)
    {
        $event_name = filter_var($event_name, FILTER_UNSAFE_RAW);
        $id         = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        $db       = new DatabaseTransactions();
        $inserted = $db->insert($id, $event_name);
        if ( $inserted ) {
            return "Successfully inserted";
        } else {
            return "Something went wrong insertion didn't happen";
        }
    }

    /**
     * @return array|mixed|string[]
     */
    public function viewEvents()
    {
        $db     = new DatabaseTransactions();
        $result = $db->select();
        if ( $result ) {
            return $result;
        } else {
            return ["error" => "No results returned"];
        }
    }

    /**
     * @param $id
     *
     * @return array|mixed|string[]
     */
    public function viewEvent($id)
    {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        $db     = new DatabaseTransactions();
        $result = $db->select($id);
        if ( $result ) {
            return $result;
        } else {
            return ["error" => "No results returned"];
        }
    }

    /**
     * @param $id
     * @param $event_name
     *
     * @return bool
     */
    public function editEvent($id, $event_name)
    {
        $event_name = filter_var($event_name, FILTER_UNSAFE_RAW);
        $id         = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        $db     = new DatabaseTransactions();
        $result = $db->update($event_name, $id);
        if ( $result ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $id
     *
     * @return string
     */
    public function deleteEvent($id)
    {
        $id     = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $db     = new DatabaseTransactions();
        $result = $db->delete($id);
        if ( $result ) {
            return "deleted";
        } else {
            return "Something happened event not deleted";
        }
    }
}
