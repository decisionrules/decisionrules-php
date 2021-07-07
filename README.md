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

Geolocation in DecisionRules class contructor can be omitted. Version in Solver method can be omitted.

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

$response = $decisionRules->Solver("RULE_ID_HERE", $data, SolverStrategy::STANDARD, 1);
```