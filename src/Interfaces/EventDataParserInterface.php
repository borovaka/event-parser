<?php namespace App\Api\Interfaces;

use Illuminate\Http\Request;

interface EventDataParserInterface {
    public function parseData($data);
    public function validate($data);
}