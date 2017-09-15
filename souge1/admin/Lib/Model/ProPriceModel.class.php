<?php
class ProPriceModel extends RelationModel{
	
    protected $_link=array(


        
        'ProPriceCalled'=>array(
            'mapping_type'=>BELONGS_TO,//HAS_ONE查询出一条
            'class_name'=>'ProPriceCalled',
            'mapping_name'=>'ProPriceCalled',
            'foreign_key'=>'callid',
    		'as_fields'=>'called:sortname',

    
        ),
        


    );
    
}