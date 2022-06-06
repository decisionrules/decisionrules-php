
# Summary

[Decisionrules.io](https://decisionrules.io/) library that allows you to integrate DecisionRules Solver and Management API to you application as easily as possible. SDK allow you to solve all rule types that are available, CRUD operations on all rule types, rules status management and rule tags management.

> VERSION 3 IS NEW MAJOR VERSION OF THIS SDK AND IT IS STRONGLY RECOMMENDED, DUE TO DEPRECATION OF OLDER VERSIONS.

  
# Installation

You can simply integrate [SDK](https://packagist.org/packages/decisionrules/decisionrules-php#dev-main) to your project via NPM package manager.

# Defining Custom domain

Custom domain is special class that is designed for those who uses DecisionRules in private cloud or as on-premise. Class takes up to 3 arguments.
  
Domain argument is name of desired domain, protocol is HTTP or HTTPS and port is TCP/IP port.

If port is not defined in the class constructor it is set to default value by protocol value, 80 for HTTP and 443 for HTTPS.

```php

$customDomain = new  CustomDomain("localhost", Protocols::HTTP, 8080);

```

# Using Solver API

Solver class takes up to 2 arguments that are `api key`(can be generated on dashboard), `custom domain` object. Class exposes two methods: solveRule and solveRuleFlow.

```php
use DecisionRules\Solver;
use DecisionRules\Enums\SolverStrategy;

public function awesomeSolver(){
	$ruleId = "MY_RULE_ID";
	$solver = new Solver($apiKey);
	$request = (object) array('data'=> array('input_attribute'=> 'value'));
	return $solver->solveRule($ruleId, $request, SolverStrategy::STANDARD);
}
```

# Using Management API

Management class takes on argument, management api key. Class exposes number of methods listed below.

  

- getRule - get rule by itemId and version*

- createRule - create rule by spaceId and ruleData

- updateRule - updates rule by itemId, newRuleData and version*

- deleteRule - deletes rule by itemId and version

- getSpaceItems - get space items that belongs to management api key

- getRuleFlow - get rule by itemId and version*

- createRuleFlow - create ruleflow in space that belongs to management api key

- updateRuleFlow - updates ruleflowby itemId, newRuleflowData and version*

- deleteRuleFlow - deletes ruleflow by itemId and version

- exportRuleFlow - exports ruleflow by itemId and version*

- importRuleFlow - import ruleflow as a new ruleflow or new version of existing ruleflow or override existing ruleflow.

- changeRuleStatus - changes rule status

- changeRuleFlowStatus - changes ruleflow status

- getRulesByTags - gets rule by tag.

- updateTags - update tags on rule or ruleflow

- deleteTags - delete tags on rule or ruleflow

  

>  \* = optional argument

  

## Example usage

```php
use DecisionRules\Management;

public  manageRules(){
	$managementKey = "MY_MANAGEMENT_KEY";
	$manager = new Management($managementKey);
	return $manager->getRule($ruleId, 1);
}
```