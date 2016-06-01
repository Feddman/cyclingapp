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

class Cycle {

    private $client;
    private $id;

    public function __construct($client) {

        $this->client = $client;

    }

    private function getToken() {
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

    public function getUsers() {

    }

    public function getData() {
        $token = $this->getToken();
        $response = $this->client->get('/Users/' . $this->id  . '/Records?access_token=' . $token);

        $return = $response->getBody();
        $return = json_decode($return);

        return $return;
    }

    public function addUser($username, $password) {
        $token = $this->getToken();

        $dataToSend = [
            'Access_token'  => $token,
            'username'      => 'Pietje Pannenkoek',
            'password'      => 'Safestpasswordever'
        ];

        $response = $this->client->post('Users', [
           'json' => $dataToSend
        ]);
        $code = $response->getStatusCode();
        $result = $response->json();
        return [
            'code' => $code,
            'result' => $result
        ];
    }

}

$client = new Client(['base_uri' => BASE_URI]);
$cycle = new Cycle($client);

if ( isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT) )
{
    header('Content-Type: application/json');
    echo json_encode($cycle->getUsers());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $data = file_get_contents("php://input");
    $post = get_object_vars(json_decode($data));
    if (isset($post['password']) && isset($post['username']))
    {
        $cycle->addUser($post['password'], $post['username']);
    }
}




