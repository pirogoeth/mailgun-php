<?php

namespace Mailgun\Tests\Api;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class StatsTest extends TestCase
{
    protected function getApiClass()
    {
        return 'Mailgun\Api\Stats';
    }

    public function testTotal()
    {
        $data = [
            'foo' => 'bar',
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('/v3/domain/stats/total', $data);

        $api->total('domain', $data);
    }

    public function testAll()
    {
        $data = [
            'foo' => 'bar',
        ];

        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('/v3/domain/stats', $data);

        $api->all('domain', $data);
    }
}
