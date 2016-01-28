<?php
namespace Tickets\EventsParser\Interfaces;

interface EventDataParserInterface
{
    public function parseData($data);
    public function validate($data);
}
