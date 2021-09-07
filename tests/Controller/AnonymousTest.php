<?php

namespace App\Tests\Controller\Back;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AnonymousTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testRedirectInGet($url): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', $url);

        // are we being redirected to login page ?
        $this->assertResponseStatusCodeSame(302);
    }

    public function urlProvider()
    {
        yield ['/cart'];
        yield ['/edit/13'];
        yield ['/delete/13'];
    }

    /**
     * @dataProvider urlProviderForPost
     */
    public function testRedirectInPost($url)
    {
        $client = self::createClient();
        $client->request('POST', $url);

        $this->assertResponseStatusCodeSame(302);
    }

    public function urlProviderForPost()
    {
        yield ['/cart/remove'];
        yield ['/edit/13'];
    }

    /**
     * @dataProvider urlProviderForDelete
     */
    public function testRedirectInDelete($url)
    {
        $client = self::createClient();
        $client->request('DELETE', $url);

        $this->assertResponseStatusCodeSame(302);
    }

    public function urlProviderForDelete()
    {
        yield ['/delete/13'];
    }
}
