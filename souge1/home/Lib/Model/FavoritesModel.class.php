<?php
class FavoritesModel extends RelationModel{
 public $_link = array(

 'Products'=> array(  

                    'mapping_type'=>BELONGS_TO,

                    'class_name'=>'Products',

                    'foreign_key'=>'productsid',

                    'mapping_name'=>'proinfo',
					

                  // 定义更多的关联属性

                  ),
);
}
?>