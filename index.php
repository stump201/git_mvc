<?php
	
	define("BASE_PATH", "http://mvc.albrowndesign.com");
	define("BASE_ROOT",'/home1/albrownd/public_html/gitmvc');
	define('DS', "/");
	
	if(file_exists(BASE_ROOT.DS."config".DS."config.php")) require(BASE_ROOT.DS."config".DS."config.php");
	else exit("This Site Has Not Been Configured Properly");
	
	if(file_exists(BASE_ROOT.DS.'library'.DS.'router.class.php')) include_once(BASE_ROOT.DS.'library'.DS.'router.class.php');
	else exit("This Site Has Not Been Configured Properly");
	
	$router = new router;
		
	$router->start();
	
	$router->load_required_files();
	
	$router->load_controller_files();
	
	$controllerformat = "controller_".$router->controller;

	if (method_exists($controllerformat, $router->model)) { 
		
		$model = $router->model;
		
		$controlnew = new $controllerformat($router->controller,$router->model,$router->view);
		
		$controlnew->$model();
		
		$router->get_exec_time(10);
		
		exit();
							
	} 	

	else {
	
		$modelformat = "model_".$router->controller;
		
		$controllerformat = "controller_".$router->controller;
		
		$model = "index";
		
		$controlnew = new $controllerformat($router->controller,$router->model,$router->view);
		
		$controlnew->$model();
		
		$router->get_exec_time(10);
		
		exit();
		
	}