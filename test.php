<?php
/**
 * Created by PhpStorm.
 * User: Fedde
 * Date: 30-5-2016
 * Time: 14:49
 */

define('BASE_URI', 'http://52.28.145.71:8080');
require 'vendor/autoload.php';
use GuzzleHttp\Client;

// mini wrapper to avoid cross side origin policy
class Cycle {

    private $client;

    // inject guzzle through $client
    public function __construct($client) {
        $this->client = $client;
    }

    // fetch token
    public function getToken() {

        $userData = [
            'Username' => 'Marco Npc',
            'Password' => 'MaaktNietUit'
        ];

        $response = $this->client->post('Users/Login', [
            'body' => json_encode($userData)
        ]);

        $return = $response->getBody();
        $return = json_decode($return);

        return $return->access_token;
    }

    public function getGroups() {
        $response = $this->client->get('/groups/');
        $return = $response->getBody();
//        $return = json_decode($return);
        return $return;

    }

    public function getUsers() {
        $response = $this->client->get('/users/');
        $return = $response->getBody();
//        $return = json_decode($return);
        return $return;
    }

    public function getMembersOfGroup($id) {
        $token = $this->getToken();
        $response = $this->client->get('/Groups/' . $id . '/Members?access_token=' . $token);

        $return = $response->getBody();
//        $return = json_decode($return);

        return $return;
    }

    public function getStatsById($id) {
        $token = $this->getToken();
        $users = $this->getUsers();

        $response = $this->client->get('/Users/' . $id . '/Stats?access_token=' . $token);

        $return = $response->getBody();
//        $return = json_decode($return);

        return $return;
    }

    public function getLastPosition($id) {
        $token = $this->getToken();

        $response = $this->client->get('/Users/' . $id . '/Records?access_token=' . $token);

        $return = $response->getBody();
//        $return = end($return);
        $return = json_decode($return);
        return json_encode(end($return));
    }

    // work in progress
    public function getData() {

        $token = $this->getToken();
        $response = $this->client->get('/Users/' . $this->id  . '/Records?access_token=' . $token);

        $return = $response->getBody();
        $return = json_decode($return);
        return $return;
    }

}

$client = new Client(['base_uri' => BASE_URI]);
$cycle = new Cycle($client);

if ( isset($_GET['token']) && filter_var($_GET['token'], FILTER_VALIDATE_INT) )
{
    header('Content-Type: application/json');
    echo json_encode($cycle->getToken());
}


if (isset($_GET['groups']))
{
    echo $cycle->getGroups();
}

if (isset($_GET['users'])){
    echo $cycle->getUsers();
}

if (isset($_GET['membersofgroup'])) {
    echo $cycle->getMembersOfGroup($_GET['membersofgroup']);
}

if (isset($_GET['stats'])) {
    echo $cycle->getStatsById($_GET['stats']);
}

if (isset($_GET['getpositionfrom']))
{
    echo $cycle->getLastPosition($_GET['getpositionfrom']);
}


