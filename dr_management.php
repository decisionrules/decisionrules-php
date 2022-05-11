<?php

    require_once "HttpClient.php";

    class DrManagementApi {
        private $customDomain;
        private $auth;

        public function __construct($management_key, CustomDomain $customDomaim = NULL)
        {
            $this->customDomain = $customDomaim;
            $this->auth = "Authorization: Bearer $management_key";
        }

        public function getRule($ruleId, $version = NULL){
            $uri = $this->customDomainn->getUrl();

            if ($version == NULL) {
                $url =  "$uri/rule/$ruleId/";
            } else {
                $url =  "$uri/rule/$ruleId/$version";
            }
            
            return HttpClient::get($url, $this->auth);
        }

        public function getSpaceItems(){
            $uri = $this->customDomainn->getUrl();
            $url =  "$uri/space/items";

            return HttpClient::get($url, $this->auth);
        }

        public function createRule($spaceId, $data){

            $uri = $this->customDomainn->getUrl();
            $url =  "$uri/rule/$spaceId";
            
            return HttpClient::post($url, $data, $this->auth);
        }

        public function updateRule($ruleId, $version, $data){
            $uri = $this->customDomainn->getUrl();
            $url =  "$uri/rule/$ruleId/$version";

            return HttpClient::put($url, $data, $this->auth);
        }

        public function deleteRule($ruleId, $version){
            $uri = $this->customDomainn->getUrl();
            $url =  "$uri/rule/$ruleId/$version";

            return HttpClient::delete($url, $this->auth);
        }

        public function getRuleFlow($itemId, $version=NULL) {
            $uri = $this->customDomainn->getUrl();

            if ($version == NULL) {
                $url =  "$uri/rule-flow/$itemId/";
            } else {
                $url =  "$uri/rule-flow/$itemId/$version";
            }
            

            return HttpClient::get($url, $this->auth);
        }


        public function createRuleFlow($data) {
            $uri = $this->customDomainn->getUrl();
            $url =  "$uri/rule-flow/";

            return HttpClient::post($url, $data, $this->auth);
        }

        public function updateRuleFlow($itemId, $data, $version) {
            $uri = $this->customDomainn->getUrl();
            $url =  "$uri/rule-flow/$itemId/$version";

            return HttpClient::put($url, $data, $this->auth);
        }

        public function deleteRuleFlow($itemId, $version) {
            $uri = $this->customDomainn->getUrl();
            $url =  "$uri/rule-flow/$itemId/$version";

            return HttpClient::delete($url, $this->auth);
        }

        public function exportRuleFLow($itemId, $version=NULL) {
            $uri = $this->customDomainn->getUrl();

            if ($version == NULL) {
                $url =  "$uri/rule-flow/export/$itemId/";
            } else {
                $url =  "$uri/rule-flow/export/$itemId/$version";
            }
            

            return HttpClient::get($url, $this->auth);
        }

        public function importRuleFlow($data, $itemId=NULL, $version=NULL) {

            $url = $this->customDomainn->getUrl();

            if ($itemId == "" && $version == NULL) {
                $url= "$url/rule-flow/import/";
            }

            if ($itemId !== "" && $version == NULL){
                $url= "$url/rule-flow/import/?new-version=$itemId";
            }

            if ($itemId !=="" && $version !== NULL) {
                $url= "$url/rule-flow/import/?overwrite=$itemId&version=$version";
            }


            return HttpClient::post($url, $data, $this->auth);
        }

        public function getSpaceItemsByTags(array $tags) {
            $tagsQuery = implode(",", $tags);

            $url = $this->customDomain->getUrl();

            $url = "$url/tags/items/?tags=$tagsQuery";

            return HttpClient::get($url, $this->auth);
        }


        public function updateTags($data, $itemId, $version=NULL) {

            $url = $this->customDomainn->getUrl();

            if ($version == NULL) {
                $url = "$url/tags/$itemId/";
            } else {
                $url = "$url/tags/$itemId/$version";
            }
            
            return HttpClient::patch($url, $data, $this->auth);
        }
        public function deleteTags($itemId, $version) {
            $uri = $this->customDomainn->getUrl();
            $url =  "$uri/tags/$itemId/$version";

            return HttpClient::delete($url, $this->auth);
        }

    }