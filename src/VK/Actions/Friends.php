<?php

namespace VK\Actions;

use VK\VKAPIRequest;
use VK\Exceptions\VKClientException;
use VK\Exceptions\VKAPIException;
use VK\Exceptions\HttpRequestException;
use VK\Actions\Enums\FriendsGetOrder;
use VK\Actions\Enums\FriendsGetNameCase;
use VK\Actions\Enums\FriendsGetRequestsSort;
use VK\Actions\Enums\FriendsGetSuggestionsNameCase;
use VK\Actions\Enums\FriendsGetAvailableForCallNameCase;
use VK\Actions\Enums\FriendsSearchNameCase;

class Friends {

    /**
     * @var VKAPIRequest
     **/
    private $client;

    public function __construct($client) {
        $this->client = $client;
    }

    /**
     * Returns a list of user IDs or detailed information about a user's friends.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer user_id: User ID. By default, the current user ID.
     *      - FriendsGetOrder order: Sort order: , 'name' — by name (enabled only if the 'fields' parameter is
     *        used), 'hints' — by rating, similar to how friends are sorted in My friends section, , This parameter is
     *        available only for [vk.com/dev/standalone|desktop applications].
     *        @see FriendsGetOrder
     *      - integer list_id: ID of the friend list returned by the [vk.com/dev/friends.getLists|friends.getLists]
     *        method to be used as the source. This parameter is taken into account only when the uid parameter is set to
     *        the current user ID. This parameter is available only for [vk.com/dev/standalone|desktop applications].
     *      - integer count: Number of friends to return.
     *      - integer offset: Offset needed to return a specific subset of friends.
     *      - array fields: Profile fields to return. Sample values: 'uid', 'first_name', 'last_name', 'nickname',
     *        'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'domain',
     *        'has_mobile', 'rate', 'contacts', 'education'.
     *      - FriendsGetNameCase name_case: Case for declension of user name and surname: , 'nom' — nominative
     *        (default) , 'gen' — genitive , 'dat' — dative , 'acc' — accusative , 'ins' — instrumental , 'abl'
     *        — prepositional
     *        @see FriendsGetNameCase
     * 
     * @return array
     * @throws VKClientException
     * @throws VKAPIException
     * @throws HttpRequestException
     * 
     **/
    public function get($access_token, $params = array()) {
        return $this->client->post('friends.get', $access_token, $params);
    }

    /**
     * Returns a list of user IDs of a user's friends who are online.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer user_id: User ID.
     *      - integer list_id: Friend list ID. If this parameter is not set, information about all online friends
     *        is returned.
     *      - boolean online_mobile: '1' — to return an additional 'online_mobile' field, '0' — (default),
     *      - string order: Sort order: 'random' — random order
     *      - integer count: Number of friends to return.
     *      - integer offset: Offset needed to return a specific subset of friends.
     * 
     * @return array
     * @throws VKClientException
     * @throws VKAPIException
     * @throws HttpRequestException
     * 
     **/
    public function getOnline($access_token, $params = array()) {
        return $this->client->post('friends.getOnline', $access_token, $params);
    }

    /**
     * Returns a list of user IDs of the mutual friends of two users.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer source_uid: ID of the user whose friends will be checked against the friends of the user
     *        specified in 'target_uid'.
     *      - integer target_uid: ID of the user whose friends will be checked against the friends of the user
     *        specified in 'source_uid'.
     *      - array target_uids: IDs of the users whose friends will be checked against the friends of the user
     *        specified in 'source_uid'.
     *      - string order: Sort order: 'random' — random order
     *      - integer count: Number of mutual friends to return.
     *      - integer offset: Offset needed to return a specific subset of mutual friends.
     * 
     * @return array
     * @throws VKClientException
     * @throws VKAPIException
     * @throws HttpRequestException
     * 
     **/
    public function getMutual($access_token, $params = array()) {
        return $this->client->post('friends.getMutual', $access_token, $params);
    }

    /**
     * Returns a list of user IDs of the current user's recently added friends.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer count: Number of recently added friends to return.
     * 
     * @return array
     * @throws VKClientException
     * @throws VKAPIException
     * @throws HttpRequestException
     * 
     **/
    public function getRecent($access_token, $params = array()) {
        return $this->client->post('friends.getRecent', $access_token, $params);
    }

