<?php

    class CustomDomain{
        private $customDomainUrl;
        private $customDomainProtocol;
        private $customDomainPort;

        public function __construct($customDomainUrl, $customDomainProtocol, $customDomainPort)
        {
            $this->customDomainUrl = $customDomainUrl;
            $this->customDomainProtocol = $customDomainProtocol;
            $this->customDomainPort = $customDomainPort;
        }

        public function __get($property) {
            if (property_exists($this, $property)) {
              return $this->$property;
            }
        }
    }