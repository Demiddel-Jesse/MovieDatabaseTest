<?php
//data/DBConfig.php

namespace api\Data;

class DBConfig
{
  function getConnectionString():string{
    return "host=" . $_ENV['PG_HOST'] . " port=" . $_ENV['PG_PORT'] . " dbname=" . $_ENV['PG_DB'] . " user=" . $_ENV['PG_USER'] . " password=" . $_ENV['PG_PASSWORD'] . " options='endpoint=" . $_ENV['PG_ENDPOINT'] . "' sslmode=require";

  }
}