    /**
     * Returns information about the current user's incoming and outgoing friend requests.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer offset: Offset needed to return a specific subset of friend requests.
     *      - integer count: Number of friend requests to return (default 100, maximum 1000).
     *      - boolean extended: '1' — to return response messages from users who have sent a friend request or,
     *        if 'suggested' is set to '1', to return a list of suggested friends
     *      - boolean need_mutual: '1' — to return a list of mutual friends (up to 20), if any
     *      - boolean out: '1' — to return outgoing requests, '0' — to return incoming requests (default)
     *      - FriendsGetRequestsSort sort: Sort order: '1' — by number of mutual friends, '0' — by date
     *        @see FriendsGetRequestsSort
     *      - boolean suggested: '1' — to return a list of suggested friends, '0' — to return friend requests
     *        (default)
     * 
     * @return array
     * @throws VKClientException
     * @throws VKAPIException
     * @throws HttpRequestException
     * 
     **/
    public function getRequests($access_token, $params = array()) {
        return $this->client->post('friends.getRequests', $access_token, $params);
    }

    /**
     * Approves or creates a friend request.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer user_id: ID of the user whose friend request will be approved or to whom a friend request
     *        will be sent.
     *      - string text: Text of the message (up to 500 characters) for the friend request, if any.
     *      - boolean follow: '1' to pass an incoming request to followers list.
     * 
     * @return array
     * @throws VKClientException
     * @throws VKAPIException
     * @throws HttpRequestException
     * 
     **/
    public function add($access_token, $params = array()) {
        return $this->client->post('friends.add', $access_token, $params);
    }

    /**
     * Edits the friend lists of the selected user.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer user_id: ID of the user whose friend list is to be edited.
     *      - array list_ids: IDs of the friend lists to which to add the user.
     * 
     * @return array
     * @throws VKClientException
     * @throws VKAPIException
     * @throws HttpRequestException
     * 
     **/
    public function edit($access_token, $params = array()) {
        return $this->client->post('friends.edit', $access_token, $params);
    }

    /**
     * Declines a friend request or deletes a user from the current user's friend list.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer user_id: ID of the user whose friend request is to be declined or who is to be deleted from
     *        the current user's friend list.
     * 
     * @return array
     * @throws VKClientException
     * @throws VKAPIException
     * @throws HttpRequestException
     * 
     **/
    public function delete($access_token, $params = array()) {
        return $this->client->post('friends.delete', $access_token, $params);
    }

    /**
     * Returns a list of the user's friend lists.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer user_id: User ID.
     *      - boolean return_system: '1' — to return system friend lists. By default: '0'.
     * 
     * @return array
     * @throws VKClientException
     * @throws VKAPIException
     * @throws HttpRequestException
     * 
     **/
    public function getLists($access_token, $params = array()) {
        return $this->client->post('friends.getLists', $access_token, $params);
    }

    /**
     * Creates a new friend list for the current user.
     * 
     * @param $access_token string
     * @param $params array
     *      - string name: Name of the friend list.
     *      - array user_ids: IDs of users to be added to the friend list.
     * 
     * @return array
     * @throws VKClientException
     * @throws VKAPIException
     * @throws HttpRequestException
     * 
     **/
    public function addList($access_token, $params = array()) {
        return $this->client->post('friends.addList', $access_token, $params);
    }

    /**
     * Edits a friend list of the current user.
     * 
     * @param $access_token string
     * @param $params array
     *      - string name: Name of the friend list.
     *      - integer list_id: Friend list ID.
     *      - array user_ids: IDs of users in the friend list.
     *      - array add_user_ids: (Applies if 'user_ids' parameter is not set.), User IDs to add to the friend
     *        list.
     *      - array delete_user_ids: (Applies if 'user_ids' parameter is not set.), User IDs to delete from the
     *        friend list.
     * 
     * @return array
     * @throws VKClientException
     * @throws VKAPIException
     * @throws HttpRequestException
     * 
     **/
    public function editList($access_token, $params = array()) {
        return $this->client->post('friends.editList', $access_token, $params);
    }

    /**
     * Deletes a friend list of the current user.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer list_id: ID of the friend list to delete.
     * 
     * @return array
     * @throws VKClientException
     * @throws VKAPIException
     * @throws HttpRequestException
     * 
     **/
    public function deleteList($access_token, $params = array()) {
        return $this->client->post('friends.deleteList', $access_token, $params);
    }

    /**
     * Returns a list of IDs of the current user's friends who installed the application.
     * 
     * @param $access_token string
     * @param $params array
     * 
     * @return array
     * @throws VKClientException
     * @throws VKAPIException
     * @throws HttpRequestException
     * 
     **/
    public function getAppUsers($access_token, $params = array()) {
        return $this->client->post('friends.getAppUsers', $access_token, $params);
    }

