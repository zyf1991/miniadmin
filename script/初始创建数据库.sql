/*创建数据库 miniprogram*/
CREATE DATABASE miniprogram;
/*创建客户表*/
CREATE table f_custom(
    id int(10) unsigned not null auto_increment comment '主键',
    name varchar(255) comment '名字',
    wxname varchar(255) comment '微信名字',
    sex tinyint(1) comment '性别 0未知,1女，2男',
    age int(3) comment '年龄',
    cardId char(18)  comment '身份证号',
    birth date comment '出身年月日',
    tag varchar(255) comment '标签json格式',
    create_time datetime comment '表创建时间',
    update_time datetime comment '表更新时间',
    primary key (`id`),
    unique key (`cardId`)
)ENGINE=InnoDB CHARSET UTF8;
/*创建客户计划表*/
CREATE table f_plan(
    id int(10) unsigned not null auto_increment comment '主键',
    c_id int(10) unsigned not null comment '客户id',
    plan_title varchar(255) comment '计划标题',
    plan_desc varchar(255) comment '计划描述',
    plan_stime datetime comment '计划创建时间',
    plan_etime datetime comment '计划结束时间',
    sys_etime  datetime comment '系统计算结束时间',
    create_time datetime comment '表时间',
    update_time datetime comment '表时间',
    plan_type tinyint(2) comment '计划类型',
    primary key (`id`),
    index (`c_id`)
)ENGINE=InnoDB CHARSET UTF8;
/*创建客户签到表*/
CREATE table f_sign(
    id int(10) unsigned not null auto_increment comment '主键',
    c_id int(10) unsigned not null comment '客户id',
    plan_id int(10) unsigned not null comment '计划id',
    sign_time datetime comment '签到时间',
    is_sign tinyint(1) comment '是否签到 0未签到 1签到',
    primary key (`id`),
    key `index_cid_plan_id`  (`c_id`,`plan_id`)
)ENGINE=InnoDB CHARSET UTF8;
/*创建客户签到表*/
CREATE table f_sign(
    id int(10) unsigned not null auto_increment comment '主键',
    c_id int(10) unsigned not null comment '客户id',
    plan_id int(10) unsigned not null comment '计划id',
    sign_time datetime comment '签到时间',
    is_sign tinyint(1) comment '是否签到 0未签到 1签到',
    primary key (`id`),
    key `index_cid_plan_id`  (`c_id`,`plan_id`)
)ENGINE=InnoDB CHARSET UTF8;
/*创建客户说说表*/
CREATE table f_saymood(
    id int(10) unsigned not null auto_increment comment '主键',
    c_id int(10) unsigned not null comment '客户id',
    type tinyint(1) comment '1图片 2文字',
    release_time datetime comment '发布时间',
    is_del tinyint(1) comment '0未删除 1已删除',
    primary key (`id`),
    index (`c_id`)
)ENGINE=InnoDB CHARSET UTF8;
