<?php 
/**还原调用函数
*/

namespace import;
use import\ImportData;

include "ImportData.php"; 

$import=new ImportData();
$import->import_exec("medf",'127.0.0.1','test','root','123');
// exit; // 结束脚本