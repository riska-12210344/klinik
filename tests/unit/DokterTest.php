<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
class DokterTest extends CIUnitTestCase{

    use FeatureTestTrait;

    public function testLogin(){
        $this->call('post', 'login', [
            'email' => 'gafriansyah12@gmail.com',
            'sandi' => '123456'
        ])->assertStatus(200);
    }

    public function testCreateShowUpdateDelete(){
        $json = $this->call('post', 'Dokter', [
            'nama' => 'Testing nama',
            'gender' => 'L',
            'email' => 'testing@email.com',
            'sandi' => 'testing'
        ])->getJSON();
        $js = json_decode($json, true);

        $this->assertTrue($js['id'] > 0);

        $this->call('get', "Dokter/".$js['id'])
             ->assertStatus(200);
        
        $this->call('patch', 'Dokter', [
            'nama' => 'Testing Dokter update',
            'gender' => 'L',
            'email' => 'testingupdate@email.com',
            'id' => $js['id']
        ])->assertStatus(200);

        $this->call('delete', 'Dokter', [
            'id' => $js['id']
        ])->assertStatus(200);

    }

    public function testRead(){
        $this->call('get', 'Dokter/all')
             ->assertStatus(200);
    }

    public function testLogout(){
        $this->call('delete', 'login')
             ->assertStatus(302);
    }
    
}
