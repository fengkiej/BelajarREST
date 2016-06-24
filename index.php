<?php
	$method = $_SERVER['REQUEST_METHOD'];
	$URI = $_SERVER['REQUEST_URI'];
	$args = explode("/", $URI);
	//Establish connection to database
	$m = new MongoClient();
   	$db = $m->mDb;
	$collection = $db->userInfo;

	switch($method){
		case "GET":
			//Return Query
			header('Content-Type: application/json');
			$users = array();

			if($args[1] == 'users' && $args[2] == ''){
				$userDatas = $collection->find();

				foreach($userDatas as $userDatas){
					array_push($users, array('user'=>$userDatas['user'], 'pass'=>$userDatas['pass']));
				}

			} else if ($args[1] == 'users' && $args[2] != ''){
				$userDatas = $collection->findOne(array('user'=>$args[2]));
				array_push($users, array('user'=>$userDatas['user'], 'pass'=>$userDatas['pass']));
			}

			if($users[0]['user'] == NULL){
				http_response_code(404);
				$return = array('status'=>'404 Not found');
			} else {
				http_response_code(200);
				$return = array('users'=>$users, 'status'=>'200 OK');
			}

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
			header('Content-Type: application/json');
			parse_str(file_get_contents("php://input"), $_PUT);
			$user = $args[2];
			$pass = $_PUT['pass'];
			$npass = $_PUT['npass'];

			$userObj = $collection->findOne(array("user"=>$user));
			$userPass = $userObj["pass"];

			if($pass==$userPass){
				$collection->update(array("user"=>$user), 
		     		array('$set'=>array("pass"=>$npass)));
				http_response_code(200);
			} else {
				http_response_code(401);
			}

			break;
		case "DELETE":
			header('Content-Type: application/json');
			if($args[1] == "users"){
				$user = $args[2];
				$userObj = $collection->findOne(array("user"=>$user));
				$userPass = $userObj['pass'];

				$collection->remove(array('user'=>$user),array("justOne" => true));

				http_response_code(204);
				$return = array('status'=>'204 Deleted');

			   	echo json_encode($return);
		   	} else {
		   		//invalid command
		   	}
			break;
	}

?>