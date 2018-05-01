<?php
/** 还原数据调用
*/
namespace import;
use import\PdoSql;
use import\MySql;

class ImportData{
	
	protected $import;

	// 执行还原
	public function import_exec($back_name,$host='127.0.0.1',$db,$dbuser='',$dbpw='',$charset='utf8',$prot=3306,$is_del=true)
	{
		if(!extension_loaded("pdo"))
		{
			include "PdoSql.php";
			$this->import=new PdoSql($back_name,$host,$db,$dbuser,$dbpw,$charset,$prot,$is_del);
	
		}else
		{
			include "MySql.php";
			$this->import=new MySql($back_name,$host,$db,$dbuser,$dbpw,$charset,$prot,$is_del);
		}
		// sql_insert 是父类下的方法
		$this->sql_insert(); // 执行写入操作【备份】
	}
	
	
    /**需要还原的数据库表名如果与原数据库中的表名一致，更改原表名为 temp_表名，用于还原失败的时候还原回去【还原到没有执行还原之前的数据】
     * @parem $old_table取得现在数据库中的所有表名
     * @parem $new_table 取得要还原的数据表名
     * @return 更改后的临时表名
     * */
    protected function temp_table($old_table,$new_table)
    {
        // 取得相同的名称修改成临时名称
        if(empty($old_table))
        {
            return  false;
        }
        $temp_table=array_intersect($old_table,$new_table);
        if(empty($temp_table))
        {
            return  false;
        }
        $rename="";
        foreach($temp_table as $k=>$v)
        {
            $rename.="`".$v.'` to `temp_'.$v."`,";
            $temp_table2[]="temp_".$v;
        }
        $this->import->temp_table_exec($rename); 
        return $temp_table2;
    }
	
	    // 执行还原数据
    protected function sql_insert()
    {
        // echo "开始还原";
		
        $is_files=$this->import->is_files(); //判断要还原的是一卷 还是多卷

        $table_fu=$this->import->table_fu(); // sql 文件表与表之间的分割符

        $table_name=$this->import->table_name();   // 取得这次插入的表名
        $all_table=$this->import->old_table(); // 取得数据库中的所有表名

        $temp_table=$this->temp_table($all_table,$table_name); // 取得数据库中的原表名的临时表名
		//$temp_table=false;  // 如果不批量从新命名还原时间可以减少1/3--1/4 
		
        if(intval($is_files[1])===0)
        {
			
            // 只有一卷
            $first_file=$this->import->back_name.$this->import->back_file_fu."0.sql";;
            $fileCont = file_get_contents($this->import->back_dir.$first_file);
            $sql_arr=explode($table_fu,$fileCont); //如果每个分卷小于 2MB 可以去掉分割成数组 foreach 循环 PdoSql.php 80行
            // 去除备份文件头标识
            array_splice($sql_arr,0,1);
            // 执行还原
			
            $this->import->sql_exec($sql_arr,$table_name,$temp_table);

        }else{
            // 多卷
            $back_files=$this->import->read_backdir();

            foreach($back_files as $f_k=>$f_v)
            {
                $first_file=$this->import->back_name.$this->import->back_file_fu.$f_v.".sql";
                $fileCont = file_get_contents($this->import->back_dir.$first_file);
                $fileCont=explode($table_fu,$fileCont);  //如果每个分卷小于 2MB 可以去掉分割成数组 foreach 循环 PdoSql.php 80行

               /* if($f_v==1)
                {
                    array_splice($sql_arr,0,1); // 去除备份文件头标识
                }*/
                //执行还原
                $this->import->sql_exec($fileCont,$table_name,$temp_table);
            }
        }
	

        // 还原成功后删除 原数据临时表--如果存在临时表
       if($temp_table)
        {
            $this->import->del_temp_table($temp_table);
        }
        // 执行删除备份文件
        if($this->import->del_file)
        {
            $this->import->del_back_files();
        }
        echo("还原成功"); //  还原成功
    }
}
