<?php
class MemberModel extends RelationModel{
	
    protected $_link=array(


        
        'Sex'=>array(
            'mapping_type'=>BELONGS_TO,//HAS_ONE查询出一条
            'class_name'=>'BasicSex',
            'mapping_name'=>'Sex',
            'foreign_key'=>'sex',
    		'as_fields'=>'sexname',

    
        ),
		
        


    );
    
}