<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->post('/api/users/new', function(Request $req, Response $res) {
    $db = $this->get('db'); // get the db


    // Get data from request
    $username = $req->getParam('username');
    $email = $req->getParam('email');
    $phone = $req->getParam('phone');
    
    // Password Encription
    $options = [
        'cost' => 11,
        'salt' => bin2hex(random_bytes(12))
    ];
    $password = password_hash($req->getParam('password'), PASSWORD_BCRYPT, $options);
    
    // Create the data
    $newUser = Array (
            "username" => $username,
            "password" => $password,
            "email" => $email,
            "phone" => $phone,
        );

    // Insert data, the insert function will return id if success
    $id = $db->insert('users', $newUser);

    // Check if data is saved!
    if($id)
        $newUser['id'] = $id;

        $msg = array(
                'success' => true, 
                'message' => 'User created!',
                'user' => $newUser
            );
        
        $newRes = $res->withJson($msg);
        // echo 'user was created. Id=' . $id;
        return $newRes;

    echo 'db error ' . $id;
});
