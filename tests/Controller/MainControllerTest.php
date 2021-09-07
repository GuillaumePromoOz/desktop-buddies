<?php

namespace App\Tests\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Homepage test
 */
class MainControllerTest extends WebTestCase
{
    public function testHomepage()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSelectorTextContains('h4', 'Top Products');
    }

    /**
     * Anonymous does not have access to User profile
     */
    public function testReviewAddFailure()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/edit/13');

        // Are we being redirected to login ?
        $this->assertResponseRedirects();
    }


    /**
     * Anonymous cannot update User profile
     */
    public function testReviewAddFailurePost()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/edit/13');

        $this->assertResponseRedirects();
    }
}
