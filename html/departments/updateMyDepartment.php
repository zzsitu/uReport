<?php
/**
 * @copyright 2011 City of Bloomington, Indiana
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.txt
 * @author Cliff Ingham <inghamn@bloomington.in.gov>, W Sibo <sibow@bloomington.in.gov>
 */
$department = $_SESSION['USER']->getDepartment();
$return_url = isset($_REQUEST['return_url']) ? $_REQUEST['return_url'] : BASE_URL;

if (isset($_POST['defaultPerson'])) {
	$department->setName($_POST['name']);
	$department->setDefaultPerson($_POST['defaultPerson']);

	try {
		$department->setCustomStatuses($_POST['customStatuses']);
		$department->setCategories(array_keys($_POST['categories']));
		$department->setActions(array_keys($_POST['actions']));
		$department->save();
		header('Location: '.$return_url);
		exit();
	}
	catch (Exception $e) {
		$_SESSION['errorMessages'][] = $e;
	}
}

$template = new Template('two-column');
$template->blocks[] = new Block(
	'departments/updateDepartmentForm.inc',
	array('department'=>$department,'return_url'=>$return_url)
);
echo $template->render();
