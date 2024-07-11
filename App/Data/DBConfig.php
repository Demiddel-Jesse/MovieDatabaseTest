<?php
//data/DBConfig.php

namespace api\Data;

class DBConfig
{
  public $url;
  public $port;
  public $user;
  public $password;
  public $host;
  public $db;

  public function __construct() {
    $this->url = $_ENV['POSTGRES_URL'];
    $this->port = 5432;
    $this->user = $_ENV['POSTGRES_USER'];
    $this->password = $_ENV['POSTGRES_PASSWORD'];
    $this->host = $_ENV['POSTGRES_HOST'];
    $this->db = $_ENV['POSTGRES_DATABASE'];
  }

  function getConnectionString():string{
    return "pgsql:host=" . $this->host . " port=" . $this->port . " dbname=" . $this->db;
  }

  public function getUser () :string{
    return $this->user;
  }

  public function getPassword () :string{
    return $this->password;
  }
}
