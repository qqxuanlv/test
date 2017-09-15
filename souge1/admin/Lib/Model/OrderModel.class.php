<?php
class OrderModel extends RelationModel{
	
    protected $_link=array(
        'OrderCart'=>array(
            'mapping_type'=>HAS_MANY,//HAS_ONE查询出一条
            'class_name'=>'OrderCart',
            'mapping_name'=>'Ordercart',
            'foreign_key'=>'orderid',
        ),

       'FahuoInfo'=>array(
            'mapping_type'=>HAS_ONE,//HAS_ONE查询出一条
            'class_name'=>'FahuoInfo',
            'mapping_name'=>'Fahuoinfo',
            'foreign_key'=>'orderid',
        	'as_fields'=>'id:fahuoid',
        ),
        
        'BasicPayment'=>array(
            'mapping_type'=>HAS_ONE,//HAS_ONE查询出一条
            'class_name'=>'BasicPayment',
            'mapping_name'=>'BasicPayment',
            'foreign_key'=>'payment',
        	//'as_fields'=>'title:payment_title',
        ),
        
        

    );
    
}