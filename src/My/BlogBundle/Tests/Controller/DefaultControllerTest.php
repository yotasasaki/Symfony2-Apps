<?php

namespace My\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
//    public function testIndex()
//    {
//        $client = static::createClient();
//        $crawler = $client->request('GET', '/hello/Fabien');
//        $this->assertTrue($crawler->filter('html:contains("Hello Fabien")')->count() > 0);
//        $arr = array('a','b');
//        $this->assertTrue(count($arr) === 2);

//    }

    public function test一覧画面が表示される()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/blog/');
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function test詳細画面が表示される()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/blog/5/show');
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function test登録ができる()
    {
/*
        $client = static::createClient();
        $crawler = $client->request('GET', 'blog/new');

        $this->assertTrue($client->getResponse()->isSuccessful());
        $form = $crawler->selectButton('Save Post')->form();

        $form['form[title]'] = 'title';
        $form['form[body]'] = 'bodybodybody';

        $crawler = $client->submit($form);
        $crawler = $client->followRedirect();
        $this->assertTrue($client->getResponse()->isSuccessful());
*/
       $client = static::createClient();
        $crawler = $client->request('GET', '/blog/new');
        $this->assertTrue($client->getResponse()->isSuccessful());
        $form = $crawler->selectButton('Save Post')->form();//var_dump($form);
        $form['form["title"]'] = 'title';
        $form['form["body"]'] = 'bodybodybody';
        $crawler = $client->submit($form);
        $crawler = $client->followRedirect();
        $this->assertTrue($client->getResponse()->isSuccessful());

        //データベースを参照して登録されているか確認
        $kernel = static::createKernel();
        $kernel->boot();
        $em = $kernel->getContainer()->get('doctrine.orm.entity_manager');
        $dql = 'SELECT p FROM My\BlogBundle\Entity\Post p ORDER BY p.id DESC';
        $query = $em->createQuery($dql);
        $query->setMaxResults(1);
        $posts = $query->execute();
        $post = $posts[0];var_dump($post);
        $this->assertSame('title', $post->getTitle());
        $this->assertSame('bodybodybody', $post->getBody());

    }

}
