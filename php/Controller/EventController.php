<?php
require '../Model/Event.php';

class EventController
{
    /**
     * @var Event $event
     */
    private $event;

    public function __construct()
    {
        $this->event = new Event();
    }

    /**
     * @return false|string
     */
    public function index()
    {
        $events = $this->event->viewEvents();

        return json_encode($events);
    }

    /**
     * @return false|string
     * @throws Exception
     */
    public function store()
    {
        $id    = $_POST['id'];
        $title = $_POST['title'];
        if ( !is_numeric($id) || !is_string($title) ) {
            throw new Exception('Invalid id or title');
        }
        $event = $this->event->addEvent(intval($id), $title);

        return json_encode($event);

    }

    /**
     * @return false|string
     * @throws Exception
     */
    public function update()
    {

        $id    = $_POST['id'];
        $title = $_POST['title'];
        if ( !is_int($id) || !is_string($title) ) {
            throw new Exception('Invalid id or title');
        }

        $event = $this->event->editEvent($id, $title);

        return json_encode($event);

    }

    /**
     * @return false|string
     * @throws Exception
     */
    public function destroy()
    {

        $id = $_POST['id'];
        if ( !is_int($id) ) {
            throw new Exception('Invalid id');
        }
        $this->event->deleteEvent($id);

        return json_encode(['success' => true]);

    }

}
