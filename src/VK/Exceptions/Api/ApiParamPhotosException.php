<?php

namespace VK\Exceptions\Api;

class ApiParamPhotosException extends VkApiException
{

    /**
     * ApiParamPhotosException constructor.
     * @param string $message
     */
    public function __construct(string $message)
    {
        parent::__construct(122, 'Invalid photos', $message);
    }
}
