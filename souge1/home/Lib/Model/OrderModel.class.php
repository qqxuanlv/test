<?php
class OrderModel extends RelationModel{
 protected $_link = array(

 'OrderCart'=> array(  

            'mapping_type'=>HAS_MANY,//HAS_ONE查询出一条
            'class_name'=>'OrderCart',
            'mapping_name'=>'class',
            'foreign_key'=>'orderid',

                  // 定义更多的关联属性

                  ),
 'BasicProvince'=> array(  

                    'mapping_type'=>BELONGS_TO,

                    'class_name'=>'BasicProvince',

                    'foreign_key'=>'province_id',
					
                    'mapping_name'=>'province_name',
					
					'mapping_fields'=>'title',
					//'as_fields'=>'province_id',
					
                  // 定义更多的关联属性

                  ),
 'BasicCity'=> array(  

                    'mapping_type'=>BELONGS_TO,

                    'class_name'=>'BasicCity',

                    'foreign_key'=>'city_id',
					
                    'mapping_name'=>'city_name',
					
					'mapping_fields'=>'title',
					//'as_fields'=>'province_id',
					
                  // 定义更多的关联属性

                  ),
);
}
?>