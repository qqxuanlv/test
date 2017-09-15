<?php


class TestBigModel extends RelationModel{
    protected $_link=array(
        'TestSmall'=>array(
            'mapping_type'=>HAS_MANY,//HAS_ONE查询出一条
            'class_name'=>'TestSmall',
            'mapping_name'=>'small',
            'foreign_key'=>'pid',
            'mapping_fields'=>array('id','id','title'),
            'as_fields'=>'title,id:goodid',
            //'condition'=>'',//筛选条件
            //'foreign_key'=>'',//外键
            //'mapping_fields'=>'',//关联字段
            //as_fields
        ),   
    );
}

