<?php
class SchoolMenuModel extends RelationModel{
 protected $_link = array(

 'SchoolMenu'=> array(  

                    'mapping_type'=>HAS_MANY,

                    'class_name'=>'SchoolMenu',

                    'foreign_key'=>'pid',

                    'mapping_name'=>'class',
					
					'parent_key'=>'pid',


                  // 定义更多的关联属性

                  ),
);
}
?>