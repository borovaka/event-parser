<?php
namespace Tickets\EventsParser\Interfaces;

use Illuminate\Http\Request;

interface EventDataParserInterface
{
    public function getParsedData(Request $request);
    public function setValidationRules($rules);
    public function validate($data);
}
