<?php
class BaoyangModel extends RelationModel{
	
    protected $_link=array(


        

        
        //优惠套装
        'Products'=>array(
            'mapping_type'=>HAS_MANY,//HAS_ONE查询出一条
            'class_name'=>'Products',
            'mapping_name'=>'Products',
            'foreign_key'=>'baoyangid',
    		'mapping_fields'=>'id,baoyangid,name,price,photo',

    
        ),
        
        'Sort'=>array(
            'mapping_type'=>BELONGS_TO,//HAS_ONE查询出一条
            'class_name'=>'ProductSort',
            'mapping_name'=>'Sort',
            'foreign_key'=>'sortid',
    		'as_fields'=>'title:sorttitle',

    
        ),

    );
    
}