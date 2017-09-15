// JavaScript Document
$.fn.ThreeSelect = function(id1,id2,id3){
 var _self = this;
 
 //default values
 _self.data("select_1",["---请选择---", ""]);
 _self.data("select_2",["全部", ""]);
 _self.data("select_3",["全部", ""]);
 
 //insert 3 empty select
 _self.append("<select></select>");
 _self.append("<select></select>");
 _self.append("<select></select>");
 
 //get values from select
 var $sel1 = _self.find("select").eq(0);
 var $sel2 = _self.find("select").eq(1);
 var $sel3 = _self.find("select").eq(2);
 
 // get default values
 var default_s1 = $(id1).attr("value");
 var default_s2 = $(id2).attr("value");
 var default_s3 = $(id3).attr("value");
 //default value from 1st select
 if(_self.data("select_1")){
  $sel1.append("<option value='"+_self.data("select_1")[1]+"'>"+_self.data("select_1")[0]+"</option>");
 }
 $.each( GP , function(index,data){
  $sel1.append("<option value='"+data[1]+"'>"+data[0]+"</option>");
 });
 
 //default value from 2nd select
 if(_self.data("select_2")){
  $sel2.append("<option value='"+_self.data("select_2")[1]+"'>"+_self.data("select_2")[0]+"</option>");
 }
 //default value from 3rd select
 if(_self.data("select_3")){
  $sel3.append("<option value='"+_self.data("select_3")[1]+"'>"+_self.data("select_3")[0]+"</option>");
 }
 
 $sel1.val(default_s1);
 
 //1st select control
 var index1 = "" ;
 $sel1.change(function(){
  //clear 2nd & 3rd select data
  $sel2[0].options.length=0;
  $sel3[0].options.length=0;
  index1 = this.selectedIndex;
  if(index1==0){
   if(_self.data("select_2")){
    $sel2.append("<option value='"+_self.data("select_2")[1]+"'>"+_self.data("select_2")[0]+"</option>");
   }
   if(_self.data("select_3")){
    $sel3.append("<option value='"+_self.data("select_3")[1]+"'>"+_self.data("select_3")[0]+"</option>");
   }
  }else{
   if(_self.data("select_2")){
    $sel2.append("<option value='"+_self.data("select_2")[1]+"'>"+_self.data("select_2")[0]+"</option>");
   }
   $.each( GT[index1-1] , function(index,data){
    $sel2.append("<option value='"+data[1]+"'>"+data[0]+"</option>");
   });
   
   if(_self.data("select_3")){
    $sel3.append("<option value='"+_self.data("select_3")[1]+"'>"+_self.data("select_3")[0]+"</option>");
   }
   $.each( GC[index1-1][0] , function(index,data){
    $sel3.append("<option value='"+data+"'>"+data+"</option>");
   });
  }
  $(id1).attr("value", this.value);
  $(id2).attr("value", "");
  $(id3).attr("value", "");
 }).change();
 
 //2nd select control
 $sel2.val(default_s2);
 var index2 = "" ;
 $sel2.change(function(){
  $sel3[0].options.length=0;
  index2 = this.selectedIndex;
  
  if(index2==0){
   if(_self.data("select_3")){
    $sel3.append("<option value='"+_self.data("select_3")[1]+"'>"+_self.data("select_3")[0]+"</option>");
   }
  }else{
   if(_self.data("select_3")){
    $sel3.append("<option value='"+_self.data("select_3")[1]+"'>"+_self.data("select_3")[0]+"</option>");
   }  
   $.each( GC[index1-1][index2-1] , function(index,data){
    $sel3.append("<option value='"+data+"'>"+data+"</option>");
   });
  }
  
  $(id2).attr("value", this.value);
  $(id3).attr("value", "");
 }).change();
 
 
 $sel3.val(default_s3);
 $sel3.change(function(){
  $(id3).attr("value", this.value);
 }).change();
 
 return _self;
};