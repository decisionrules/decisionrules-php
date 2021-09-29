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
                $url = "$domainProtocol://$domainUrl/api";
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

        public function getRuleById($ruleId){
            $uri = $this->getUrl();
            $url =  "$uri/rule/$ruleId";

            return $this->getCall($url);
        }

        public function getRuleByIdAndVersion($ruleId, $version){
            $uri = $this->getUrl();
            $url =  "$uri/rule/$ruleId/$version";

            return $this->getCall($url);
        }

        public function getSpaceInfo($spaceId){
            $uri = $this->getUrl();
            $url =  "$uri/space/$spaceId";

            return $this->getCall($url);
        }

        public function postRuleForSpace($spaceId, $data){

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

        public function putRule($ruleId, $version, $data){
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
    }