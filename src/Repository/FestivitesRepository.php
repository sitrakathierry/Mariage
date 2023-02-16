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

    public function getFirstFestivite()
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = " SELECT f.id, m.id as IdMariage, m.nom_homme, m.nom_femme, f.nom_fest ,tf.festivite, tf.id as idTypeF FROM `festivites` f JOIN mariage m ON f.id_mariage_id = m.id JOIN type_festivite tf ON f.id_type_festivite_id = tf.id ORDER BY f.`id` ASC LIMIT 1 ";
        $stmt = $conn->prepare($sql);
        $query = $stmt->executeQuery([]);

        // returns an array of arrays (i.e. a raw data set)
        return $query->fetchAssociative();
    }

    public function findAgendaBy($params = array())
    {
        $keys = array_keys($params);

        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT m.nom_homme, m.nom_femme, tf.festivite, f.* FROM `festivites` f JOIN mariage m ON f.id_mariage_id = m.id JOIN type_festivite tf ON f.id_type_festivite_id = tf.id WHERE ";
        $cmp = 0;
        $extension = "";
        for ($i = 0; $i < count($params); $i++) {
            if ($params[$keys[$i]] !== "") {
                if ($extension == "")
                    $extension .= " ";
                else
                    $extension .= " AND ";
                if ($i < 3)
                    $extension .= $keys[$i] . " = '" . $params[$keys[$i]] . "'";
                else
                    $extension .= $keys[$i] . " like '%" . $params[$keys[$i]] . "%'";

                $cmp++;
            }
        }
        $sql .= $extension;
        if ($cmp == 0)
            $sql .= 1;
        $stmt = $conn->prepare($sql);
        $query = $stmt->executeQuery([]);

        // returns an array of arrays (i.e. a raw data set)
        return $query->fetchAllAssociative();
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

    public function getMariageEnCours()
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = " SELECT m.nom_homme, m.nom_femme, m.photo_mariee FROM `festivites` f JOIN mariage m ON f.id_mariage_id = m.id WHERE f.statut IS NULL GROUP BY f.id_mariage_id ORDER BY date ASC ";
        $stmt = $conn->prepare($sql);
        $query = $stmt->executeQuery([]);
        return $query->fetchAllAssociative();
    }
}
