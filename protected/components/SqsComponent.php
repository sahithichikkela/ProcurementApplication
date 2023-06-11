<?php
class SqsComponent extends CApplicationComponent
{
    private $sqs;

    public function init()
    {
        $awsConfig = Yii::app()->params['aws'];
        $this->sqs = new Aws\Sqs\SqsClient([
            'version' => 'latest',
            'region' => $awsConfig['region'],
            'credentials' => [
                'key' => $awsConfig['key'],
                'secret' => $awsConfig['secret'],
            ],
        ]);
    }

    public function getSqsClient()
    {
        return $this->sqs;
    }
}
