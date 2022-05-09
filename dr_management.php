<?php

    class DrManagementApi {
        private $customDomain;
        private $auth;

        public function __construct($management_key, CustomDomain $customDomaim = NULL)
        {
            $this->customDomain = $customDomaim;
            $this->auth = "Authorization: Bearer $management_key";
        }

        private function getUrl() {
            $url = "";

            if($this->customDomain != NULL) {
                $domainUrl = $this->customDomain->customDomainUrl;
                $domainProtocol = $this->customDomain->customDomainProtocol;
                $domainPort = $this->customDomain->customDomainPort;
                $url = "$domainProtocol://$domainUrl:$domainPort/api";
            } else {
                
                $url = "https://api.decisionrules.io/api";
                
            }

            return $url;

        }

        private function getCall($endpoint) {
            $curl = curl_init();

            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->auth));

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );

            curl_setopt($curl, CURLOPT_URL, $endpoint);

            $response = curl_exec($curl);

            curl_close($curl);

            return json_decode($response);
        }

        public function getRule($ruleId, $version = 1){
            $uri = $this->getUrl();

            $url =  "$uri/rule/$ruleId/$version";

            return $this->getCall($url);
        }

        public function getItems(){
            $uri = $this->getUrl();
            $url =  "$uri/space/items";

            return $this->getCall($url);
        }

        public function createRule($spaceId, $data){

            $uri = $this->getUrl();
            $url =  "$uri/rule/$spaceId";

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->auth));

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );

            curl_setopt($curl, CURLOPT_POST, 1);

            $request = json_encode($data);

            curl_setopt($curl, CURLOPT_POSTFIELDS, $request);

            curl_setopt($curl, CURLOPT_URL, $url);

            $response = curl_exec($curl);

            curl_close($curl);

            return json_decode($response);
        }

        public function updateRule($ruleId, $version, $data){
            $uri = $this->getUrl();
            $url =  "$uri/rule/$ruleId/$version";

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->auth));

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );

            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");

            $request = json_encode($data);

            curl_setopt($curl, CURLOPT_POSTFIELDS, $request);

            curl_setopt($curl, CURLOPT_URL, $url);

            $response = curl_exec($curl);

            curl_close($curl);

            return json_decode($response);
        }

        public function deleteRule($ruleId, $version){
            $uri = $this->getUrl();
            $url =  "$uri/rule/$ruleId/$version";

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->auth));

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );

            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");

            curl_setopt($curl, CURLOPT_URL, $url);

            $response = curl_exec($curl);

            curl_close($curl);

            return;
        }

        public function getRuleFlow($itemId, $version=1) {
            $uri = $this->getUrl();

            $url =  "$uri/rule-flow/$itemId/$version";

            return $this->getCall($url);
        }


        public function createRuleFlow($data) {
            $uri = $this->getUrl();
            $url =  "$uri/rule-flow/";

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->auth));

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );

            curl_setopt($curl, CURLOPT_POST, 1);

            $request = json_encode($data);

            curl_setopt($curl, CURLOPT_POSTFIELDS, $request);

            curl_setopt($curl, CURLOPT_URL, $url);

            $response = curl_exec($curl);

            curl_close($curl);

            return json_decode($response);
        }

        public function updateRuleFlow($itemId, $data, $version) {
            $uri = $this->getUrl();
            $url =  "$uri/rule-flow/$itemId/$version";

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->auth));

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );

            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");

            $request = json_encode($data);

            curl_setopt($curl, CURLOPT_POSTFIELDS, $request);

            curl_setopt($curl, CURLOPT_URL, $url);

            $response = curl_exec($curl);

            curl_close($curl);

            return json_decode($response);
        }

        public function deleteRuleFlow($itemId, $version) {
            $uri = $this->getUrl();
            $url =  "$uri/rule-flow/$itemId/$version";

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->auth));

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );

            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");

            curl_setopt($curl, CURLOPT_URL, $url);

            $response = curl_exec($curl);

            curl_close($curl);

            return;
        }
        public function exportRuleFLow($itemId, $version=1) {
            $uri = $this->getUrl();

            $url =  "$uri/rule-flow/export/$itemId/$version";

            return $this->getCall($url);
        }
        public function importRuleFlow($data, $itemId="", $version=1) {

            $url = $this->getUrl();

            if ($itemId == "" && $version == 1) {
                $url= "$url/rule-flow/import/";
            }

            if ($itemId !== "" && $version == 1){
                $url= "$url/rule-flow/import/?new-version=$itemId";
            }

            if ($itemId !=="" && $version !== 1) {
                $url= "$url/rule-flow/import/?overwrite=$itemId&version=$version";
            }


            $curl = curl_init();

            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->auth));

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );

            curl_setopt($curl, CURLOPT_POST, 1);

            $request = json_encode($data);

            curl_setopt($curl, CURLOPT_POSTFIELDS, $request);

            curl_setopt($curl, CURLOPT_URL, $url);

            $response = curl_exec($curl);

            curl_close($curl);

            return json_decode($response);
        }

        public function getTags(array $tags) {
            $tagsQuery = implode(",", $tags);

            $url = "$this->getUrl()/tags/items/?tags=$tagsQuery";

            return $this->getCall($url);
        }
        public function updateTags($data, $itemId, $version=1) {

            $url = $this->getUrl();

            $url = "$url/tags/$itemId/$version";

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->auth));

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );

            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH");

            $request = json_encode($data);

            curl_setopt($curl, CURLOPT_POSTFIELDS, $request);

            curl_setopt($curl, CURLOPT_URL, $url);

            $response = curl_exec($curl);

            curl_close($curl);

            return json_decode($response);
        }
        public function deleteTags($itemId, $version) {
            $uri = $this->getUrl();
            $url =  "$uri/tags/$itemId/$version";

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $this->auth));

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );

            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");

            curl_setopt($curl, CURLOPT_URL, $url);

            $response = curl_exec($curl);

            curl_close($curl);

            return;
        }

    }