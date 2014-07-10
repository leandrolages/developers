<?php

class CashMachineTest extends PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider expectedProvider
     */
    public function testWithdraw($amount, $expected)
    {
        $cashMachine = new CashMachine();
        $actual = $cashMachine->withDraw($amount);
        
        $this->assertEquals($expected, $actual);
    }

    public function expectedProvider()
    {

        return array(
           array(NULL, array()),
           array("0", array()),
           array(0.0, array()),
           array(0.00, array()),
           array("220", array(100.00, 100.00, 20.00)),
           array(100.0, array(100.00)),
           array("80.00", array(50.00, 20.00, 10.00)),
           array(60, array(50.00, 10.00))
        );
    }
    
    /**
     * @dataProvider invalidArgumentsProvider
     * @expectedException InvalidArgumentException
     */
    public function testWithdrawThrowsInvalidArgumentException($amount)
    {
        $cashMachine = new CashMachine();
        $cashMachine->withDraw($amount);
    }

    public function invalidArgumentsProvider()
    {

        return array(
           array("foo"), array("-120.00")
        );
    }
    
    /**
     * @dataProvider noteUnavailableProvider
     * @expectedException NoteUnavailableException
     */
    public function testWithdrawThrowsNoteUnavailableException($amount)
    {
        $cashMachine = new CashMachine();
        $cashMachine->withDraw($amount);
    }

    public function noteUnavailableProvider()
    {

        return array(
           array("232"), array("5"), array(105), array("50.01"), array(100.01), array("900.005"), array("101.00") 
        );
    }

}

?>
