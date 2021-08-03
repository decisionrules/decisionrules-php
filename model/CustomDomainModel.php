<?php

    class CustomDomain{
        private $customDomainUrl;
        private $customDomainProtocol;

        public function __construct($customDomainUrl, $customDomainProtocol)
        {
            $this->customDomainUrl = $customDomainUrl;
            $this->customDomainProtocol = $customDomainProtocol;
        }

        public function __get($property) {
            if (property_exists($this, $property)) {
              return $this->$property;
            }
        }
    }