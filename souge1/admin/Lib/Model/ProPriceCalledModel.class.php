<?php
class ProPriceCalledModel extends RelationModel{
	
    protected $_link=array(


        
        'ProPriceSort'=>array(
            'mapping_type'=>BELONGS_TO,//HAS_ONE查询出一条
            'class_name'=>'ProPriceSort',
            'mapping_name'=>'ProPriceSort',
            'foreign_key'=>'sortid',
    		'as_fields'=>'title:sortname',

    
        ),
        


    );
    
}