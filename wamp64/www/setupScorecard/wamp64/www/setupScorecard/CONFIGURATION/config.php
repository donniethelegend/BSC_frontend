<?Php
final class Config {
    private static $data = null;
    private static $path = './CONFIGURATION/config.ini';
    public static function getConfig($section = null) {
        if ($section === null) {
            return self::getData();
        }
        $data = self::getData();
        if (!array_key_exists($section, $data)) {
            throw new Exception('Unknown config section: ' . $section);
        }
        return $data[$section];
    }
    private static function getData() {
        if (self::$data !== null) {
            return self::$data;
        }
        self::$data = parse_ini_file(self::$path, true);
        return self::$data;
    }
//this is the function going to update your ini file
  function update_ini_file($data) { 
    $content = ""; 
    foreach($data as $section=>$values){
      //append the section 
      $content .= "[".$section."]n"; 
      //append the values
      foreach($values as $key=>$value){
        $content .= $key."=".$value."n"; 
      }
    }
        //write it into file
    if (!$handle = fopen(self::$path, 'w')) { 
      return false; 
    }
    $success = fwrite($handle, $content);
    fclose($handle); 
    return $success; 
  }
}
?>
