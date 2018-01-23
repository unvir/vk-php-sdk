<?php

namespace VK\Actions;

use VK\VKAPIClient;
use VK\Exceptions\VKClientException;
use VK\VKResponse;

class Docs {
    /**
     * @var VKAPIClient
     **/
    private $client;

    public function __construct($client) {
        $this->client = $client;
    }

    /**
     * Returns detailed information about user or community documents.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer count: Number of documents to return. By default, all documents.
     *      - integer offset: Offset needed to return a specific subset of documents.
     *      - integer owner_id: ID of the user or community that owns the documents. Use a negative value to
     *        designate a community ID.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function get($access_token, $params = array()) {
        return $this->client->request('docs.get', $access_token, $params);
    }

    /**
     * Returns information about documents by their IDs.
     * 
     * @param $access_token string
     * @param $params array
     *      - array docs: Document IDs. Example: , "66748_91488,66748_91455",
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getById($access_token, $params = array()) {
        return $this->client->request('docs.getById', $access_token, $params);
    }

    /**
     * Returns the server address for document upload.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer group_id: Community ID (if the document will be uploaded to the community).
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getUploadServer($access_token, $params = array()) {
        return $this->client->request('docs.getUploadServer', $access_token, $params);
    }

    /**
     * Returns the server address for document upload onto a user's or community's wall.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer group_id: Community ID (if the document will be uploaded to the community).
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getWallUploadServer($access_token, $params = array()) {
        return $this->client->request('docs.getWallUploadServer', $access_token, $params);
    }

    /**
     * Saves a document after [vk.com/dev/upload_files_2|uploading it to a server].
     * 
     * @param $access_token string
     * @param $params array
     *      - string file: This parameter is returned when the file is [vk.com/dev/upload_files_2|uploaded to the
     *        server].
     *      - string title: Document title.
     *      - string tags: Document tags.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function save($access_token, $params = array()) {
        return $this->client->request('docs.save', $access_token, $params);
    }

    /**
     * Deletes a user or community document.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer owner_id: ID of the user or community that owns the document. Use a negative value to
     *        designate a community ID.
     *      - integer doc_id: Document ID.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function delete($access_token, $params = array()) {
        return $this->client->request('docs.delete', $access_token, $params);
    }

    /**
     * Copies a document to a user's or community's document list.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer owner_id: ID of the user or community that owns the document. Use a negative value to
     *        designate a community ID.
     *      - integer doc_id: Document ID.
     *      - string access_key: Access key. This parameter is required if 'access_key' was returned with the
     *        document's data.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function add($access_token, $params = array()) {
        return $this->client->request('docs.add', $access_token, $params);
    }

    /**
     * Returns documents types available for current user.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer owner_id: ID of the user or community that owns the documents. Use a negative value to
     *        designate a community ID.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getTypes($access_token, $params = array()) {
        return $this->client->request('docs.getTypes', $access_token, $params);
    }

    /**
     * Returns a list of documents matching the search criteria.
     * 
     * @param $access_token string
     * @param $params array
     *      - string q: Search query string.
     *      - integer count: Number of results to return.
     *      - integer offset: Offset needed to return a specific subset of results.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function search($access_token, $params = array()) {
        return $this->client->request('docs.search', $access_token, $params);
    }

    /**
     * Edits a document.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer owner_id: User ID or community ID. Use a negative value to designate a community ID.
     *      - integer doc_id: Document ID.
     *      - string title: Document title.
     *      - array tags: Document tags.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function edit($access_token, $params = array()) {
        return $this->client->request('docs.edit', $access_token, $params);
    }
}
