### php 数组数据与 xml cvs json 数据格式互转
	|--- otherArr 	cvs 转换中不保留 二维数组第一层循环的 key 值，第二层循环的key为一致的
	|--- otherArr2  cvs数据中保留二维数组第一层循环的 key 值
	|--- otherArr3  cvs 转换中 支持三维数组，三维数组第一层数组key保留，第二层第三层 变成索引数组
	数组转为cvs 时 设置了转码，为ANSI ,防止使用excel 中文打开乱码问题
