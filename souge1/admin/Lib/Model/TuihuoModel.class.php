<?php
class TuihuoModel extends RelationModel{
	
    protected $_link=array(

        'Products'=>array(
		            'mapping_type'=>HAS_MANY,//HAS_ONE查询出一条
		            'class_name'=>'TuihuoProlist',
		            'mapping_name'=>'Products',
	    			//'parent_key'=>'areaid',
		            'foreign_key'=>'tuihuoid',
		    		
		),
        
        

    );
    
}