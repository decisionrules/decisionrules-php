<?php 
    
    require_once 'enums/GeoLocation.php';
    require_once 'enums/SolverStrategy.php';
    require_once 'enums/ProtocolsEnum.php';
    require_once 'model/CustomDomainModel.php';
    require_once 'enums/SolverType.php';

    class DecisionRules{

        private $apiKey;
        private ?CustomDomain $customDomain;

        public function __construct($apiKey, CustomDomain $customDomain=NULL)
        {
            $this->apiKey = $apiKey;
            if ($customDomain == NULL) {
                $this->customDomain = new CustomDomain(NULL, NULL, NULL);
            } else {
                $this->customDomain = $customDomain;
            }
            $this->customDomain = $customDomain;
        }

        public function solveRule($ruleId, $data, $solverStrategy, $version = NULL){

            $solverType = SolverTypes::RULE;

            $endpoint = $this->customDomain->getSolverUrl($solverType, $ruleId, $version);
            $response = $this->ApiCall($endpoint, $solverStrategy, $data);

            return $response;
        }

        public function solveRuleFLow($ruleId, $data, $solverStrategy, $version = NULL){

            $solverType = SolverTypes::RULE_FLOW;

            $endpoint = $this->customDomain->getSolverUrl($solverType, $ruleId, $version);
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