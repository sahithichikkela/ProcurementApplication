<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Error\Warning;

include "/data/live/protected/controllers/AuthorController.php";

class TestingcompTest extends TestCase
{
    public $arr;
    public function setUp(): void
    {
        $this->arr = array();
    }
    public function testingForAdd()
    {
        $comp = new Testingcomp();
        $actual = $comp->add(2, 3);
        $expec = '5';
        $this->assertEquals($actual, $expec);
    }


    public function testingForStrictAdd()
    {
        $comp = new Testingcomp();
        $actual = $comp->add(2, 3);
        $expec = 5;
        $this->assertsame($actual, $expec);
    }



    public function testingForException()
    {
        $comp = new Testingcomp();
        $this->expectException(DivisionByZeroError::class);
        $comp->divide(2, 0);
    }


    public function testingForExceptionMessage()
    {
        $comp = new Testingcomp();
        $this->expectExceptionMessage('Division by zero');
        $comp->divide(10, 0);
    }

    /**
     * @dataProvider givexyzvals
     */
    public function testingForCustomException($x, $y, $z)
    {
        $comp = new Testingcomp();
        $this->expectExceptionMessage('x or y should not be zero');
        $comp->exceptiontestinghelper($x, $y, $z);
    }

    public function givexyzvals()
    {
        return array(
            [0, 0, 10],
            [0, 10, 3],
            [3, 0, 0],
        );
    }

    public function testEmpty()
    {
        $this->assertEmpty($this->arr);
        return $this->arr;
    }


    // public function testWarning(){
    // $comp = new Testingcomp();
    // // $this->expectException(Exception::class);
    // $this->expectExceptionMessage('warning');
    // $this->expectException(\PHPUnit\Framework\Error\Error::class);
    // // $comp->warning();
    // try{
    //     $value = sqrt(-1);
    // }
    // catch(Exception $e){
    //     throw new Exception('warning');
    // }
    // $foo = new NonExistentClass();
    // }

    // public function testError()
    // {
    //     $comp = new Testingcomp();
    //     $this->expectException(Warning::class);
    //     // $this->expectError();
    //     $comp->error();
    // }

    // /**
    //  * @expectedException PHPUnit\Framework\Error\Error
    //  */
    // public function testNotice(){
    //     $comp = new Testingcomp();
    //     // $this->expectNotice();
    //     // $this->expectException(PHPUnit\Framework\Error\Notice::class);
    //     // $comp->notice();
    //     include 'not_existing_file.php';
    // }

    public function testController()
    {
        $cont = new Authorcontroller('index');
        $res = $cont->actionDisplay();
        $this->assertSame('Raghu', $res['name']);
    }


    public function testIsEmpty()
    {
        // $this->assertDirectoryIsNotWritable('/data/live/protected/images');
        $this->assertEmpty([]);
    }

    /**
     * @depends testEmpty
     */
    public function testAddElems($arr)
    {
        array_push($this->arr, 1);
        array_push($this->arr, 2);
        array_push($this->arr, 3);
        $this->assertContains(2, $this->arr);
        return $this->arr;
    }

    public function tearDown(): void
    {
        unset($this->arr);
    }


    public function testMock()
    {
        // $comp = new Testingcomp();
        $comp = $this->createMock(Testingcomp::class);
        $comp->method('sayhello')
            ->willReturn('Hello');
        $this->assertSame("Hello", $comp->sayhello());
    }

    public function testMock1()
    {
        $mock = $this->createMock(Testingcomp::class);
        $map = [
            ["Rohith","Abhi","pranay","Raghu","interns"]
        ];
        $mock->method('sayhello')
            ->willReturn($this->returnValueMap($map));


        $this->assertSame('interns', $mock->sayhello("Rohith","Abhi","pranay","Raghu"));
    }

    public function testStub(){
        $comp = $this->createStub(Testingcomp::class);
        $comp->method('sayhello')
            ->willReturn('Hello');
        $this->assertSame("Hello", $comp->sayhello());
    }


}
