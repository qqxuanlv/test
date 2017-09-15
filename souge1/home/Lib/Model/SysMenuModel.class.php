<?php
class SysMenuModel extends RelationModel{
    protected $_link=array(
                  'NewsSort'=> array(  

                    'mapping_type'=>HAS_MANY,

                    'class_name'=>'NewsSort',

                    'foreign_key'=>'pid',

                    'mapping_name'=>'class',

                  ),

  );
}