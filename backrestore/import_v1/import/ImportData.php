<?php
/** 还原数据调用
*/
namespace import;
use import\PdoSql;
use import\MySql;

 // 执行还原数据操作--- 可以写成class 的静态方法,但是感觉直接使用函数更便捷
function import_exec($back_name,$host='127.0.0.1',$db,$dbuser='',$dbpw='',$charset='utf8',$prot=3306,$is_del=true)
{
	 if(extension_loaded("pdo"))
	{
		include "PdoSql.php";
		$backup=new PdoSql($back_name,$host,$db,$dbuser,$dbpw,$charset,$prot,$is_del);

	}else
	{
		include "MySql.php";
		$backup=new MySql($back_name,$host,$db,$dbuser,$dbpw,$charset,$prot,$is_del);
	}
	// sql_insert 是父类下的方法
	$backup->sql_insert(); // 执行写入操作【备份】
}
//import_exec("medf",'127.0.0.1','test','root','123');
