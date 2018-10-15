<?php
/**
 * Created by PhpStorm.
 * User: c.perrotin
 * Date: 14/09/2018
 * Time: 12:28
 */

use Zend\I18n\Validator\Alnum;
use Zend\Validator\StringLength;
use Zend\Validator\ValidatorChain;


$username = 'ABCDFE';

// Create a validator chain and add validators to it
$chain = new ValidatorChain();
$chain->attach(
    new StringLength(['min' => 3, 'max' => 5]),
    true, // break chain on failure
    1
);
$chain->attach(
    new StringLength(['min' => 7, 'max' => 9]),
    true, // break chain on failure
    2     // higher priority!
);

// Validate the username
if ($chain->isValid($username)) {
    // username passed validation
    echo "Success";
} else {
    // username failed validation; print reasons
    foreach ($chain->getMessages() as $message) {
        echo "$message\n";
    }
}