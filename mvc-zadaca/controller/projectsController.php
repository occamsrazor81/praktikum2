<?php
session_start();
require_once __DIR__.'/../model/projectservice.class.php';

class ProjectsController
{

	public function index()
	{
		$ps = new ProjectService();

		$title = 'All projects';
		$idProjectList = $ps->getAllProjects();
		//trebamo jos izvuc ime za projectList

		$projectList = array();
		foreach ($idProjectList as $project )
		{
			$user = $ps->getUserById($project->id_user);
			if( $user === null )
					exit( 'There is no user with id = ' . $project->id_user );
			$projectList[] = array('id' => $project->id,'author' => $user->username,
			'title' => $project->title, 'status' => $project->status);


		}


		require_once __DIR__.'/../view/projects_index.php';
	}



  public function myProjects()
  {
    $ps = new ProjectService();

    $title = 'My projects';
  	$idProjectList = $ps->getMyProjects($_SESSION['id_user']);


		//trebamo jos izvuc ime za projectList

		$projectList = array();
		foreach ($idProjectList as $project )
		{
			$user = $ps->getUserById($project->id_user);
			if( $user === null )
					exit( 'There is no user with id = ' . $project->id_user );
			$projectList[] = array('id' => $project->id,'author' => $user->username,
			'title' => $project->title, 'status' => $project->status);


		}


    require_once __DIR__.'/../view/projects_index.php';
  }




	public function createNew()
	{
		$title ='Create new project';

		require_once __DIR__.'/../view/projects_newProject.php';
	}

	public function createNewProject()
	{
		$ps = new ProjectService();

		if(!isset($_SESSION['id_user']))
		{
			header('Location: index.php?rt=projects/newProject');
			exit();
		}

		$id_user = $_SESSION['id_user'];

		// if(!isset($_POST['projectName']) || !isset($_POST['projectDescription'])
		// || !isset($_POST['projectNumber'])
		// || !preg_match('/^[a-zA-Z0-9]+$/',$_POST['projectName'])
		// || !preg_match('/^[a-zA-Z0-9]+$/',$_POST['projectDescription']))
		// {
		// 	header('Location: index.php?rt=projects/newProject ');
		// 	exit();
		// }

		$projectName = $_POST['projectName'];
		$projectDescription = $_POST['projectDescription'];
		$projectNumber = (int)$_POST['projectNumber'];

		$ps->createProject($id_user,$projectName,$projectDescription,$projectNumber);

		header('Location: index.php?rt=projects/newProject');
		exit();

	}


	public function findProjectDetails()
	{
		$ps = new ProjectService();


		if(!isset($_POST['project_id']))
		{
			header('Location: index.php?rt=projects/newProject');
			exit();
		}

		$title = 'Project description';

		$project_id = (int)$_POST['project_id'];

		$targetProject = $ps->getProjectById($project_id);

		//sad imamo naslov, description
		//trebamo se dokopati authora i membera

		$author_id = $targetProject->id_user;
		$author = $ps->getUserById($author_id);
		$author_username = $author->username;

		//jos samo ostale members (iz zadnje tablice)

		$targetUsers = $ps->getUsersFromMembersByProjectId($project_id);

		$userNames = array();
		foreach($targetUsers as $tUser)
		{
			if($tUser->id != $author_id)
			$userNames[] = $tUser->username;

		}

		$projectDescriptionList = array('author' => $author_username,
		'title' => $targetProject->title, 'description' => $targetProject->abstract,
	'members' => $userNames);

	
		require_once __DIR__.'/../view/projects_showDescription.php';


	}






};

?>
