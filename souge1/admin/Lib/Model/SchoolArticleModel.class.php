<?php
class SchoolArticleModel extends RelationModel{
	
    protected $_link=array(


        
        'SchoolMenu'=>array(
            'mapping_type'=>BELONGS_TO,//HAS_ONE查询出一条
            'class_name'=>'SchoolMenu',
            'mapping_name'=>'Schoolmenu',
            'foreign_key'=>'sortid',
    		'as_fields'=>'title:newssort',

    
        ),
        


    );
    
}