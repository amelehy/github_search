<?php 
/*
* Configuration values
*/
$pagesToReturn = 2;
$resultsPerPage = 10;
/*
* Set return content type to JSON because we're only responding with JSON data
*/
header('Content-Type: application/json');
/*
* Include the FetchGithubRepos class
*/
include 'fetch_github_repos.php';
/*
* Handle initial request
*/
if(!$_GET['languages']){
  echo json_encode(array(
    'status_code' => 500, 
    'message' => 'Please pass a "languages" parameter'
  ));
} else{
  initRepoSearch(); 
}
/*
* Initialize the repo search based on languages requested
*/
function initRepoSearch(){
  try{
    $languages = explode(';', $_GET['languages']);
    $finalData = [];
    $FetchGithubRepos = new FetchGithubRepos();
    foreach ($languages as $language) {
      $response = $FetchGithubRepos->fetchAllForLanguage(array(
        'language' => $language,
        'pages_to_return' => $pagesToReturn,
        'results_per_page' => $resultsPerPage
      ));
      $finalData = array_merge($finalData, $response['payload']);
    }
    echo json_encode(array(
      'status_code' => $response['status_code'],
      'payload' => $response['payload']
    ));
  } catch(Exception $e){
    echo json_encode(array(
      'status_code' => 500, 
      'message' => 'Excpetion: ' . $e->getMessage()
    ));
  }
}
