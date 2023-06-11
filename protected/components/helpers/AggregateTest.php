<?php

class AggregateTest

{

    public static function getUserGenderCount()
    {

        $arr = User1::model()

        ->startAggregation()

        ->group(['_id' => '$gender', 'count' => ['$sum' => 1]])
        
        ->aggregate();

        echo '<pre>';

        return $arr;

    }


    public static function useremailsort()

    {
        $arr = User1::model()

        ->startAggregation()

        ->sort(['email' => 1])

        ->aggregate();

        echo '<pre>';

        return $arr;

    }

}

//     public static function lookupTest()

//     {

//         $resumes_agg_obj = RecruitmentApplicants::model()->startAggregation()

//             ->match($applicants_match)

//             ->project(['tenant_id' => 1, 'resume_id' => 1, 'email' => 1, 'phone' => 1, 'candidate_id' => 1])

//             ->addStage(['$lookup' =>

//             ['from' => AddResume::model()

//                 ->getCollectionName(), 'let' =>

//             ['app_resume' => '$resume_id'], 'pipeline' =>

//             [

//                 ['$match' =>

//                 ['$expr' =>

//                 ['$and' => $resume_match]]]

//             ], 'as' => 'resume_details']])

//             ->addStage(

//                 ['$addFields' =>

//                 ['resume_details' =>

//                 ['$arrayElemAt' =>

//                 ['$resume_details', 0]]]]

//             )

//             ->project(

//                 ['tenant_id' => 1, 'resume_id' => 1, 'email' => 1, 'phone' => 1, 'candidate_id' => 1, 'file_name' => '$resume_details.file_name', 'type' => '$resume_details.type', 'key' => '$resume_details.key', 'bucket' => '$resume_details.bucket']

//             )

//             ->match(

//                 ['key' =>

//                 ['$exists' => true], 'bucket' =>

//                 ['$exists' => true]]

//             );

//     }

// }