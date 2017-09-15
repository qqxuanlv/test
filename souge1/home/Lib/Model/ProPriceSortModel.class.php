<?php
class ProPriceSortModel extends RelationModel{
 protected $_link = array(

 'ProPriceSort'=> array(  

                    'mapping_type'=>HAS_MANY,

                    'class_name'=>'ProPriceSort',

                    'foreign_key'=>'pid',

                    'mapping_name'=>'class',
					
					'parent_key'=>'pid',


                  // 定义更多的关联属性

                  ),
);
}
?>