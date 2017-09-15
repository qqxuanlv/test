<?php
class MemberAddressModel extends RelationModel{
 protected $_link = array(

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