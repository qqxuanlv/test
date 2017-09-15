<?php
class ProductsModel extends RelationModel{

		protected $_link = array(
		
		'Property'=> array(  
			'mapping_type'=>HAS_MANY,
			'class_name'=>'ProductProperty',
			'mapping_name'=>'Property',
			'foreign_key'=>'productsid',
			

		),
		'Attphoto'=> array(  
			'mapping_type'=>HAS_MANY,
			'class_name'=>'ProductsAttphoto',
			'mapping_name'=>'Attphoto',
			'foreign_key'=>'productsid',
			

		),
		//优化套装
        'Youhua'=>array(
            'mapping_type'=>HAS_MANY,//HAS_ONE查询出一条
            'class_name'=>'ProductYouhui',
            'mapping_name'=>'Youhua',
            'foreign_key'=>'proid',
    		//'mapping_fields'=>'id,baoyangid,name,price',

    
        ),
		
		

//        'TestSmall'=>array(
//            'mapping_type'=>HAS_MANY,//HAS_ONE查询出一条
//            'class_name'=>'TestSmall',
//            'mapping_name'=>'small',
//            'foreign_key'=>'pid',
//            'mapping_fields'=>array('id','id','title'),
//            'as_fields'=>'title,id:goodid',
//            //'condition'=>'',//筛选条件
//            //'foreign_key'=>'',//外键
//            //'mapping_fields'=>'',//关联字段
//            //as_fields
//        ),   

		
		

);
	

}