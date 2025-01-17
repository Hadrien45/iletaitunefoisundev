<?php

declare(strict_types=1);

namespace App\Adventure\Repository;

use App\Adventure\Entity\Player;
use App\Adventure\Gateway\PlayerGateway;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @template T
 *
 * @template-extends ServiceEntityRepository<Player>
 * @template-implements PlayerGateway<Player>
 */
final class PlayerRepository extends ServiceEntityRepository implements PlayerGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Player::class);
    }
}
