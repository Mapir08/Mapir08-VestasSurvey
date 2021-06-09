<?php
class Database 
{
  public static $dbhost = 'localhost';
  public static $dbname = 'survey';
  public static $user = 'root';
  public static $pass = 'root';

  private static $connection = null;

  public static function connect()
  {
    if(self::$connection == null)
    {
      try
      {
        self::$connection = new PDO('mysql:host='.self::$dbhost.';dbname='.self::$dbname, self::$user, self::$pass);
      }
      catch(PDOException $e)
      {
          die($e->getMessage());
      }
    }
    return self::$connection;
  }

  public static function disconnect()
  {
      self::$connection = null;
  }
}
?>
