<?php

use PHPUnit\Framework\TestCase;
use Minstersoft\ActiveCampaign\ActiveCampaign;

class DealTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    public function test_deals()
    {
        $activeCampaign = new ActiveCampaign('', '123', $http = Mockery::mock('GuzzleHttp\Client'));

        $http->shouldReceive('request')->once()->with('GET', 'deals', [])->andReturn(
            $response = Mockery::mock('GuzzleHttp\Psr7\Response')
        );

        $response->shouldReceive('getStatusCode')->once()->andReturn(200);
        $response->shouldReceive('getBody')->once()->andReturn('{"data": [{"key": "value"}]}');

        $deals = $activeCampaign->deals();

        $this->assertContainsOnlyInstancesOf(\Minstersoft\ActiveCampaign\Resources\Deal::class, $deals);
    }

    public function test_find_deals()
    {
        $activeCampaign = new ActiveCampaign('', '123', $http = Mockery::mock('GuzzleHttp\Client'));

        $criteria = [
            'limit'  => '1',
            'offset' => '0',
            'orders' => [
                'next-action' => 'DESC',
            ],
        ];

        $http->shouldReceive('request')->once()->with('GET', 'deals', ['query' => $criteria])->andReturn(
            $response = Mockery::mock('GuzzleHttp\Psr7\Response')
        );

        $response->shouldReceive('getStatusCode')->once()->andReturn(200);
        $response->shouldReceive('getBody')->once()->andReturn('{"data": [{"key": "value"}]}');

        $deals = $activeCampaign->findDeals($criteria);

        $this->assertContainsOnlyInstancesOf(\Minstersoft\ActiveCampaign\Resources\Deal::class, $deals);
    }

}
