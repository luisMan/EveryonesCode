
  <html><head><title>Setting up database</title></head><body>

<h3>Setting up...</h3>
<?php
 // Example 21-3: setup.php
include_once 'function.php';

$object->createTable('messages', 
            'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            auth VARCHAR(16),
            recip VARCHAR(16),
            pm CHAR(1),
            time INT UNSIGNED,
            message VARCHAR(4096),
            INDEX(auth(6)),
            INDEX(recip(6))');

$object->createTable('members',
            'user VARCHAR(16),
             pass VARCHAR(16),
              email VARCHAR(30),
             name VARCHAR(16),
             last VARCHAR(16),
             gender VARCHAR(16),
             area   VARCHAR(100),
             ON_OFF INT UNSIGNED,
            INDEX(user(6))');

$object->createTable('feeds', 
            'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            auth VARCHAR(16),
            recip VARCHAR(16),
            time INT UNSIGNED,
            message VARCHAR(4096),
            likes INT UNSIGNED,
            language VARCHAR(16),
            INDEX(auth(6)),
            INDEX(recip(6))');

$object->createTable('comments',
           'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            authPost  VARCHAR(16),
            time INT UNSIGNED,
            userPostin VARCHAR(16),
            comment VARCHAR(4096),
            likes INT UNSIGNED,
            INDEX (authPost(6))');

$object->createTable('friends',
            'user VARCHAR(16),
            friend VARCHAR(16),
            INDEX(user(6)),
            INDEX(friend(6))');
$object->createTable('followers',
            'user VARCHAR(16),
            follower VARCHAR(16),
            INDEX(user(6)),
            INDEX(follower(6))');
$object->createTable('fans',
            'user VARCHAR(16),
            fan VARCHAR(16),
            INDEX(user(6)),
            INDEX(fan(6))');


$object->createTable('profiles',
            'user VARCHAR(16),
            text VARCHAR(4096),
            college VARCHAR(40),
            major VARCHAR(40),
            birthdate VARCHAR(100),
            area  VARCHAR(100),
            mood VARCHAR(100),
            relationship VARCHAR(16),
            reputation INT UNSIGNED,
            INDEX(user(6))');

$object->createTable('chat',
            'chat_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
             posted_on DATETIME NOT NULL,
             user_name VARCHAR(255) NOT NULL,
             message VARCHAR(4096),
             color CHAR(7) default "#000000"'
           );

$object->createTable('userFeed',
            'user_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
             posted_on DATETIME NOT NULL,
             user_name VARCHAR(255) NOT NULL,
             message VARCHAR(4096)'
           );

$object->createTable('tutorials',
            'id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
             tutorialTitle VARCHAR(4096) NOT NULL,
             language VARCHAR(30) NOT NULL,
             userId INT(11),
             Url VARCHAR(4096),
             complete INT(11) UNSIGNED'
             ); 
?>
<br />...done.
</body></html>

?>