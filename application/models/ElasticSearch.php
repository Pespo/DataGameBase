<?php
 
// http://www.elasticsearch.com/docs/elasticsearch/rest_api/
 
class ElasticSearch {
public $index;
public $type;
public $server:
 
function __construct($server = '192.168.157.130:9999'){
$this->server = $server;
$this->index = 'jeux';
$this->type = 'jeux';
}
 
function call($path, $http = array()){
if (!$this->index) throw new Exception('$this->index needs a value');
return json_decode(file_get_contents($this->server . '/' . $this->index . '/' . $path, NULL, stream_context_create(array('http' => $http))));
}
 
//curl -X PUT http://localhost:9200/{INDEX}/
function create(){
$this->call(NULL, array('method' => 'PUT'));
}
 
//curl -X DELETE http://localhost:9200/{INDEX}/
function drop(){
$this->call(NULL, array('method' => 'DELETE'));
}
 
//curl -X GET http://localhost:9200/{INDEX}/_status
function status(){
return $this->call('_status');
}
 
//curl -X GET http://localhost:9200/{INDEX}/{TYPE}/_count -d {matchAll:{}}
function count(){
return $this->call($this->type . '/_count', array('method' => 'GET', 'content' => '{ matchAll:{} }'));
}
 
//curl -X PUT http://localhost:9200/{INDEX}/{TYPE}/_mapping -d ...
function map($data){
return $this->call($this->type . '/_mapping', array('method' => 'PUT', 'content' => $data));
}
 
//curl -X PUT http://localhost:9200/{INDEX}/{TYPE}/{ID} -d ...
function add($id, $data){
return $this->call($this->type . '/' . $id, array('method' => 'PUT', 'content' => $data));
}
 
//curl -X GET http://localhost:9200/{INDEX}/{TYPE}/_search?q= ...
function query($q){
return $this->call($this->type . '/_search?' . http_build_query(array('q' => $q)));
}
}