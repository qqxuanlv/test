<?php
class NewsModel extends RelationModel{
	
    protected $_link=array(


        
        'Newssort'=>array(
            'mapping_type'=>BELONGS_TO,//HAS_ONE查询出一条
            'class_name'=>'NewsSort',
            'mapping_name'=>'Newssort',
            'foreign_key'=>'sortid',
    		'as_fields'=>'title:newssort',

    
        ),
        


    );
    
}