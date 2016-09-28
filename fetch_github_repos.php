<?php 
/*
* Include APIBase class to handle CURL requests for us
*/
include 'apibase.php';

class FetchGithubRepos extends APIBase{
  /*
  * Github search endpoint
  */
  private $__endpoint = 'https://api.github.com/search/repositories';
  private $__finalResponse = [];
  /*
  * Fetch all repos with a given language
  */
  public function fetchAllForLanguage(array $args){
    $query = array(
      'base_url' => $this->__endpoint,
      'url_params' => array(
        'q' => 'language:' . $args['language'],
        'per_page' => $args['results_per_page'],
        'page' => 0
      ), 
      'method' => 'GET',
      'user_agent' => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13'
    );
    $totalPages = $this->__getTotalPages(
      parent::_executeGetResponseHeaders($query)['headers']['Link']
    );
    while($query['url_params']['page'] <= $args['pages_to_return'] && $query['url_params']['page'] <= $totalPages){
      $response = parent::_execute($query);
      $query['url_params']['page'] += 1;
      $this->__finalResponse = array_merge($this->__finalResponse, $this->__formatResponse($response));
    }
    return array(
      'status_code' => 200,
      'payload' => $this->__finalResponse
    );
  }
  /*
  * Return a json response including only the data we care about
  */
  private function __formatResponse($responseData){
    $errorsFound = $this->__errorsPresent($responseData);
    if($errorsFound){
      return array(
        'error_message' => $errorsFound['message'], 
        'error_code' => $errorsFound['status_code']
      );
    } else{
      return array_map(function($repo){
        return array(
          'repository_id' => $repo['id'],
          'repository_short_name' => $repo['name'],
          'repository_full_name' => $repo['full_name'],
          'language' => $repo['language'],
          'url' => $repo['html_url']
        );
      }, $responseData['payload']['items']);
    }
  }
  /*
  * Check if the HTTP status code was anything but 200
  */
  private function __errorsPresent($responseData){
    if($responseData['status_code'] === 200){
      return false;
    } else{
      return array(
        'status_code' => $responseData['status_code'],
        'message' => 'Something went wrong. Please try again later.'
      );
    }
  }
  /*
  * Find out how many total pages of results there are by parsing the 
  * 'Link' response header 
  */
  private function __getTotalPages($headerValue){
    $withoutSpecialChars = str_replace(['>','<'], '', $headerValue);
    $url = explode(';', explode(',', $withoutSpecialChars)[1])[0];
    parse_str(parse_url($url)['query'], $params);
    return $params['page'];
  }
}
