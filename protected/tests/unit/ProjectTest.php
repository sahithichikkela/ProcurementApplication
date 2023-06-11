<?php 
    use PHPUnit\Framework\TestCase;
    require_once '/data/live/protected/modules/aws/components/helpers/S3helper.php';
    require_once '/data/live/protected/modules/aws/models/S3demo.php';
   
    class ProjectTest extends TestCase{
        public function testSwiftMailer(){
            $data=Yii::app()->swiftMailer->send('iamsahithirao@gmail.com', 'Test test', 'Helllooooooooo!');
            $this->assertSame($data,1);
        }
    

    public function testUploadImageToS3()
    {
  
      $objectKey = 'dummy';
  
      $filePath = '/data/live/protected/tests/unit/dummy.png';
  
      $s3Helper = new S3helper();
      $url = $s3Helper->putObject($objectKey, $filePath);
    
      $headers = get_headers($url);
  
      $status = substr($headers[0], 9, 3);
  
      $exists = $status == '200';
  
      $this->assertTrue($exists, 'The image does not exist in Amazon S3');
  
    }


    public function testAlloteditems()
  
    {
  
      $model= new Allotitems();
  
      $model->product_name='test@gmail.com';
  
      $model->quantity=123456;    
      $model->to='test'; 
      $model->purpose='new interns';
      $model->timestamp= '9.86';
  
      $this->assertEquals($model->save(), true);
  
      $savedModel = $model->findByAttributes(['product_name' => $model->product_name])->delete();
  
      $this->assertNull($model->findByAttributes(['product_name' => $model->product_name]));
  
  
    }

}
  

?>