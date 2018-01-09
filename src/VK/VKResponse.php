<?php

namespace VK;

use VK\Exceptions\VKApiException;

/**
 * Class VKResponse
 *
 * @package VK
 */
class VKResponse {
    /**
     * @var string|boolean The raw response from the server.
     */
    protected $raw_response;

    /**
     * @var int The HTTP status code response.
     */
    protected $http_status_code;

    /**
     * @var array The returned headers.
     */
    protected $headers;

    /**
     * @var string The raw body of the response.
     */
    protected $body;

    /**
     * @var array The decoded body of the response.
     */
    protected $decoded_body = [];

    /**
     * @var VKApiException The exception thrown by api.
     */
    protected $thrown_exception;

    /**
     * Creates a new Response entity from raw response.
     *
     * @var string|boolean The raw response from the server.
     */
    public function __construct($raw_response) {
        $this->raw_response = $raw_response;
        $this->parseRawResponse();

        $this->decodeBody();
    }

    /**
     * Return the HTTP status code for this response.
     *
     * @return int
     */
    public function getHttpStatusCode() {
        return $this->http_status_code;
    }

    /**
     * Return the HTTP headers for this response.
     *
     * @return array
     */
    public function getHeaders() {
        return $this->headers;
    }

    /**
     * Return the raw body response.
     *
     * @return string
     */
    public function getBody() {
        return $this->body;
    }

    /**
     * Return the decoded body response.
     *
     * @return array
     */
    public function getDecodedBody() {
        return $this->decoded_body;
    }

    /**
     * Returns the exception that was thrown for this request.
     *
     * @return VKApiException|null
     */
    public function getThrownException() {
        return $this->thrown_exception;
    }

    /**
     * Breaks the raw response down into its headers, body and http status code.
     */
    protected function parseRawResponse() {
        list($raw_headers, $raw_body) = $this->extractResponseHeadersAndBody();

        $this->setHeadersFromString($raw_headers);

        $this->body = $raw_body;
    }

    /**
     * Extracts the headers and the body into a two-part array.
     *
     * @return array
     */
    protected function extractResponseHeadersAndBody() {
        $parts = explode("\r\n\r\n", $this->raw_response);
        $raw_body = array_pop($parts);
        $raw_headers = implode("\r\n\r\n", $parts);

        return [trim($raw_headers), trim($raw_body)];
    }

    /**
     * Parse the raw headers and set as an array.
     *
     * @param string The raw headers from the response.
     */
    protected function setHeadersFromString($raw_headers) {
        // Normalize line breaks
        $raw_headers = str_replace("\r\n", "\n", $raw_headers);

        // There will be multiple headers if a 301 was followed
        // or a proxy was followed, etc
        $header_collection = explode("\n\n", trim($raw_headers));
        // We just want the last response (at the end)
        $raw_header = array_pop($header_collection);

        $header_components = explode("\n", $raw_header);
        foreach ($header_components as $line) {
            if (strpos($line, ': ') === false) {
                $this->setHttpStatusCodeFromHeader($line);
            } else {
                list($key, $value) = explode(': ', $line, 2);
                $this->headers[$key] = $value;
            }
        }
    }

    /**
     * Sets the HTTP response code from a raw header.
     *
     * @param string
     */
    protected function setHttpStatusCodeFromHeader($raw_response_header) {
        preg_match('|HTTP/\d\.\d\s+(\d+)\s+.*|', $raw_response_header, $match);
        $this->http_status_code = (int)$match[1];
    }

    /**
     * Instantiates an exception to be thrown later.
     */
    protected function makeException() {
        $this->thrown_exception = new VKApiException($this->decoded_body['error']['error_code'],
            $this->decoded_body['error']['error_msg']);
    }

    /**
     * Throws the exception.
     *
     * @throws VKApiException
     */
    public function throwException() {
        throw $this->thrown_exception;
    }

    /**
     * Convert the raw response into an array if possible.
     */
    protected function decodeBody() {
        $this->decoded_body = json_decode($this->body, true);

        if ($this->decoded_body === null || !is_array($this->decoded_body)) {
            $this->decoded_body = [];
        }

        if (isset($this->decoded_body['error'])) {
            $this->makeException();
        }
    }
}
