<?php
// tests/ProductRepositoryTest.php
use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductRepositoryTest extends KernelTestCase
{
private EntityManager $entityManager;
protected function setUp(): void
{ // Initialisations et configurations pour chaque test
self::bootKernel();
$this->entityManager = self::$kernel->getContainer()
->get('doctrine')
->getManager();
}
protected function tearDown(): void
{
parent::tearDown();
$this->entityManager->close();
// $this->entityManager = null;
}
// public function testCRUDOperations(): void
// {
// // Create
// $product = new Product();
// $product->setName('Test Product');
// $product->setType('Test Product');
// $product->setPrice(19.99);
// $this->entityManager->persist($product);
// $this->entityManager->flush();
// $this->assertNotNull($product->getId());
// }

public function testCRUDOperations(): void
{
// Read
$product = new Product();
$repository = $this->entityManager->getRepository(Product::class);
$retrievedProduct = $repository->find($product->getId());
$this->assertEquals('Test Product', $retrievedProduct->getName());
// Update
$product->setName('Updated Product');
$this->entityManager->flush();
$updatedProduct = $repository->find($product->getId());
$this->assertEquals('Updated Product', $updatedProduct->getName());
}

// public function testCRUDOperations(): void
// { 
//     // Delete

//     $product = new Product();
//     $repository = $this->entityManager->getRepository(Product::class);
// $this->entityManager->remove($product);
// $this->entityManager->flush();
// $deletedProduct = $repository->find($product->getId());
// $this->assertNull($deletedProduct);
// }
}

