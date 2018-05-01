<?php
/**
* 备份调用
*/
namespace backup;
use backup\BackData;

include "BackData.php";

$back=new BackData();

//$table_name=["dede_archives"]; php 5.4+
$table_name=array("v9_admin_panel");//php 5.4-
$back->back_exec('127.0.0.1','medf','root','123');

// exit; // 结束脚本