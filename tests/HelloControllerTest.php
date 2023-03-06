<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

* @covers \App\Controller\HelloController
*
* @group smoke
*/
class HelloControllerTest extends WebTestCase
{
    public static function getValidNames(): Generator
    {
        yield 'default' =>[
            'uri' => '/hello',
            'expectName' => "Brice",
        ];

        yield 'name "Brice"' =>[
            'uri' => '/hello/Brice',
            'expectName' => "Brice",
        ];

        yield 'name "louise"' =>[
            'uri' => '/hello/louise',
            'expectName' => "louise",
        ];
    }

    /**
     * @dataProvider getValidNames
     */
    public function testNameIsDisplayed(string $uri, string $expectedName): void
    {
        $client = static::createClient();
        $client->request('GET', $uri);

        $this->assertResponseIsSuccessful();
        $this->assertStringContainsString("Hello {$expectedName} !", $client->getResponse()->getContent());
    }
}
