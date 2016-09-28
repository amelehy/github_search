<?php 
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
  // echo '{"status_code":200,"payload":[{"repository_id":2325298,"repository_short_name":"linux","repository_full_name":"torvalds\/linux","language":"C","url":"https:\/\/github.com\/torvalds\/linux"},{"repository_id":156018,"repository_short_name":"redis","repository_full_name":"antirez\/redis","language":"C","url":"https:\/\/github.com\/antirez\/redis"},{"repository_id":10744183,"repository_short_name":"netdata","repository_full_name":"firehol\/netdata","language":"C","url":"https:\/\/github.com\/firehol\/netdata"},{"repository_id":36502,"repository_short_name":"git","repository_full_name":"git\/git","language":"C","url":"https:\/\/github.com\/git\/git"},{"repository_id":14807173,"repository_short_name":"How-to-Make-a-Computer-Operating-System","repository_full_name":"SamyPesse\/How-to-Make-a-Computer-Operating-System","language":"C","url":"https:\/\/github.com\/SamyPesse\/How-to-Make-a-Computer-Operating-System"},{"repository_id":1357796,"repository_short_name":"emscripten","repository_full_name":"kripken\/emscripten","language":"C","url":"https:\/\/github.com\/kripken\/emscripten"},{"repository_id":2810455,"repository_short_name":"the_silver_searcher","repository_full_name":"ggreer\/the_silver_searcher","language":"C","url":"https:\/\/github.com\/ggreer\/the_silver_searcher"},{"repository_id":1903522,"repository_short_name":"php-src","repository_full_name":"php\/php-src","language":"C","url":"https:\/\/github.com\/php\/php-src"},{"repository_id":3774328,"repository_short_name":"wrk","repository_full_name":"wg\/wrk","language":"C","url":"https:\/\/github.com\/wg\/wrk"},{"repository_id":15183485,"repository_short_name":"The-Art-Of-Programming-By-July","repository_full_name":"julycoding\/The-Art-Of-Programming-By-July","language":"C","url":"https:\/\/github.com\/julycoding\/The-Art-Of-Programming-By-July"},{"repository_id":2325298,"repository_short_name":"linux","repository_full_name":"torvalds\/linux","language":"C","url":"https:\/\/github.com\/torvalds\/linux"},{"repository_id":156018,"repository_short_name":"redis","repository_full_name":"antirez\/redis","language":"C","url":"https:\/\/github.com\/antirez\/redis"},{"repository_id":10744183,"repository_short_name":"netdata","repository_full_name":"firehol\/netdata","language":"C","url":"https:\/\/github.com\/firehol\/netdata"},{"repository_id":36502,"repository_short_name":"git","repository_full_name":"git\/git","language":"C","url":"https:\/\/github.com\/git\/git"},{"repository_id":14807173,"repository_short_name":"How-to-Make-a-Computer-Operating-System","repository_full_name":"SamyPesse\/How-to-Make-a-Computer-Operating-System","language":"C","url":"https:\/\/github.com\/SamyPesse\/How-to-Make-a-Computer-Operating-System"},{"repository_id":1357796,"repository_short_name":"emscripten","repository_full_name":"kripken\/emscripten","language":"C","url":"https:\/\/github.com\/kripken\/emscripten"},{"repository_id":2810455,"repository_short_name":"the_silver_searcher","repository_full_name":"ggreer\/the_silver_searcher","language":"C","url":"https:\/\/github.com\/ggreer\/the_silver_searcher"},{"repository_id":1903522,"repository_short_name":"php-src","repository_full_name":"php\/php-src","language":"C","url":"https:\/\/github.com\/php\/php-src"},{"repository_id":3774328,"repository_short_name":"wrk","repository_full_name":"wg\/wrk","language":"C","url":"https:\/\/github.com\/wg\/wrk"},{"repository_id":15183485,"repository_short_name":"The-Art-Of-Programming-By-July","repository_full_name":"julycoding\/The-Art-Of-Programming-By-July","language":"C","url":"https:\/\/github.com\/julycoding\/The-Art-Of-Programming-By-July"},{"repository_id":10446890,"repository_short_name":"ijkplayer","repository_full_name":"Bilibili\/ijkplayer","language":"C","url":"https:\/\/github.com\/Bilibili\/ijkplayer"},{"repository_id":10894716,"repository_short_name":"toxcore","repository_full_name":"irungentoo\/toxcore","language":"C","url":"https:\/\/github.com\/irungentoo\/toxcore"},{"repository_id":36205608,"repository_short_name":"JSPatch","repository_full_name":"bang590\/JSPatch","language":"C","url":"https:\/\/github.com\/bang590\/JSPatch"},{"repository_id":5101141,"repository_short_name":"jq","repository_full_name":"stedolan\/jq","language":"C","url":"https:\/\/github.com\/stedolan\/jq"},{"repository_id":27729880,"repository_short_name":"grpc","repository_full_name":"grpc\/grpc","language":"C","url":"https:\/\/github.com\/grpc\/grpc"},{"repository_id":40997482,"repository_short_name":"vim","repository_full_name":"vim\/vim","language":"C","url":"https:\/\/github.com\/vim\/vim"},{"repository_id":2990192,"repository_short_name":"Signal-Android","repository_full_name":"WhisperSystems\/Signal-Android","language":"C","url":"https:\/\/github.com\/WhisperSystems\/Signal-Android"},{"repository_id":26133979,"repository_short_name":"firefox-ios","repository_full_name":"mozilla-mobile\/firefox-ios","language":"C","url":"https:\/\/github.com\/mozilla-mobile\/firefox-ios"},{"repository_id":23029617,"repository_short_name":"h2o","repository_full_name":"h2o\/h2o","language":"C","url":"https:\/\/github.com\/h2o\/h2o"},{"repository_id":3516624,"repository_short_name":"twemproxy","repository_full_name":"twitter\/twemproxy","language":"C","url":"https:\/\/github.com\/twitter\/twemproxy"},{"repository_id":901662,"repository_short_name":"libgit2","repository_full_name":"libgit2\/libgit2","language":"C","url":"https:\/\/github.com\/libgit2\/libgit2"},{"repository_id":13862381,"repository_short_name":"Telegram","repository_full_name":"DrKLO\/Telegram","language":"C","url":"https:\/\/github.com\/DrKLO\/Telegram"},{"repository_id":60266911,"repository_short_name":"anypixel","repository_full_name":"googlecreativelab\/anypixel","language":"C","url":"https:\/\/github.com\/googlecreativelab\/anypixel"},{"repository_id":13677187,"repository_short_name":"torch7","repository_full_name":"torch\/torch7","language":"C","url":"https:\/\/github.com\/torch\/torch7"},{"repository_id":34676773,"repository_short_name":"disque","repository_full_name":"antirez\/disque","language":"C","url":"https:\/\/github.com\/antirez\/disque"},{"repository_id":912896,"repository_short_name":"ccv","repository_full_name":"liuliu\/ccv","language":"C","url":"https:\/\/github.com\/liuliu\/ccv"},{"repository_id":11715753,"repository_short_name":"masscan","repository_full_name":"robertdavidgraham\/masscan","language":"C","url":"https:\/\/github.com\/robertdavidgraham\/masscan"},{"repository_id":692798,"repository_short_name":"macvim","repository_full_name":"b4winckler\/macvim","language":"C","url":"https:\/\/github.com\/b4winckler\/macvim"},{"repository_id":184981,"repository_short_name":"memcached","repository_full_name":"memcached\/memcached","language":"C","url":"https:\/\/github.com\/memcached\/memcached"},{"repository_id":23515024,"repository_short_name":"robotjs","repository_full_name":"octalmage\/robotjs","language":"C","url":"https:\/\/github.com\/octalmage\/robotjs"}]}';
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
        'pages_to_return' => 2,
        'results_per_page' => 10
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
