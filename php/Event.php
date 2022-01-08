<?php
require 'DatabaseTransactions.php';
require 'PDOConfig.php';
class Event
{
    public $event_name;
    public $id;
    private $db;

    public function __construct()
    {
    }

    public function addEvent($id, $event_name)
    {
        $event_name = filter_var($event_name, FILTER_UNSAFE_RAW);
        $id         = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        $db       = new DatabaseTransactions();
        $inserted = $db->insert($id, $event_name);
        if ( $inserted ) {
            return "Successfully inserted";
        } else {
            return "Something went wrong insertion didnot happen";
        }
    }

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
