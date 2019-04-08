<?php
class DB {
  private static $db = null;

  final private function __construct() { }
  final private function __clone() {}

  public static function getConnection()
  {
    if(DB::$db === null)
    {
      $db = new PDO('mysql:host=rp2.studenti.math.hr;dbname=knezic;charset=utf8',
      'student','pass.mysql');
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    }

    return DB::$db;
  }

}
?>
