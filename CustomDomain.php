<?php

    class CustomDomain{
        private $customDomain;
        private $customDomainProtocol;
        private $customDomainPort;

        // domainUrl -> domain
        public function __construct($customDomain, $customDomainProtocol, $customDomainPort)
        {
            $this->customDomain = $customDomain;
            $this->customDomainProtocol = $customDomainProtocol;
            $this->customDomainPort = $customDomainPort;
        }

        public function getManagementUrl() {

            $domain = $this->customDomain;
            $protocol = $this->customDomainProtocol;
            $port = $this->customDomainPort;
            
            if ($domain != NULL && $protocol != NULL && $port != NULL) {
                return "$protocol://$domain:$port/api";
            }
                
            return "https://api.decisionrules.io/api";

        }

        public function getSolverUrl($solverType, $ruleId, $version) {
            $domain = $this->customDomain;
            $protocol = $this->customDomainProtocol;
            $port = $this->customDomainPort;
            
            $url = "";

            if ($domain != NULL && $protocol != NULL && $port != NULL) {
                $url = "$protocol://$domain:$port/$solverType/solve/";
            }

            $url = "https://api.decisionrules.io/$solverType/solve/";

            if($version != NULL) {
                $url = "$url$ruleId/$version";
            } else {
                $url = "$url$ruleId";
            }
            
            return $url;

        }

        public function __get($property) {
            if (property_exists($this, $property)) {
              return $this->$property;
            }
        }
    }