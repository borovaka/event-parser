<?php
namespace Tickets\EventsParser;

use Tickets\EventsParser\Interfaces\EventDataParserInterface;

class ParseEventData
{

    protected $eventsData;

    public function __construct(EventDataParserInterface $parser, $data, $rues)
    {
        $parser->setValidationRules($rues);
        $this->eventsData = $parser->getParsedData($data);
    }

    public function getResult()
    {
        return $this->eventsData;
    }

}
