<?php
class ProductSxModel extends RelationModel{
 protected $_link = array(

 'ProductSx'=> array(  

                    'mapping_type'=>HAS_MANY,

                    'class_name'=>'ProductSx',

                    'foreign_key'=>'pid',

                    'mapping_name'=>'class',
					
					'parent_key'=>'pid',


                  // 定义更多的关联属性

                  ),
);
}
?>