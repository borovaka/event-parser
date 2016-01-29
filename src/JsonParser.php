<?php
namespace Tickets\EventsParser;

use Illuminate\Http\Request;
use Tickets\EventsParser\Exceptions\JsonParserException;
use Tickets\EventsParser\Interfaces\EventDataParserInterface;

/**
 * Class JsonParser
 * @package Tickets\EventsParser
 * @throw JsonParserException
 */
class JsonParser implements EventDataParserInterface
{


    private $rules;



    public function getParsedData(Request $request)
    {
          return $this->validate($request);

    }
    
    public function setValidationRules($rules)
    {
        $this->rules = $rules;
    }

    public function validate($data)
    {

        if(!$data->isJson()) {
            throw new JsonParserException('',JsonParserException::NOT_JSON);
        }

        $data = $data->input();


        $validator = \Validator::make($data, $this->rules);
        if($validator->fails()) {
            throw new JsonParserException($validator->getMessageBag()->toJson(), JsonParserException::VALIDATION_ERROR);
        }

        return $data;

    }


}