    /**
     * Returns a list of the current user's friends whose phone numbers, validated or specified in a profile, are in a
     * given list.
     * 
     * @param $access_token string
     * @param $params array
     *      - array phones: List of phone numbers in MSISDN format (maximum 1000). Example:
     *        "+79219876543,+79111234567"
     *      - array fields: Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate'
     *        (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'rate',
     *        'contacts', 'education', 'online, counters'.
     * 
     * @return array
     * @throws VKClientException
     * @throws VKAPIException
     * @throws HttpRequestException
     * 
     **/
    public function getByPhones($access_token, $params = array()) {
        return $this->client->post('friends.getByPhones', $access_token, $params);
    }

    /**
     * Marks all incoming friend requests as viewed.
     * 
     * @param $access_token string
     * @param $params array
     * 
     * @return array
     * @throws VKClientException
     * @throws VKAPIException
     * @throws HttpRequestException
     * 
     **/
    public function deleteAllRequests($access_token, $params = array()) {
        return $this->client->post('friends.deleteAllRequests', $access_token, $params);
    }

    /**
     * Returns a list of profiles of users whom the current user may know.
     * 
     * @param $access_token string
     * @param $params array
     *      - array filter: Types of potential friends to return: 'mutual' — users with many mutual friends ,
     *        'contacts' — users found with the [vk.com/dev/account.importContacts|account.importContacts] method ,
     *        'mutual_contacts' — users who imported the same contacts as the current user with the
     *        [vk.com/dev/account.importContacts|account.importContacts] method
     *      - integer count: Number of suggestions to return.
     *      - integer offset: Offset needed to return a specific subset of suggestions.
     *      - array fields: Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate'
     *        (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'rate',
     *        'contacts', 'education', 'online', 'counters'.
     *      - FriendsGetSuggestionsNameCase name_case: Case for declension of user name and surname: , 'nom' —
     *        nominative (default) , 'gen' — genitive , 'dat' — dative , 'acc' — accusative , 'ins' — instrumental
     *        , 'abl' — prepositional
     *        @see FriendsGetSuggestionsNameCase
     * 
     * @return array
     * @throws VKClientException
     * @throws VKAPIException
     * @throws HttpRequestException
     * 
     **/
    public function getSuggestions($access_token, $params = array()) {
        return $this->client->post('friends.getSuggestions', $access_token, $params);
    }

    /**
     * Checks the current user's friendship status with other specified users.
     * 
     * @param $access_token string
     * @param $params array
     *      - array user_ids: IDs of the users whose friendship status to check.
     *      - boolean need_sign: '1' — to return 'sign' field. 'sign' is
     *        md5("{id}_{user_id}_{friends_status}_{application_secret}"), where id is current user ID. This field allows
     *        to check that data has not been modified by the client. By default: '0'.
     * 
     * @return array
     * @throws VKClientException
     * @throws VKAPIException
     * @throws HttpRequestException
     * 
     **/
    public function areFriends($access_token, $params = array()) {
        return $this->client->post('friends.areFriends', $access_token, $params);
    }

    /**
     * Returns a list of friends who can be called by the current user.
     * 
     * @param $access_token string
     * @param $params array
     *      - array fields: Profile fields to return. Sample values: 'uid', 'first_name', 'last_name', 'nickname',
     *        'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'domain',
     *        'has_mobile', 'rate', 'contacts', 'education'.
     *      - FriendsGetAvailableForCallNameCase name_case: Case for declension of user name and surname: , 'nom'
     *        — nominative (default) , 'gen' — genitive , 'dat' — dative , 'acc' — accusative , 'ins' —
     *        instrumental , 'abl' — prepositional
     *        @see FriendsGetAvailableForCallNameCase
     * 
     * @return array
     * @throws VKClientException
     * @throws VKAPIException
     * @throws HttpRequestException
     * 
     **/
    public function getAvailableForCall($access_token, $params = array()) {
        return $this->client->post('friends.getAvailableForCall', $access_token, $params);
    }

    /**
     * Returns a list of friends matching the search criteria.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer user_id: User ID.
     *      - string q: Search query string (e.g., 'Vasya Babich').
     *      - array fields: Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate'
     *        (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'rate',
     *        'contacts', 'education', 'online',
     *      - FriendsSearchNameCase name_case: Case for declension of user name and surname: 'nom' — nominative
     *        (default), 'gen' — genitive , 'dat' — dative, 'acc' — accusative , 'ins' — instrumental , 'abl' —
     *        prepositional
     *        @see FriendsSearchNameCase
     *      - integer offset: Offset needed to return a specific subset of friends.
     *      - integer count: Number of friends to return.
     * 
     * @return array
     * @throws VKClientException
     * @throws VKAPIException
     * @throws HttpRequestException
     * 
     **/
    public function search($access_token, $params = array()) {
        return $this->client->post('friends.search', $access_token, $params);
    }
}
