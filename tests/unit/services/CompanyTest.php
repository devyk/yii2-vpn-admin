<?php

namespace tests\unit\services;

use api\modules\api\v1\repositories\CompanyRepository;
use api\modules\api\v1\repositories\LogRepository;
use api\modules\api\v1\repositories\UserRepository;
use api\modules\api\v1\services\Company;
use Faker\Generator;

class CompanyTest extends \PHPUnit_Framework_TestCase
{
    /** @var Company */
    protected $service;

    /** @var  CompanyRepository | \PHPUnit_Framework_MockObject_MockObject */
    protected $companyRepository;

    /** @var  \DateTime | \PHPUnit_Framework_MockObject_MockObject */
    protected $dateTime;

    /** @var  UserRepository | \PHPUnit_Framework_MockObject_MockObject */
    protected $userRepository;

    /** @var  LogRepository | \PHPUnit_Framework_MockObject_MockObject */
    protected $logRepository;

    /** @var  Generator | \PHPUnit_Framework_MockObject_MockObject */
    protected $faker;

    public function setUp()
    {
        $this->companyRepository = $this->getMockBuilder(CompanyRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->dateTime = $this->getMockBuilder(\DateTime::class)
            ->getMock();
        $this->userRepository = $this->getMockBuilder(UserRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->logRepository = $this->getMockBuilder(LogRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->faker = $this->getMockBuilder(Generator::class)
            ->setMethods(['numberBetween', 'dateTimeBetween', 'url'])
            ->getMock();

        $this->service = new Company();
    }

    public function testGetAbusers()
    {
        $this->companyRepository->expects($this->once())
            ->method('findAbusers')
            ->with($this->dateTime)
            ->willReturn([]);

        $result = $this->service->getAbusers($this->companyRepository, $this->dateTime);
        $this->assertInternalType('array', $result);
    }

    public function testGenerateLogs()
    {
        $this->userRepository->expects($this->once())
            ->method('findAllIds')
            ->willReturn([
                [
                   'id' => 1,
                ],
            ]);

        $this->faker->expects($this->exactly(12))
            ->method('numberBetween')
            ->willReturn(1);

        $this->faker->expects($this->exactly(6))
            ->method('dateTimeBetween')
            ->willReturn($this->dateTime);

        $this->logRepository->expects($this->once())
            ->method('insertBatch');

        $this->service->generateLogs($this->userRepository, $this->logRepository, $this->faker);
    }
}