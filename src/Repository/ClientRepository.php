<?php

declare(strict_types=1);

namespace Alpabit\ApiSkeleton\Repository;

use Alpabit\ApiSkeleton\Client\Model\ClientInterface;
use Alpabit\ApiSkeleton\Entity\Client;
use Alpabit\ApiSkeleton\Client\Model\ClientRepositoryInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Client|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client[]    findAll()
 * @method Client[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * @author Muhamad Surya Iksanudin<surya.kejawen@gmail.com>
 */
final class ClientRepository extends AbstractRepository implements ClientRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    public function findByApiKey(string $apiKey): ?ClientInterface
    {
        return $this->findOneBy(['apiKey' => $apiKey]);
    }
}
