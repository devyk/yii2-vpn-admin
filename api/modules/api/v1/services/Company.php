<?php

namespace api\modules\api\v1\services;

use api\modules\api\v1\repositories\CompanyRepository;
use api\modules\api\v1\repositories\LogRepository;
use api\modules\api\v1\repositories\UserRepository;
use Faker\Generator as Faker;

class Company implements CompanyInterface
{
    public function getAbusers(CompanyRepository $companyRepository, \DateTime $dateTime)
    {
        return $companyRepository->findAbusers($dateTime);
    }

    public function generateLogs(UserRepository $userRepository, LogRepository $logsRepository, Faker $faker)
    {
        /**
         * 100% guarantee that we will generate a random log in each month at least once.
         */
        foreach ($userRepository->findAllIds() as $userId) {
            $data = [];
            for ($i=0; $i < 6; $i++) {
                /**
                 * Guarantee that the user transfers counter in 6-month period always be in range of 54-498,
                 * As a given task do not force us about precise of each month.
                 */
                $transfersCount = $faker->numberBetween(9, 83);
                for ($j=0; $j < $transfersCount; $j++) {
                    $data[] = [
                        $userId['id'],
                        $faker->dateTimeBetween("-{1+$i} month", "-$i month")->format('Y-m-d H:i:s'),
                        $faker->url(),
                        $faker->numberBetween(100, 10000000000000)
                    ];
                }
            }
            $logsRepository->insertBatch($data);
        }
    }
}
