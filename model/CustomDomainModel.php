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

        public function getUrl() {
            $url = "";

            if($this->customDomain != NULL) {
                $domainUrl = $this->customDomain;
                $domainProtocol = $this->customDomainProtocol;
                $domainPort = $this->customDomainPort;
                $url = "$domainProtocol://$domainUrl:$domainPort/api";
            } else {
                
                $url = "https://api.decisionrules.io/api";
                
            }

            return $url;

        }

        public function __get($property) {
            if (property_exists($this, $property)) {
              return $this->$property;
            }
        }
    }