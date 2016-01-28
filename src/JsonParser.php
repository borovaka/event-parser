<?php
namespace Tickets\EventsParser;

use JsonSchema\Uri\UriRetriever;
use JsonSchema\Validator;
use Tickets\EventsParser\Exceptions\JsonParserException;
use Tickets\EventsParser\Interfaces\EventDataParserInterface;

class JsonParser implements EventDataParserInterface
{

    private $jsonSchemaURI;
    private $requestJson;

    public function __construct()
    {
        $this->jsonSchemaURI = url('/admin/api/json-schema.json');
    }

    /**
     * @param json $data
     * @return mixed
     */
    public function parseData($json)
    {

        try {

            if (empty($json) || !is_array(json_decode($json, true))) {
                throw new JsonParserException('Not a JSON!');
            }

            $this->requestJson = $json;
            if ($this->validate()) {
                return json_decode($this->requestJson, true);
            }

        } catch (JsonParserException $e) {
            return $e->getMessage();
        }

    }

    /**
     * @param Json $jsonString
     * @return bool
     */
    public function validate($jsonString = null)
    {
        $retriever = new UriRetriever;
        $schema = $retriever->retrieve($this->jsonSchemaURI);
        $data = is_null($jsonString) ? $this->requestJson : $jsonString;

        // Validate
        $validator = new Validator();
        $validator->check(json_decode($data), $schema);

        if ($validator->isValid()) {
            return true;
        } else {
            echo "JSON does not validate. Violations:\n";
            foreach ($validator->getErrors() as $error) {
                die(sprintf("[%s] %s\n", $error['property'], $error['message']));
            }
        }
    }

    /**
     * @param \Illuminate\Contracts\Routing\UrlGenerator|string $jsonSchemaURI
     */
    public function setJsonSchemaURI($jsonSchemaURI)
    {
        $this->jsonSchemaURI = $jsonSchemaURI;
    }
}
