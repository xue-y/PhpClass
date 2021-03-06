### backup php 备份mysql  数据库
 > 当前操作用户对备份目录有创建删除权限 数据表有创建删除的权限

#### backup_v1 版本 
	|---> 缺点：子类与父类之间有互相调用有耦合
	|---> 优点：子类与父类中的函数属性都为 protected 类型
	|---> 使用函数调用

#### backup_v2 版本
	|---> 缺点：子类与父类中的函数属性调用调的地方都为 public 类型
	|---> 优点：父类没有调用子类方法
	|---> 使用类调用

#### 文件说明
	|---backup.php 调用父类【基类】
	|---PdoSql.php pdo类备份
	|---MySql.php  mysql类备份
	|---BackData.php 备份数据实例化类
	|---BackExec.php 执行调用文件

### import php 还原mysql  数据库
 > 当前操作用户对备份目录、日志目录有创建删除权限 数据表有创建删除的权限   
 > 还原数据库需放在  import/backup/ 目录下,还原文件名(按照备份文件名格式)文件名_自定义标识+数字第几卷.sql,例如 cms_v0.sql   
 > 如果数据还原失败，数据回滚到没有还原前   

**还原不是使用 备份类备份的 sql 数据需要注意4点**
<pre>
1： 备份文件名前缀+ 标示名+数字.sql 
	<数字>0代表只还原这一个，数字从1依次还原多个
  	标示名可以自定义 默认 $back_file_fu="_v";

2: 备份文件中要还原sql 文件标注表名 
	格式 -- ##* 表名|表名|表名 ##* --
	可以自定义格式  $import_table_fu=" ##* ";

3：要还原的数据表与表之间的分界符，与要还原的sql 文件表与表的格式一致
	< 防止sql 语句过大程序卡死 > 
	格式：
		$create_table=PHP_EOL;  
		$create_table.='-- '.str_repeat('--',30).PHP_EOL;  
		$create_table.=PHP_EOL;   
	函数 table_fu()

4：如果备份sql文件中表创建语句前没有删除表语句,原数据表又与sql文件中的表名相同,原表名将更名为【临时表名】；  
	函数 temp_table($old_table,$new_table) 不可注释省略；如果还原失败，数据会回滚到没有还原之前      
    使用phpmyAdmin（可能使用其他工具导出查看是否数据格式与 备份类数据格式一致，非常重要！！！）导出的sql    
</pre>

#### import_v1 版本 
	|---> 缺点：子类与父类之间有互相调用有耦合
	|---> 优点：子类与父类中的函数属性都为 protected 类型
	|---> 使用函数调用

#### import_v2 版本
	|---> 缺点：子类与父类中的函数属性调用调的地方都为 public 类型
	|---> 优点：父类没有调用子类方法
	|---> 使用类调用

#### 文件说明
	|---import.php 调用父类【基类】
	|---PdoSql.php pdo类还原
	|---MySql.php  mysql类还原
	|---BackData.php 还原数据实例化类
	|---BackExec.php 执行调用文件

### 个人简单测试
	本人测试时 456k 大小（单卷）文件 ，导出时间为1秒（使用的time()函数测试）;
	还原[import_v1]用时11--12秒,[import_v2] 用时14--18秒
	时间短的注释掉 原数据表命名 [import_v1] Import.php 247行
	时间短的注释掉 原数据表命名 [import_v2] ImportData.php 70行

	分卷小于2MB [import_v2]可以注释掉 ImportData.php 94、79行,PdoSql.php 80行修改，MySql.php 110行修改,执行时间测试有时缩短一秒,有时没有变化；

	如果是多卷[import_v1] 需要的时间14秒左右（文件24个），[import_v2] 用时15秒左右