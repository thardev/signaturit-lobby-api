<?php
namespace App\Tests;

use App\Trial;
use PHPUnit\Framework\TestCase;

class TrialTest extends TestCase
{	
	private $party1;
	private $party2;

	protected function setUp() {
		$this->party1 = new \stdClass;
		$this->party2 = new \stdClass;
	}

    public function testCalculateTrialDraw()
    {	
    	$this->party1->contract = 'KNN';
    	$this->party2->contract = 'KNNV';
        
        $trial = new Trial([$this->party1, $this->party2]);
        $result = $trial->calculateTrial();

        $this->assertEquals(0, $result);
    }

    public function testCalculateTrialParty1()
    {	
    	$this->party1->contract = 'KKKNN';
    	$this->party2->contract = 'KNNV';
        
        $trial = new Trial([$this->party1, $this->party2]);
        $result = $trial->calculateTrial();

        $this->assertEquals(1, $result);
    }

    public function testCalculateTrialEmpty()
    {	
    	$this->party1->contract = '';
    	$this->party2->contract = '';
        
        $trial = new Trial([$this->party1, $this->party2]);
        $result = $trial->calculateTrial();

        $this->assertEquals(0, $result);
    }
}
