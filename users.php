<?php
/*	$method = $_SERVER['REQUEST_METHOD'];
	$URI = $_SERVER['REQUEST_URI'];
	echo $URI;
	//Establish connection to database
	$m = new MongoClient();
   	$db = $m->mDb;
	$collection = $db->userInfo;

	switch($method){
		case "GET":
			//Return Query
			header('Content-Type: application/json');

			$userDatas = $collection->find();
			$users = array();

			foreach($userDatas as $userDatas){
				array_push($users, array('user'=>$userDatas['user'], 'pass'=>$userDatas['pass']));
			}

			http_response_code(200);
			$return = array('users'=>$users, 'status'=>'200 OK');
			echo json_encode($return);
			break;
		case "POST":
			//Add New Data
			header('Content-Type: application/json');

			$user = $_POST['user'];
			$pass = $_POST['pass'];

			$userData = array('user'=>$user, 
							'pass'=>$pass);

			$collection->insert($userData);

			http_response_code(201);
			$return = array('status'=>'201 Created');
			echo json_encode($return);
			break;
		case "PUT":
			break;
		/*case "DELETE":
			$user = $_DELETE['']
			$userObj = $collection->findOne(array("user"=>$user));
			$userPass = $userObj['pass'];

			if($pass==$userPass){
				$collection->remove(array('user'=>$user),array("justOne" => true));
		   		echo "user deleted successfully";
		   		header("Location: display.php");
		    	exit;
			} else {
				echo "password incorrect";
			}*/
			break;
	}
*/
?>