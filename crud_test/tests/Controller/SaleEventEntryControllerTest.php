<?php

namespace App\Test\Controller;

use App\Entity\SaleEventEntry;
use App\Repository\SaleEventEntryRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SaleEventEntryControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private SaleEventEntryRepository $repository;
    private string $path = '/sale/event/entry/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(SaleEventEntry::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('SaleEventEntry index');

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
            'sale_event_entry[SaleEvent]' => 'Testing',
            'sale_event_entry[Art]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sale/event/entry/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new SaleEventEntry();
        $fixture->setSaleEvent('My Title');
        $fixture->setArt('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('SaleEventEntry');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new SaleEventEntry();
        $fixture->setSaleEvent('My Title');
        $fixture->setArt('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'sale_event_entry[SaleEvent]' => 'Something New',
            'sale_event_entry[Art]' => 'Something New',
        ]);

        self::assertResponseRedirects('/sale/event/entry/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getSaleEvent());
        self::assertSame('Something New', $fixture[0]->getArt());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new SaleEventEntry();
        $fixture->setSaleEvent('My Title');
        $fixture->setArt('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/sale/event/entry/');
    }
}
