<?php

namespace AppBundle\Repository;

/**
 * ScoutRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ScoutRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Generation du code composant le matricule du scout
     * Avec la methode mt_rand(10000000,99999999)
     *
     * Author: Delrodie AMOIKON
     * Since: v1.0 | 27/02/2017
     */
    public function generationCode()
    {

        // Affectation a code la valeur aleatoire generée
        $matricule = mt_rand(1000, 9999);

        return $matricule;
    }

    /**
     * Géneration d'une lettre aleatoire composant le matricule du scout
     *
     * Author: Delrodie AMOIKON
     * Since Version v1.0 | 27/02/2017
     */
    public function generationLettre()
    {
        // Liste des lettres de l'alphabet
        $alphabet="ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        // Affectation d'une lettre aleatoire
        $lettre_aleatoire=$alphabet[rand(0,25)];

        return $lettre_aleatoire;
    }

    /**
     * Nombre de scout par region
     */
    public function getNombreByRegion($region, $cotisation)
    {
        return $this->createQueryBuilder('s')
                    ->select('count(s.id)')
                    ->leftJoin('s.groupe', 'g')
                    ->leftJoin('g.district', 'd')
                    ->leftJoin('d.region', 'r')
                    ->where('r.slug = :region')
                    ->andWhere('s.cotisation = :annee')
                    ->setParameters([
                        'region'=>$region,
                        'annee'=>$cotisation
                    ])
                    ->getQuery()->getSingleScalarResult()
            ;
    }

    /**
     * Nombre total de scout inscrit
     */
    public function getNmbreTotal($cotisation)
    {
        return $this->createQueryBuilder('s')
                    ->select('count(s.id)')
                    ->where('s.cotisation = :annee')
                    ->setParameter('annee', $cotisation)
                    ->getQuery()->getSingleScalarResult()
            ;
    }

    /**
     * Nombre total d'inscrits selon le statut
     */
    public function getNombreTotalParStatut($slug, $cotisation, $region = null)
    {
        if (!$region){
            return $this->createQueryBuilder('s')
                ->select('count(s.id)')
                ->leftJoin('s.statut', 'statut')
                ->where('statut.libelle LIKE :slug')
                ->andWhere('s.cotisation = :annee')
                ->setParameters([
                    'slug' => '%'.$slug,
                    'annee' => $cotisation
                ])
                ->getQuery()->getSingleScalarResult()
                ;
        }else{
            return $this->createQueryBuilder('s')
                ->select('count(s.id)')
                ->leftJoin('s.statut', 'statut')
                ->leftJoin('s.groupe', 'g')
                ->leftJoin('g.district', 'd')
                ->leftJoin('d.region', 'r')
                ->where('statut.libelle LIKE :slug')
                ->andWhere('s.cotisation = :annee')
                ->andWhere('r.slug = :region')
                ->setParameters([
                    'slug' => '%'.$slug,
                    'annee' => $cotisation,
                    'region' => $region
                ])
                ->getQuery()->getSingleScalarResult()
                ;
        }
    }

    /**
     * Nombre total d'inscrits par brnche
     */
    public function getNombreTotalParBranche($statut,$branche,$cotisation, $region = null)
    {
        if (!$region){
            return $this->createQueryBuilder('s')
                ->select('count(s.id)')
                ->leftJoin('s.statut', 'statut')
                ->where('statut.libelle LIKE :statut')
                ->andWhere('s.branche LIKE :branche')
                ->andWhere('s.cotisation = :annee')
                ->setParameters([
                    'statut' => '%'.$statut,
                    'branche' => '%'.$branche.'%',
                    'annee' => $cotisation
                ])
                ->getQuery()->getSingleScalarResult()
                ;
        }else{
            return $this->createQueryBuilder('s')
                        ->select('count(s.id)')
                        ->leftJoin('s.statut', 'statut')
                        ->leftJoin('s.groupe', 'g')
                        ->leftJoin('g.district', 'd')
                        ->leftJoin('d.region', 'r')
                        ->where('statut.libelle LIKE :statut')
                        ->andWhere('s.branche LIKE :branche')
                        ->andWhere('s.cotisation = :annee')
                        ->andWhere('r.slug = :region')
                        ->setParameters([
                            'statut' => '%'.$statut,
                            'branche' => '%'.$branche.'%',
                            'annee' => $cotisation,
                            'region' => $region
                        ])
                        ->getQuery()->getSingleScalarResult()
                ;
        }
    }

    public function getNombreTotalParSexe($cotisation, $sexe, $region = null)
    {
        if ($region){
            return $this->createQueryBuilder('s')
                        ->select('count(s.id)')
                        ->leftJoin('s.groupe', 'g')
                        ->leftJoin('g.district', 'd')
                        ->leftJoin('d.region', 'r')
                        ->where('s.sexe = :sexe')
                        ->andWhere('s.cotisation = :annee')
                        ->andWhere('r.slug = :region')
                        ->setParameters([
                            'sexe'=> $sexe,
                            'annee' => $cotisation,
                            'region' => $region
                        ])
                        ->getQuery()->getSingleScalarResult()
                ;
        }else{
            return $this->createQueryBuilder('s')
                        ->select('count(s.id)')
                        ->where('s.sexe = :sexe')
                        ->andWhere('s.cotisation = :annee')
                        ->setParameters([
                            'annee' => $cotisation,
                            'sexe' => $sexe
                        ])
                        ->getQuery()->getSingleScalarResult()
                ;
        }
    }

    /**
     * Liste des scouts par district
     */
    public function getNombreByDistrict($slug, $annee)
    {
        return $this->createQueryBuilder('s')
                    ->select('count(s.id)')
                    ->leftJoin('s.groupe', 'g')
                    ->leftJoin('g.district', 'd')
                    ->where('d.slug = :district')
                    ->andWhere('s.cotisation = :annee')
                    ->setParameters([
                        'district'=>$slug,
                        'annee'=>$annee
                    ])
                    ->getQuery()->getSingleScalarResult()
            ;
    }

    /**
     * Nombre de scouts par district selon le statut
     */
    public function getNombreByDistrictStatut($slug,$statut,$annee)
    {
        return $this->createQueryBuilder('s')
                    ->select('count(s.id)')
                    ->leftJoin('s.statut', 'st')
                    ->leftJoin('s.groupe', 'g')
                    ->leftJoin('g.district', 'd')
                    ->where('d.slug = :district')
                    ->andWhere('s.cotisation = :annee')
                    ->andWhere('st.libelle = :statut')
                    ->setParameters([
                        'district'=>$slug,
                        'annee'=>$annee,
                        'statut'=>$statut
                    ])
                    ->getQuery()->getSingleScalarResult()
            ;
    }

    /**
     * Nombre de scouts par district selon le statut
     */
    public function getNombreByDistrictSexe($slug,$sexe,$annee)
    {
        return $this->createQueryBuilder('s')
                    ->select('count(s.id)')
                    ->leftJoin('s.groupe', 'g')
                    ->leftJoin('g.district', 'd')
                    ->where('d.slug = :district')
                    ->andWhere('s.cotisation = :annee')
                    ->andWhere('s.sexe = :sexe')
                    ->setParameters([
                        'district'=>$slug,
                        'annee'=>$annee,
                        'sexe'=>$sexe
                    ])
                    ->getQuery()->getSingleScalarResult()
            ;
    }

    /**
     * Total des sexe
     */
    public function getNombreSexeByStatut($cotisation, $sexe, $statut, $region=null)
    {
        if (!$region){
            return $this->createQueryBuilder('s')
                        ->select('count(s.id)')
                        ->leftJoin('s.statut', 'st')
                        ->where('st.libelle = :statut')
                        ->andWhere('s.sexe = :sexe')
                        ->andWhere('s.cotisation = :annee')
                        ->setParameters([
                            'statut' => $statut,
                            'sexe' => $sexe,
                            'annee' => $cotisation,
                        ])
                        ->getQuery()->getSingleScalarResult()
                ;
        }else{
            return $this->createQueryBuilder('s')
                        ->select('count(s.id)')
                        ->leftJoin('s.statut', 'st')
                        ->leftJoin('s.groupe', 'g')
                        ->leftJoin('g.district', 'd')
                        ->leftJoin('d.region', 'r')
                        ->where('st.libelle = :statut')
                        ->andWhere('s.sexe = :sexe')
                        ->andWhere('s.cotisation = :annee')
                        ->andWhere('r.slug = :region')
                        ->setParameters([
                            'statut' => $statut,
                            'sexe' => $sexe,
                            'annee' => $cotisation,
                            'region' => $region,
                        ])
                        ->getQuery()->getSingleScalarResult()
                ;
        }
    }

    public function getNombreSexeByStatutAndBranche($cotisation,$sexe,$statut,$branche,$region=null)
    {
        if (!$region){
            return $this->createQueryBuilder('s')
                        ->select('count(s.id)')
                        ->leftJoin('s.statut', 'st')
                        ->where('st.libelle = :statut')
                        ->andWhere('s.sexe = :sexe')
                        ->andWhere('s.branche LIKE :branche')
                        ->andWhere('s.cotisation = :annee')
                        ->setParameters([
                            'statut' => $statut,
                            'sexe' => $sexe,
                            'annee' => $cotisation,
                            'branche' => '%'.$branche.'%',
                        ])
                        ->getQuery()->getSingleScalarResult()
                ;
        }else{
            return $this->createQueryBuilder('s')
                        ->select('count(s.id)')
                        ->leftJoin('s.statut', 'st')
                        ->leftJoin('s.groupe', 'g')
                        ->leftJoin('g.district', 'd')
                        ->leftJoin('d.region', 'r')
                        ->where('st.libelle = :statut')
                        ->andWhere('s.sexe = :sexe')
                        ->andWhere('s.branche LIKE :branche')
                        ->andWhere('s.cotisation = :annee')
                        ->andWhere('r.slug = :region')
                        ->setParameters([
                            'statut' => $statut,
                            'sexe' => $sexe,
                            'annee' => $cotisation,
                            'branche' => '%'.$branche.'%',
                            'region' => $region
                        ])
                        ->getQuery()->getSingleScalarResult()
                ;
        }
    }

    public function getTotalStatutByBranche($cotisation,$statut,$branche,$region=null)
    {
        if (!$region){
            return $this->createQueryBuilder('s')
                        ->select('count(s.id)')
                        ->leftJoin('s.statut', 'st')
                        ->where('st.libelle = :statut')
                        ->andWhere('s.branche LIKE :branche')
                        ->andWhere('s.cotisation = :annee')
                        ->setParameters([
                            'statut' => $statut,
                            'annee' => $cotisation,
                            'branche' => '%'.$branche.'%'
                        ])
                        ->getQuery()->getSingleScalarResult()
                ;
        }else{
            return $this->createQueryBuilder('s')
                        ->select('count(s.id)')
                        ->leftJoin('s.statut', 'st')
                        ->leftJoin('s.groupe', 'g')
                        ->leftJoin('g.district', 'd')
                        ->leftJoin('d.region', 'r')
                        ->where('st.libelle = :statut')
                        ->andWhere('s.branche LIKE :branche')
                        ->andWhere('s.cotisation = :annee')
                        ->andWhere('r.slug LIKE :region')
                        ->setParameters([
                            'statut' => $statut,
                            'annee' => $cotisation,
                            'branche' => '%'.$branche.'%',
                            'region' => '%'.$region.'%'
                        ])
                        ->getQuery()->getSingleScalarResult()
                ;
        }
    }

    /**
     * Nombre des scouts
     */
    public function findByRegion($cotisation,$region)
    {
        return $this->createQueryBuilder('s')
                    ->leftJoin('s.groupe', 'g')
                    ->leftJoin('g.district', 'd')
                    ->leftJoin('d.region', 'r')
                    ->where('r.slug = :region')
                    ->andWhere('s.cotisation = :annee')
                    ->orderBy('s.nom', "ASC")
                    ->addOrderBy('s.prenoms', "ASC")
                    ->setParameters([
                        'region' => $region,
                        'annee' => $cotisation
                    ])
                    ->getQuery()->getResult()
            ;
    }

    /**
     * Nombre de scouts par district
     */
    public function findByDistrict($cotisation,$district)
    {
        return $this->createQueryBuilder('s')
                    ->leftJoin('s.groupe', 'g')
                    ->leftJoin('g.district', 'd')
                    ->where('d.slug = :district')
                    ->andWhere('s.cotisation = :annee')
                    ->orderBy('s.nom', "ASC")
                    ->addOrderBy('s.prenoms', "ASC")
                    ->setParameters([
                        'district' => $district,
                        'annee' => $cotisation
                    ])
                    ->getQuery()->getResult()
            ;
    }

    /**
     * Liste des scouts par groupe
     */
    public function findByGroupe($cotisation,$groupe)
    {
        return $this->createQueryBuilder('s')
                    ->leftJoin('s.groupe', 'g')
                    ->where('g.slug = :groupe')
                    ->andWhere('s.cotisation = :annee')
                    ->orderBy('s.nom', "ASC")
                    ->addOrderBy('s.prenoms', "ASC")
                    ->setParameters([
                        'groupe' => $groupe,
                        'annee' => $cotisation
                    ])
                    ->getQuery()->getResult()
            ;
    }

    /**
     * @return array
     */
    public function findDoublon()
    {
        $q = '
                SELECT DISTINCT s FROM AppBundle\Entity\Scout s 
                WHERE EXISTS (
                    SELECT sc FROM AppBundle\Entity\Scout sc 
                    WHERE s.id <> sc.id
                    AND s.nom = sc.nom 
                    AND s.prenoms = sc.prenoms
                    AND s.datenaiss = sc.datenaiss
                    AND  s.lieunaiss = sc.lieunaiss
                    AND s.sexe = sc.sexe
                    AND s.contact = sc.contact
                    AND s.urgence = sc.urgence
                )
        ';
        $query = $this->getEntityManager()->createQuery($q)->execute();

        return $query;
    }

    /**
     * @return array
     */
    public function findBySexe()
    {
        return $this->createQueryBuilder('s')
                    ->where('s.sexe = :m')
                    ->orWhere('s.sexe = :f')
                    ->setParameters([
                        'm'=>'M',
                        'f'=>'F'
                    ])
                    ->getQuery()->getResult()
            ;
    }
}
