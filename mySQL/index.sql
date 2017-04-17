-- 一、原生MySQL语句
-- MySQL语句的规范：1.关键字与函数名称全部大写 2.数据库名称、表名称、字段名称全部小写 3.SQL语句必须以分号结尾';'
-- 修改MySQL提示符：PROMPT \u\h \d> == root@localhost (none)>
-- 创建数据库语法： CREATE {DATABASE | SCHEMA} [IF NOT EXISTS] db_name [DEFAULT] CHHARACTER SET [=] charset_name
-- 查看当前服务器下的数据库列表： SHOW {DATABASES | SCHEMAS} [LIKE 'pattern' | WHERE expr]
-- 删除数据库：DROP {DATABASE | SCHEMA} [IF EXISTS] db_name

-- 二、数据类型与操作数据表
-- 2.1 数据类型
-- 2.6 数据表
-- 创建数据表：CREATE TABLE [IF NOT EXISTS] table_name (column_name data_type, ...)
-- 选择数据表：USE DATABASE
-- 创建表格：CREATE TABLE tb1 (username VARCHAR(20), age TINYINT UNSIGNED, salary FLOAT(8, 2) UNSIGNED);
-- 查看表格：SHOW TABLES [FROM db_name] [LIKE 'pattern' | WHERE expr];
-- 查看数据表结构：SHOW COLUMNS FROM tbl_name;
-- 插入记录：INSERT [INTO] tbl_name [(col_name, ...)] VALUES (val, ...);
-- 记录查找：SELECT expr, ... FROM tbl_name;
-- 空值与非空值：NULL | NOT NULL
-- AUTO_INCREMENT: 自动编号，且必须与主键组合使用、默认情况下，起始值为1，每次的增量为1（必须与PRIMARY KEY一起使用）
-- PRIMARY KEY: 主键约束、每张数据表只能存在一个主键、主键保证记录的唯一性、主键自动为NOT NULL（不一定与AUTO_INCREMENT一起使用）
-- UNIQUE KEY: 唯一约束、唯一约束可以保证记录的唯一性、唯一约束的字段可以为空值（NULL）、每张数据表可以存在多个唯一约束（个人理解：一张数据表里不能存在与唯一约束相同的值）
-- DEFAULT: 默认值、当插入记录时，如果没有明确为字段赋值，则自动赋予默认值

-- 三、约束以及修改数据表
