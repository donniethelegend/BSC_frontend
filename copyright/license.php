<?Php
final class Licenses {


    private static $data = null;


  
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
       
        self::$data = parse_ini_file('./copyright/EULA.ini', true);
        return self::$data;
    }

}
   function getMAC(){


 ob_start(); // Turn on output buffering
 system('ipconfig /all'); //Execute external program to display output
 $mycom=ob_get_contents(); // Capture the output into a variable
 ob_clean(); // Clean (erase) the output buffer
 foreach(preg_split("/(\r?\n)/", $mycom) as $line){
  if(strstr($line, 'Physical Address'))
  {
   $Mac[]= substr($line,39,18);
  }
 }
 return $Mac[0];
}

if (session_id() == "") {
   session_start();
   header('Cache-control: private');
}

   if(!in_array(getMAC(), Licenses::getConfig("host_address"))){
 $lock = false   ;
   }
   else{
 $lock = true;
   }

?>
