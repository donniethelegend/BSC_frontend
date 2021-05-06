


    <?php 
       function getMAC()
{
 /*
  * Getting MAC Address of the host using PHP
  * Md. Nazmul Basher
  * Modified by Junaid Qadir Baloch
  * Now this function gets all the MAC addresses attached to the system
  * on which this function is called in an array and returns.

  */

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



final class readMac {


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

if(isset($_POST['mac'])&&isset($_POST['submit'])){
$cc =  readMac::getConfig('host_address');

$len = sizeof($cc);

$contents = file_get_contents("./copyright/EULA.ini");
$contents.=    PHP_EOL .($len+1).'="'.$_POST['mac'].'" ';

$fh = fopen("./copyright/EULA.ini", "w");

fwrite($fh, $contents);



  ob_clean();

     
header('location:index.php');
}
else{
   ?>

<html>
    <header>
        <title>
            Installer 
        </title>
    </header>
    <body>
        <form align=center action='installer.php' method='post'>
<textarea style='max-width:800px; min-width:800px; max-height:1300px; min-height:1300px; border:none'>
End-User License Agreement for e-Procurement Web Application

This End-User License Agreement (EULA) is a legal agreement between you (either an individual or a single entity) and the mentioned author of this Software for the software product identified above, which includes computer software and may include associated media, printed materials, and online or electronic documentation (WEB APPLICATION).

By installing, copying, or otherwise using the WEB APPLICATION, you agree to be bounded by the terms of this EULA.
If you do not agree to the terms of this EULA, do not install or use the WEB APPLICATION.

WEB APPLICATION LICENSE

1. GRANT OF LICENSE. This EULA grants you the following rights: Installation and Use. You may install and use an unlimited number of copies of the WEB APPLICATION.

Reproduction and Distribution. You may reproduce and distribute an unlimited number of copies of the WEB APPLICATION; provided that each copy shall be a true and complete copy, including all copyright and trademark notices, and shall be accompanied by a copy of this EULA.

Copies of the WEB APPLICATION may be distributed as a standalone product or included with your own product as long as The WEB APPLICATION is not sold or included in a product or package that intends to receive benefits through the inclusion of the WEB APPLICATION.

The WEB APPLICATION may be included in any free or non-profit packages or products.

2. DESCRIPTION OF OTHER RIGHTS AND LIMITATIONS.
Limitations on Reverse Engineering, Decompilation, Disassembly and change (add,delete or modify) the resources in the compiled the assembly. You may not reverse engineer, decompile, or disassemble the WEB APPLICATION, except and only to the extent that such activity is expressly permitted by applicable law notwithstanding this limitation.

Update and Maintenance
e-Procurement Web Application upgrades are FREE of charge.

Separation of Components.
The WEB APPLICATION is licensed as a single product. Its component parts may not be separated for use on more than one computer.

Software Transfer.
You may permanently transfer all of your rights under this EULA, provided the recipient agrees to the terms of this EULA.

Termination.
Without prejudice to any other rights, the Author of this Software may terminate this EULA if you fail to comply with the terms and conditions of this EULA. In such event, you must destroy all copies of the WEB APPLICATION and all of its component parts.

3. COPYRIGHT.
All title and copyrights in and to the WEB APPLICATION (including but not limited to any images, photographs, clipart, libraries, and examples incorporated into the WEB APPLICATION), the accompanying printed materials, and any copies of the WEB APPLICATION are owned by the Author of this Software. The WEB APPLICATION is protected by copyright laws and international treaty provisions. Therefore, you must treat the WEB APPLICATION like any other copyrighted material. The licensed users or licensed company can use all functions, example, templates, clipart, libraries and symbols in the WEB APPLICATION to create new diagrams and distribute the diagrams.

LIMITED WARRANTY

NO WARRANTIES.
The Author of this Software expressly disclaims any warranty for the WEB APPLICATION. The WEB APPLICATION and any related documentation is provided “as is” without warranty of any kind, either express or implied, including, without limitation, the implied warranties or merchantability, fitness for a particular purpose, or noninfringement. The entire risk arising out of use or performance of the WEB APPLICATION remains with you.

NO LIABILITY FOR DAMAGES.
In no event shall the author of this Software be liable for any special, consequential, incidental or indirect damages whatsoever (including, without limitation, damages for loss of business profits, business interruption, loss of business information, or any other pecuniary loss) arising out of the use of or inability to use this product, even if the Author of this Software is aware of the possibility of such damages and known defects.</textarea>
        <br/>
        <label> 
<input required name=agree type='checkbox'/> AGREE

<br/>
<input style='display:none' value='<?php echo getMAC(); ?>' name="mac" /> 
<input type="submit" value="submit" name="submit"/>
</form>
    </body>
    
</html>
<?php
    
}



?>