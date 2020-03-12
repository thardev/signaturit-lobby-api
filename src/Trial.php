<?php

namespace App;

class Trial
{	
    private $validatorsPoints = [
        'K' => 5,
        'N' => 2,
        'V' => 1,
        '' => 0
    ];
    private $party1;
    private $party2;

    public function __construct($parties) {
        $this->party1 = $this->checkValidatorKingConstraint($parties[0]->contract);
        $this->party2 = $this->checkValidatorKingConstraint($parties[1]->contract);
    }

    /**
      * Calculates the points of each party and returns the result of the trial.
      *
      * @return int
      */
    public function calculateTrial()
    {
        $party1Values = str_split($this->party1);
        $party2Values = str_split($this->party2);
        $party1Result = 0;
        $party2Result = 0;
        $winner = 0;

        foreach ($party1Values as $validator) {
            $party1Result = $party1Result + $this->validatorsPoints[$validator];
        }

        foreach ($party2Values as $validator) {
            $party2Result = $party2Result + $this->validatorsPoints[$validator];
        }

        if ($party1Result > $party2Result) {
            $winner = 1;
        } else if ($party1Result === $party2Result) {
            $winner = 0;
        } else {
            $winner = 2;
        }

        return $winner;
    }

    /**
      * Checks if a King and a Validator are present in the string and removes the Validators
      *
      * There is a constraint if a King and a Validator are on the same contract that makes
      * the Validator points not applicable. 
      *
      * @param string $contract A contract that will be checked
      *
      * @return string
      */
    private function checkValidatorKingConstraint(string $contract) {
        if (strpos($contract, 'K') !== false) {
            return preg_replace('/V/', '', $contract);
        }

        return $contract;
    }
}
