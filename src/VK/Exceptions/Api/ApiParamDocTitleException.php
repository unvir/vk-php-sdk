<?php

namespace VK\Exceptions\Api;

class ApiParamDocTitleException extends VkApiException
{

    /**
     * ApiParamDocTitleException constructor.
     * @param string $message
     */
    public function __construct(string $message)
    {
        parent::__construct(1152, 'Invalid document title', $message);
    }
}
