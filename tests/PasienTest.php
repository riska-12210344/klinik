<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
class PasienTest extends CIUnitTestCase{

    use FeatureTestTrait;

    public function testLogin(){
        $this->call('post', 'login', [
            'eamil' => 'imanuelhero76@gmail.com',
            'sandi' => 'jakman 77778888'
        ])->assertStatus(200);
    }

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'Pasien', [
            'nama' => 'Testing nama',
            'gender' => 'L',
            'email' => 'testing@email.com',
            'sandi' => 'testing'
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id'] > 0);

        $this->call('get', "Pasien/".$js['id'])
             ->assertStatus(200);

        $this->call ('patch', 'Pasien', [
            'nama' => 'Testing Pasien update',
            'gender' => 'L',
            'email' => 'testingupdate@email.com',
            'id' => $js['id']
        ])->assertStatus(200);       
        
        $this->call('delete', 'Pasien', [
            'id' => $js['id']
        ])->assertStatus(200);
    }

    public function testRead(){
        $this->call('get', 'Pasien/all')
             ->assertStatus(200);
    }  
    
    public function testLogout(){
        $this->call('delet', 'login')
             ->assertStatus(302);
    }

 }
