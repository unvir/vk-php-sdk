<?php

namespace VK\Exceptions\Api;

class ApiSignatureException extends VKApiException {
    /**
     * ApiSignatureException constructor.
     * @param string $message
     **/
    public function __construct(string $message) {
        parent::__construct(4,  'Incorrect signature',  $message);
    }
}
