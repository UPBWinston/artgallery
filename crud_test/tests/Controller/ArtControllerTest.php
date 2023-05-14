<?php

namespace App\Test\Controller;

use App\Entity\Art;
use App\Repository\ArtRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArtControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ArtRepository $repository;
    private string $path = '/art/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Art::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Art index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'art[title]' => 'Testing',
            'art[description]' => 'Testing',
            'art[year]' => 'Testing',
            'art[price]' => 'Testing',
            'art[isAvailable]' => 'Testing',
            'art[Artist]' => 'Testing',
        ]);

        self::assertResponseRedirects('/art/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Art();
        $fixture->setTitle('My Title');
        $fixture->setDescription('My Title');
        $fixture->setYear('My Title');
        $fixture->setPrice('My Title');
        $fixture->setIsAvailable('My Title');
        $fixture->setArtist('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Art');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Art();
        $fixture->setTitle('My Title');
        $fixture->setDescription('My Title');
        $fixture->setYear('My Title');
        $fixture->setPrice('My Title');
        $fixture->setIsAvailable('My Title');
        $fixture->setArtist('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'art[title]' => 'Something New',
            'art[description]' => 'Something New',
            'art[year]' => 'Something New',
            'art[price]' => 'Something New',
            'art[isAvailable]' => 'Something New',
            'art[Artist]' => 'Something New',
        ]);

        self::assertResponseRedirects('/art/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getYear());
        self::assertSame('Something New', $fixture[0]->getPrice());
        self::assertSame('Something New', $fixture[0]->getIsAvailable());
        self::assertSame('Something New', $fixture[0]->getArtist());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Art();
        $fixture->setTitle('My Title');
        $fixture->setDescription('My Title');
        $fixture->setYear('My Title');
        $fixture->setPrice('My Title');
        $fixture->setIsAvailable('My Title');
        $fixture->setArtist('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/art/');
    }
}
