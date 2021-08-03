<?php 
    
    require_once 'enums/GeoLocation.php';
    require_once 'enums/SolverStrategy.php';
    require_once 'enums/ProtocolsEnum.php';
    require_once 'model/CustomDomainModel.php';

    class DecisionRules{

        private $defaultEndpoint = 'api.decisionrules.io/rule/solve/';

        private $apiKey;
        private $geoLocation;
        private CustomDomain $customDomain;

        public function __construct($apiKey, $geoLoc,CustomDomain $customDomain=NULL)
        {
            $this->apiKey = $apiKey;
            $this->geoLocation = $geoLoc;
            $this->customDomain = $customDomain;
        }

        private function getUrl($ruleId, $version, $geoLoc) {
            $url = "";

            if($this->customDomain != NULL) {
                $domainUrl = $this->customDomain->customDomainUrl;
                $domainProtocol = $this->customDomain->customDomainProtocol;
                $url = "$domainProtocol://$domainUrl/rule/solve/";
            } else {
                if($geoLoc != NULL){
                    $url = "https://$geoLoc.$this->defaultEndpoint";
                } else {
                    $url = "https://$this->defaultEndpoint";
                }
            }

            if($version != NULL) {
                $url = "$url$ruleId/$version";
            } else {
                $url = "$url$ruleId";
            }

            return $url;

        }

        public function Solver($ruleId, $data, $solverStrategy, $version = NULL){

            $endpoint = $this->getUrl($ruleId, $version, $this->geoLocation);

            $response = $this->ApiCall($endpoint, $solverStrategy, $data);

            return $response;

        }

        private function ApiCall($endpoint, $solverStrategy, $request) {
            $curl = curl_init();

            $auth = "Authorization: Bearer $this->apiKey";

            if($solverStrategy != NULL || $solverStrategy != SolverStrategy::STANDARD) {
                $strategy = "X-Strategy: $solverStrategy";
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $auth, $strategy));
            } else {
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $auth));
            }

            curl_setopt($curl, CURLOPT_POST, 1);

            $request = json_encode($request);

            curl_setopt($curl, CURLOPT_POSTFIELDS, $request);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );

            curl_setopt($curl, CURLOPT_URL, $endpoint);

            $response = curl_exec($curl);

            curl_close($curl);

            return json_decode($response);
        }

    }