<?php
/*
* CURL abstraction class to handle all the dirty work for us
*/
class APIBase {
  /*
  * Execute a regular request based on parameters based
  */
  protected function _execute(array $params) {
    $url = $this->__buildUrl($params['base_url'], $params['url_params']);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $params['method']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, $params['user_agent']);
    $result = json_decode(curl_exec($ch) , true);
    $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    $final = array(
      'code' => $response_code,
      'payload' => $result
    );
    return $final;
  }
  /*
  * Execute a request and only return the response headers
  */
  protected function _executeGetResponseHeaders(array $params){
    $url = $this->__buildUrl($params['base_url'], $params['url_params']);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $params['method']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, $params['user_agent']);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $result = curl_exec($ch);
    $response_code = curl_getinfo($ch);
    curl_close($ch);
    $final = array(
      'code' => $response_code,
      'headers' => $this->__getHeadersFromCurlResponse($result)
    );
    return $final;
  }
  /*
  * Build the final url given a base url and query params
  */
  private function __buildUrl($baseUrl, $urlParams){
    return urldecode($baseUrl . '?' . http_build_query($urlParams));
  }
  /*
  * Parse the headers from a given CURL response
  */
  private function __getHeadersFromCurlResponse($response){
    $headers = array();
    $header_text = substr($response, 0, strpos($response, "\r\n\r\n"));
    foreach (explode("\r\n", $header_text) as $i => $line)
      if ($i === 0){
        $headers['http_code'] = $line;
      } else{
        list ($key, $value) = explode(': ', $line);
        $headers[$key] = $value;
      }
    return $headers;
  }
}
