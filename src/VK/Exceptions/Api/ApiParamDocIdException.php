<?php

namespace VK\Exceptions\Api;

class ApiParamDocIdException extends VKApiException {
    /**
     * ApiParamDocIdException constructor.
     * @param string $message
     **/
    public function __construct(string $message) {
        parent::__construct(1150,  'Invalid document id',  $message);
    }
}
