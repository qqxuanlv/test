<?php
class NewsModel extends RelationModel{
 protected $_link = array(

 'NewsSort'=> array(  

                    'mapping_type'=>BELONGS_TO,

                    'class_name'=>'NewsSort',

                    'foreign_key'=>'sortid',

                    'mapping_name'=>'class',
					
					'mapping_fields'=>'title',
					
					'parent_key'=>'pid',
					


                  // 定义更多的关联属性

                  ),
);
}
?>