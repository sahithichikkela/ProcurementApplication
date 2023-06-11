<?php 
    use PHPUnit\Framework\TestCase;
    require_once '/data/live/protected/controllers/SiteController.php';
    class RandomHelperTest extends TestCase{
      /**
     * @dataProvider sriProvider
     */
      public function testAddA($expected,$a){
        $this->assertEquals($expected,RandomHelper::add($a[0],$a[1]));
      }
      public function sriProvider(){
        return [
          ['7',[2,5]],
          ['13',[5,8]],
          ['75',[40,35]]
        ];
      }

      // public function testJsonEncode(){
      //     // $data = array("test"=>array("test1"=>array("test2":"test3")));
      //     // $data['test']['test1']['test4'] = $data["test"]
      //     $data = ['a'=>['b'=>['c'=>'d']]];

      //     $this->assertEquals('{"test":"test"}',RandomHelper::jsonEncode($data));
          
      //   }
      //     public function testJsonEncodeArr($expected,$a){
      //       // $data = array("test"=>array("test1"=>array("test2":"test3")));
      //       // $data['test']['test1']['test4'] = $data["test"]
      //       $data = ['a'=>['b'=>['c'=>'d']]];

      //       $this->assertEquals($expected,RandomHelper::jsonEncode($a));
            
      //     }
      
      
      public function testController()
      {
        $site=new SiteController('test');
        $this->assertEquals($site->actionTests(),"hello");
      }
    }

?>
