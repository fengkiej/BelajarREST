<?php
	$method = $_SERVER['REQUEST_METHOD'];
	
	//Establish connection to database
	$m = new MongoClient();
   	$db = $m->mDb;
	$collection = $db->userInfo;

	if($method == 'GET'){
		//Return Query
		header('Content-Type: application/json');

		$userDatas = $collection->find();
		$users = array();

		foreach($userDatas as $userDatas){
			array_push($users, array('user'=>$userDatas['user'], 'pass'=>$userDatas['pass']));
		}

		$return = array('users'=>$users, 'status'=>'200 OK');
		echo json_encode($return);
	} else {
		//Rejected
	}

?>