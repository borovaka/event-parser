<?php
namespace Tickets\EventsParser;

use Tickets\EventsParser\Interfaces\EventDataParserInterface;

class ParseEventData
{

    protected $eventsData;

    public function __construct(EventDataParserInterface $parser, $data)
    {
        $this->eventsData = $parser->parseData($data);
    }

    public function getResult()
    {
        return $this->eventsData;
    }

}
