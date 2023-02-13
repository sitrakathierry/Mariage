<?php

namespace App\Repository;

use App\Entity\Festivites;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Festivites>
 *
 * @method Festivites|null find($id, $lockMode = null, $lockVersion = null)
 * @method Festivites|null findOneBy(array $criteria, array $orderBy = null)
 * @method Festivites[]    findAll()
 * @method Festivites[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FestivitesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Festivites::class);
    }

    public function add(Festivites $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Festivites $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return Festivites[] Returns an array of Festivites objects
    //     */

    public function getLastFestOfMariage($idMariage): array
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.IdMariage = ?1 ')
            ->setParameter(1, $idMariage)
            ->orderBy('f.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }

    public function getAll(): array
    {
        return $this->createQueryBuilder('f')
            ->groupBy('f.NomFest')
            ->orderBy('f.NomFest', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function getFirstFestivite()
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = " SELECT f.id, m.id as IdMariage, m.nom_homme, m.nom_femme, f.nom_fest FROM `festivites` f JOIN mariage m ON f.id_mariage_id = m.id ORDER BY f.`id` ASC LIMIT 1 ";
        $stmt = $conn->prepare($sql);
        $query = $stmt->executeQuery([]);

        // returns an array of arrays (i.e. a raw data set)
        return $query->fetchAssociative();
    }

//    public function findOneBySomeField($value): ?Festivites
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
