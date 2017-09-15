<?php 
                              //用于保存分页信息的类
    
    class FenyePage{
        public $pageSize=6;
        public $res_array ;             //需要显示的数据
        public $rowCount;               //总记录数  从数据库中获取
        public $pageNow;                //用户指定的当前页
        public $pageCount;              //总页数  计算出来的
        public $navigate;               //分页导航条
    }

?>