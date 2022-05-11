<?php

    require_once "HttpClient.php";

    class DrManagementApi {
        private $customDomain;
        private $auth;

        public function __construct($management_key, CustomDomain $customDomain = NULL)
        {
            if ($customDomain == NULL) {
                $this->customDomain = new CustomDomain(NULL, NULL, NULL);
            } else {
                $this->customDomain = $customDomain;
            }
            $this->auth = "Authorization: Bearer $management_key";
        }

        public function getRule($ruleId, $version = NULL){
            $uri = $this->customDomain->getManagementUrl();

            if ($version == NULL) {
                $url =  "$uri/rule/$ruleId/";
            } else {
                $url =  "$uri/rule/$ruleId/$version";
            }
            
            return HttpClient::get($url, $this->auth);
        }

        public function getSpaceItems(){
            $uri = $this->customDomain->getManagementUrl();
            $url =  "$uri/space/items";

            return HttpClient::get($url, $this->auth);
        }

        public function createRule($spaceId, $data){

            $uri = $this->customDomain->getManagementUrl();
            $url =  "$uri/rule/$spaceId";
            
            return HttpClient::post($url, $data, $this->auth);
        }

        public function updateRule($ruleId, $version, $data){
            $uri = $this->customDomain->getManagementUrl();
            $url =  "$uri/rule/$ruleId/$version";

            return HttpClient::put($url, $data, $this->auth);
        }

        public function deleteRule($ruleId, $version){
            $uri = $this->customDomain->getManagementUrl();
            $url =  "$uri/rule/$ruleId/$version";

            return HttpClient::delete($url, $this->auth);
        }

        public function getRuleFlow($itemId, $version=NULL) {
            $uri = $this->customDomain->getManagementUrl();

            if ($version == NULL) {
                $url =  "$uri/rule-flow/$itemId/";
            } else {
                $url =  "$uri/rule-flow/$itemId/$version";
            }
            

            return HttpClient::get($url, $this->auth);
        }


        public function createRuleFlow($data) {
            $uri = $this->customDomain->getManagementUrl();
            $url =  "$uri/rule-flow/";

            return HttpClient::post($url, $data, $this->auth);
        }

        public function updateRuleFlow($itemId, $data, $version) {
            $uri = $this->customDomain->getManagementUrl();
            $url =  "$uri/rule-flow/$itemId/$version";

            return HttpClient::put($url, $data, $this->auth);
        }

        public function deleteRuleFlow($itemId, $version) {
            $uri = $this->customDomain->getManagementUrl();
            $url =  "$uri/rule-flow/$itemId/$version";

            return HttpClient::delete($url, $this->auth);
        }

        public function exportRuleFLow($itemId, $version=NULL) {
            $uri = $this->customDomain->getManagementUrl();

            if ($version == NULL) {
                $url =  "$uri/rule-flow/export/$itemId/";
            } else {
                $url =  "$uri/rule-flow/export/$itemId/$version";
            }
            

            return HttpClient::get($url, $this->auth);
        }

        public function importRuleFlow($data, $itemId=NULL, $version=NULL) {

            $url = $this->customDomain->getManagementUrl();

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

            $url = $this->customDomain->getManagementUrl();

            $url = "$url/tags/items/?tags=$tagsQuery";

            return HttpClient::get($url, $this->auth);
        }


        public function updateTags($data, $itemId, $version=NULL) {

            $url = $this->customDomain->getManagementUrl();

            if ($version == NULL) {
                $url = "$url/tags/$itemId/";
            } else {
                $url = "$url/tags/$itemId/$version";
            }
            
            return HttpClient::patch($url, $data, $this->auth);
        }
        public function deleteTags($itemId, $version, array $tags) {

            $tagsQuery = implode(",", $tags);

            $uri = $this->customDomain->getManagementUrl();
            $url =  "$uri/tags/$itemId/$version/?tags=$tagsQuery";

            return HttpClient::delete($url, $this->auth);
        }

        public function changeRuleStatus($itemId, $status, $version=NULL){

            $url = $this->customDomain->getManagementUrl();

            if($version==NULL){
                $url = "$url/rule/status/$itemId/$status";
            } else {
                $url = "$url/rule/status/$itemId/$status/$version";
            }

            return HttpClient::put($url, new stdClass(), $this->auth);
        }

        public function changeRuleFlowStatus($itemId, $status, $version=NULL)
        {
            $url = $this->customDomain->getManagementUrl();

            if($version==NULL){
                $url = "$url/rule-flow/status/$itemId/$status";
            } else {
                $url = "$url/rule-flow/status/$itemId/$status/$version";
            }

            return HttpClient::put($url, new stdClass(), $this->auth);
        }

        

    }