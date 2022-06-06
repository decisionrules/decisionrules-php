<?php

    namespace DecisionRules\Enums;

    abstract class SolverStrategy{
        const STANDARD = 'STANDARD';
        const ARRAY_STRATEGY = 'ARRAY';
        const FIRST_MATCH = 'FIRST_MATCH';
    }