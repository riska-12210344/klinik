<?php

use CodeIgniter\Email\Email;
use CodeIgniter\Test\CIUnitTestCase;
use config\Email as configEmail;

/**
 * @internal
 */
class EmailTest extends CIUnitTestCase{

    public function testKirimEmail(){
        $email = new Email( new configEmail);
        $email ->setFrom('imanuelheronimus76@gmail.com');
        $email->setTo('velisadavid3@gmail.com');
        $email->setSubject('Testing kirim Email');
        $email->setMessage('Hallo selamat <b>bergabung</b>');

        $this->assertTrue( $email->send() );
    }

}