<?php

use PHPUnit\Framework\TestCase;

define('ROOT_DIR', __DIR__);

use Dykyi\Common\Config;

class DBTest extends TestCase
{
    private $dbConfig = [];

    public function __construct()
    {
        $dotenv = new \Dotenv\Dotenv(__DIR__);
        $dotenv->load();

        parent::__construct();
    }

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->dbConfig = [
            'mysql' => [
                'host'     => ('DB_HOST'),
                'db'       => Config::env('DB_DATABASE'),
                'user'     => Config::env('DB_USERNAME'),
                'password' => Config::env('DB_PASSWORD'),
            ]
        ];
    }

    public function testEnv()
    {
        $this->assertEquals($_ENV['DB'], 'mysql');
        $this->assertEquals(\Dykyi\Common\Config::env('DB'),'mysql');
    }

    public function testDBConnection()
    {

        $db = \Dykyi\Common\Database::getInstance($this->dbConfig);
        $this->assertInstanceOf(PDO::class, $db);
    }

}
