<?php
namespace Tickets\EventsParser\Exceptions;

class JsonParserException extends \Exception
{
    const VALIDATION_ERROR = 1;
    const NOT_JSON = 2;
    
    public function handle()
    {
        switch ($this->getCode()) {

            case self::VALIDATION_ERROR:
                response();
                return (\Response::json(['status' => 'error', 'message' => $this->getMessage()],422));
                break;
            case self:: NOT_JSON:
                return \Response::json(['status' => 'error', 'message' => 'Not a JSON!'],400);
                break;
            default:
                return \Response::json(['status' => 'error', 'message' => $this->getMessage()]);
                break;

        }
    }
}
