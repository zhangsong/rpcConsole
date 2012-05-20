<?php
$this->breadcrumbs=array(
	'Rpc',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>



<?php

$data = array(
	'0'=>'未选择',
	'blog'=>'博客',
	'bbs'=>'论坛',
	'ucenter'=>'ucenter',
	'home'=>'家园',
);

echo CHtml::dropDownList('pro', null, $data);


$data1 = array(
	'0'=>'open',
	'blog'=>'close',
	'bbs'=>'论坛',
	'ucenter'=>'ucenter',
	'home'=>'家园',
);

echo CHtml::listBox('apis', null, $data1);




$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
    'name'=>'city',
    'source'=>array('ac1', 'ac2', '汉字'),
    // additional javascript options for the autocomplete plugin
    'options'=>array(
        'minLength'=>'1',
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
));
?>
<div id="args">


</div>

<input type="button" id="run" value="执行" />

<div id="console"></div>
<script type="text/javascript">
	$(function(){
	
		//alert('d');
		
	var run_arg = {};
	

		$('#run').bind('click', function(){
			//alert(run_arg.length);
			$.each(run_arg, function(key, value){
			
				run_arg[key] = $("#arg_"+key).val();
				//alert(run_arg[key]);
			});
		
			run_arg.pro = $('#pro').val();
			run_arg.apis = $('#apis').val();
		
			$.ajax({
				type:'post',
				url:'/index.php?r=rpc/ApiRun',
				data:run_arg,
				dataType:'html',
				success:function(res){
				
					$('#console').html(res);
				}
			
			
			});
		
		});
	
		$('#apis option').live('click', function(){
		
			//alert('垃圾王五'+$(this).val());
			
			var outher = this;
			$.ajax({
				type:'get',
				url:'/index.php?r=rpc/getApiArg',
				data:{pro:$('#pro').val(),apis:$(outher).val()},
				dataType:'json',
				success:function(res){
					//alert(res);
					$('#args').append(res);
					$.each(res, function(key){
						run_arg[key]='2';
						//run_arg[98]='2';
						//alert(run_arg.length);
						createArgBox(this.type, this.default, key);
					
					});
					//alert(run_arg.length);
				}
			
			
			
			});
		});
		
		//制造参数框
		function createArgBox(type, defaultValue, key) {
		
			switch (type) {
				case 'string':
				case 'int':
					$('#args').append('<input type="text" id="arg_'+key+'" value="' +defaultValue+ '" />');
					break;
					
				case 'array':
					$('#args').append('<textarea id="arg_'+key+'">'+defaultValue+'</textarea>');
					break;
				default:break;
			
			}
		
		
		}
		
		
		$('#pro').bind('change', function(){
		
			var outher = $(this);
			
			$.ajax({
				type:'get',
				url:'/index.php?r=rpc/getApi',
				data:{'pro':$(this).val()},
				dataType:'json',
				success:function(res){
					
					$('#apis').html('');
					$.each(res, function(index, value){
						//alert("<option>" +index + "</option>");
						$('#apis').append('<option value="' +index+ '">' +value + "</option>");
					});
				}
			
			
			});
			//alert($(this).val());
		
		});
	
	});



</script>