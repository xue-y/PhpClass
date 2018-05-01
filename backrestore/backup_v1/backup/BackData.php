<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 18-4-27
 * Time: 下午2:05
 * 备份数据调用
 */
namespace backup;
use backup\PdoSql;
use backup\MySql;

 // 执行写入操作【备份】--- 可以写成class 的静态方法,但是感觉直接使用函数更便捷
function back_exec($host='127.0.0.1',$db,$dbuser='',$dbpw='',$table=array(),$charset='utf8',$prot=3306)
{
	 if(extension_loaded("pdo"))
	{
		include "PdoSql.php";
		$backup=new PdoSql($host,$db,$dbuser,$dbpw,$table,$charset,$prot);

	}else
	{
		include "MySql.php";
		$backup=new MySql($host,$db,$dbuser,$dbpw,$table,$charset,$prot);
	}
	// sql_insert 是父类下的方法
	$backup->sql_insert(); // 执行写入操作【备份】
}





   

