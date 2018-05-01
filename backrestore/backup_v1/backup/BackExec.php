<?php
/**
*备份 函数 调用 
*/
namespace backup;
include "BackData.php";

//$table_name=["dede_archives"];  // php 5.4+
$table_name=array("ba_admin"); // php 5.4-
back_exec('127.0.0.1','medf','root','123');

// exit; // 结束脚本