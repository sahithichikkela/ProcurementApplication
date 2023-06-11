<?php 
    use PHPUnit\Framework\TestCase;
    class CreateuserTest extends TestCase{

      public function testarraySumMedian(){
          $stcont=new Createuser();
          $actualOutput=$stcont->add(1,2);
          $expectedOutput=3;
          $this->assertSame($expectedOutput,$actualOutput);
          
        }
    }

?>