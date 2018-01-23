<?php

namespace VK\Actions;

use VK\VKAPIClient;
use VK\Exceptions\VKClientException;
use VK\VKResponse;
use VK\Actions\Enums\PagesSaveAccessView;
use VK\Actions\Enums\PagesSaveAccessEdit;

class Pages {
    /**
     * @var VKAPIClient
     **/
    private $client;

    public function __construct($client) {
        $this->client = $client;
    }

    /**
     * Returns information about a wiki page.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer owner_id: Page owner ID.
     *      - integer page_id: Wiki page ID.
     *      - boolean global: '1' — to return information about a global wiki page
     *      - boolean site_preview: '1' — resulting wiki page is a preview for the attached link
     *      - string title: Wiki page title.
     *      - boolean need_source:
     *      - boolean need_html: '1' — to return the page as HTML,
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function get($access_token, $params = array()) {
        return $this->client->request('pages.get', $access_token, $params);
    }

    /**
     * Saves the text of a wiki page.
     * 
     * @param $access_token string
     * @param $params array
     *      - string text: Text of the wiki page in wiki-format.
     *      - integer page_id: Wiki page ID. The 'title' parameter can be passed instead of 'pid'.
     *      - integer group_id: ID of the community that owns the wiki page.
     *      - integer user_id: 
     *      - string title: Wiki page title.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function save($access_token, $params = array()) {
        return $this->client->request('pages.save', $access_token, $params);
    }

    /**
     * Saves modified read and edit access settings for a wiki page.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer page_id: Wiki page ID.
     *      - integer group_id: ID of the community that owns the wiki page.
     *      - integer user_id: 
     *      - PagesSaveAccessView view: Who can view the wiki page: '1' — only community members, '2' — all
     *        users can view the page, '0' — only community managers
     *        @see PagesSaveAccessView
     *      - PagesSaveAccessEdit edit: Who can edit the wiki page: '1' — only community members, '2' — all
     *        users can edit the page, '0' — only community managers
     *        @see PagesSaveAccessEdit
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function saveAccess($access_token, $params = array()) {
        return $this->client->request('pages.saveAccess', $access_token, $params);
    }

    /**
     * Returns a list of all previous versions of a wiki page.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer page_id: Wiki page ID.
     *      - integer group_id: ID of the community that owns the wiki page.
     *      - integer user_id: 
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getHistory($access_token, $params = array()) {
        return $this->client->request('pages.getHistory', $access_token, $params);
    }

    /**
     * Returns a list of wiki pages in a group.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer group_id: ID of the community that owns the wiki page.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getTitles($access_token, $params = array()) {
        return $this->client->request('pages.getTitles', $access_token, $params);
    }

    /**
     * Returns the text of one of the previous versions of a wiki page.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer version_id: 
     *      - integer group_id: ID of the community that owns the wiki page.
     *      - integer user_id: 
     *      - boolean need_html: '1' — to return the page as HTML
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getVersion($access_token, $params = array()) {
        return $this->client->request('pages.getVersion', $access_token, $params);
    }

    /**
     * Returns HTML representation of the wiki markup.
     * 
     * @param $access_token string
     * @param $params array
     *      - string text: Text of the wiki page.
     *      - integer group_id: ID of the group in the context of which this markup is interpreted.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function parseWiki($access_token, $params = array()) {
        return $this->client->request('pages.parseWiki', $access_token, $params);
    }

    /**
     * Allows to clear the cache of particular 'external' pages which may be attached to VK posts.
     * 
     * @param $access_token string
     * @param $params array
     *      - string url: Address of the page where you need to refesh the cached version
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function clearCache($access_token, $params = array()) {
        return $this->client->request('pages.clearCache', $access_token, $params);
    }
}
