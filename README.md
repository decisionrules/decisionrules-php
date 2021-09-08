# DecisionRulespy

Simple async python library that allows you to easily connect to [Decisionrules.io](https://decisionrules.io) from your PHP application.

# Where do i get api key?

You can create your API key here: https://app.decisionrules.io/api-keys

# Enums

## Geolocation

* DEFAULT
* EU1
* EU2
* US1
* US2

## SolverStrategy

* STANDARD
* ARRAY
* FIRST_MATCH

## Protocols

* HTTP
* HTTPS


Geolocation in DecisionRules class contructor can be omitted. Version in Solver method can be omitted. Custom domain for on premise version of DecisionRules can be omitted if using standart version.

# Usage

```php
include 'decisionrules.php';

$decisionRules = new DecisionRules('API_KEY_HERE', GeoLocation::DEFAULT);

$data = array (
    'data' => 
    array (
        'day' => 'today',
    ),
);

$response = $decisionRules->Solver("RULE_ID_HERE", $data, SolverStrategy::STANDARD, "VERSION_HERE");
```

## Custom domain usage

Just create CustomDomain instace that takes string url and Protocols enum value and pass it to the DecisionRules object as so.

```php
$customDomainIfOnPremise = new CustomDomain("your.domain.com", Protocols::HTTP);

$decisionRules = new DecisionRules('API_KEY_HERE', GeoLocation::DEFAULT, $customDomain);
```
