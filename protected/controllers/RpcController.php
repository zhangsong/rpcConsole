<?php

class RpcController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	
		//执行接口
	public function actionApiRun()
	{
		$pro = $_POST['pro'];//产品
		$api = $_POST['apis'];//产品
		
		$data = array(
			'bbs'=>array(
				'getab'=>array(
					'val1'=>array(
						'type'=>'int',
						'default'=>'12',
					),
					'val2'=>array(
						'type'=>'int',
						'default'=>'12',
					),
					'val23'=>array(
						'type'=>'array',
						'default'=>'array(3,4,5,6)',
					),
				
				),
				'getab1'=>'参数2',
				'getab2'=>'参数3',
				'getab3'=>'参数4',
			
			),
		
		
		);
		
		foreach($data[$pro][$api] as $key=>$value) {
		
			if ($value['type']=='array') {
				$exec_str = '$' .$key. '=' .$_POST[$key]. ';';
			} else {
				$exec_str = '$' .$key. '="' .$_POST[$key]. '";';
			}
		
			eval($exec_str);
		
		}
		
		
		
		
		echo '<pre>';
		var_dump( $val23);
		echo '</pre>';
//var_dump($_POST);
		
	}
	
	
	//获得接口
	public function actionGetApi()
	{
		$pro = $_GET['pro'];//产品
		
		$data = array(
			'bbs'=>array(
				'getab'=>'ddd1',
				'getab1'=>'ddd2',
				'getab2'=>'ddd3',
				'getab3'=>'ddd4',
			
			),
		
		
		);
		if ($pro) {
			echo json_encode($data[$pro]);
		}
		
	}
	
	
	
	//获得参数
	public function actionGetApiArg()
	{
		$pro = $_GET['pro'];//产品
		$api = $_GET['apis'];//产品
		
		$data = array(
			'bbs'=>array(
				'getab'=>array(
					'val1'=>array(
						'type'=>'int',
						'default'=>'12',
					),
					'val2'=>array(
						'type'=>'int',
						'default'=>'12',
					),
					'val23'=>array(
						'type'=>'array',
						'default'=>'array(3,4,5,6)',
					),
				
				),
				'getab1'=>'参数2',
				'getab2'=>'参数3',
				'getab3'=>'参数4',
			
			),
		
		
		);
		if ($pro) {
			echo json_encode($data[$pro][$api]);
		}
		
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}