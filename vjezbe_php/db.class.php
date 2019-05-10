<?php
class DB {
  private static $db = null;

  final private function __construct() { }
  final private function __clone() {}

  public static function getConnection()
  {
    if(DB::$db === null)
    {
      try
      {
        DB::$db = new PDO('mysql:host=rp2.studenti.math.hr;dbname=knezic;charset=utf8','student','pass.mysql');
        DB::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        DB::$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
      }catch( PDOException $e ) { exit( 'PDO Error: ' . $e->getMessage() ); }

    return DB::$db;
  }

  }
};
?>
