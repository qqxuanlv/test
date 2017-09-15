<?php
class MessageModel extends RelationModel{
	
    protected $_link=array(


        
        'Adduid'=>array(
            'mapping_type'=> BELONGS_TO,//HAS_ONE查询出一条
            'class_name'=>'Member',
            'mapping_name'=>'Au',
            'foreign_key'=>'add_uid',
    		'as_fields'=>'username:au',
    
        ),
		
        'Touid'=>array(
            'mapping_type'=> BELONGS_TO,//HAS_ONE查询出一条
            'class_name'=>'Member',
            'mapping_name'=>'to',
            'foreign_key'=>'to_uid',
    		'as_fields'=>'username:to',
    
        ),

        


    );


    
} 