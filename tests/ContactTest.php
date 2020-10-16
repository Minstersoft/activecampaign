<?php

use PHPUnit\Framework\TestCase;
use Minstersoft\ActiveCampaign\ActiveCampaign;

class ContactTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    public function test_contacts()
    {
        $activeCampaign = new ActiveCampaign('', '123', $http = Mockery::mock('GuzzleHttp\Client'));

        $http->shouldReceive('request')->once()->with('GET', 'contacts', [])->andReturn(
            $response = Mockery::mock('GuzzleHttp\Psr7\Response')
        );

        $response->shouldReceive('getStatusCode')->once()->andReturn(200);
        $response->shouldReceive('getBody')->once()->andReturn('{"data": [{"key": "value"}]}');

        $contacts = $activeCampaign->contacts();

        $this->assertContainsOnlyInstancesOf(\Minstersoft\ActiveCampaign\Resources\Contact::class, $contacts);
    }

    public function test_get_contact()
    {
        $activeCampaign = new ActiveCampaign('', '123', $http = Mockery::mock('GuzzleHttp\Client'));

        $http->shouldReceive('request')->once()->with('GET', 'contacts/1', [])->andReturn(
            $response = Mockery::mock('GuzzleHttp\Psr7\Response')
        );

        $response->shouldReceive('getStatusCode')->once()->andReturn(200);
        $response->shouldReceive('getBody')->once()->andReturn('{"data": [{"key": "value"}]}');

        $contact = $activeCampaign->getContact(1);

        $this->assertInstanceOf(\Minstersoft\ActiveCampaign\Resources\Contact::class, $contact);
    }

    public function test_create_update_contact()
    {
        $activeCampaign = new ActiveCampaign('', '123', $http = Mockery::mock('GuzzleHttp\Client'));

        $http->shouldReceive('request')->once()->with('POST', 'contact/sync', [
            'json' => [
                'contact' => [
                    'email'     => 'test@test.com',
                    'firstName' => 'test1',
                    'lastName'  => 'test2',
                ],
            ],
        ])->andReturn(
            $response = Mockery::mock('GuzzleHttp\Psr7\Response')
        );

        $response->shouldReceive('getStatusCode')->once()->andReturn(200);
        $response->shouldReceive('getBody')->once()->andReturn('{"data": [{"key": "value"}]}');

        $contact = $activeCampaign->createOrUpdateContact('test@test.com', 'test1', 'test2');

        $this->assertInstanceOf(\Minstersoft\ActiveCampaign\Resources\Contact::class, $contact);
    }

}
