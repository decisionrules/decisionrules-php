# DecisionRulespy

Simple async python library that allows you to easily connect to [Decisionrules.io](https://decisionrules.io) from your python application.

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

SolverType defines type of solver that should be used.

```php
include 'decisionrules.php';

$decisionRules = new DecisionRules('API_KEY_HERE', GeoLocation::DEFAULT);

$data = array (
    'data' => 
    array (
        'day' => 'today',
    ),
);

$response = $decisionRules->Solver(SolverTypes::RULE, "RULE_ID_HERE", $data, SolverStrategy::STANDARD, "VERSION_HERE");

$response = $decisionRules->Solver(SolverTypes::COMPOSITION, "RULE_ID_HERE", $data, SolverStrategy::STANDARD, "VERSION_HERE");
```

## Custom domain usage

Just create CustomDomain instace that takes string url and Protocols enum value and pass it to the DecisionRules object as so.

```php
$customDomainIfOnPremise = new CustomDomain("your.domain.com", Protocols::HTTP);

$decisionRules = new DecisionRules('API_KEY_HERE', GeoLocation::DEFAULT, $customDomain);
```

# Management API usage

Management api is accessible in 'DrManagementApi' and required management api key that you can obtain in api key section in DecisionRules app.

## 2.1 Management API usage example

First of all define management api key in 'DrManagementApi' instance. Then simply call method you desire from 'DrMamangementApi' class.

```php
$managementAPI = new DrManagementApi("YOUR_MANAGEMENT_API_KEY");

$getRuleId = $managementAPI->getRuleById("RULE_ID");
$getRuleAndVersion = $managementAPI->getRuleByIdAndVersion("RULE_ID", "VERSION");
$getSpace = $managementAPI->getSpaceInfo("SPACE_ID");

$postRule = $managementAPI->postRuleForSpace("SPACE_ID", $postDATA);
$putRule = $managementAPI->putRule("RULE_ID", "1", $putDATA);

$deleteRule = $managementAPI->deleteRule("RULE_ID", "1");
```

Data for POST and PUT method are encoded json string of rule format that can be exported from our app or you can made one by yourself.