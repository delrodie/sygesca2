<?php

namespace AppBundle\Controller;

use AppBundle\Utilities\GestionScout;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RegDefaultController
 * @Route("/stat-region")
 */
class RegDefaultController extends Controller
{
    /**
     * @param Request $request
     * @param GestionScout $gestionScout
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/{region}", name="stat_region_index")
     * @Method("GET")
     */
    public function indexAction(Request $request, GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager();
        $slug = $request->get('region'); //dump($slug);die();
        if (!$slug){
            $region = null;
        }else{
            $region = $em->getRepository("AppBundle:Region")->findOneBy(['slug'=>$slug]);
        }

        // Statistiques
        $total_jeune = $em->getRepository("AppBundle:Scout")->getNombreTotalParStatut('Jeune',$gestionScout->cotisation(), $slug);
        $total_adulte = $em->getRepository("AppBundle:Scout")->getNombreTotalParStatut('Adulte',$gestionScout->cotisation(), $slug);
        $meute = 'LOUVETEAU'; $troupe = 'ECLAIREUR'; $generation='CHEMINOT'; $route = 'ROUTIER';
        $louveteau = $em->getRepository("AppBundle:Scout")->getNombreTotalParBranche('Jeune',$meute,$gestionScout->cotisation(),$slug);
        $eclaireur = $em->getRepository("AppBundle:Scout")->getNombreTotalParBranche('Jeune',$troupe,$gestionScout->cotisation(),$slug);
        $cheminot = $em->getRepository("AppBundle:Scout")->getNombreTotalParBranche('Jeune',$generation,$gestionScout->cotisation(),$slug);
        $routier = $em->getRepository("AppBundle:Scout")->getNombreTotalParBranche('Jeune',$route,$gestionScout->cotisation(),$slug);

        if (!$total_jeune){
            $total_jeune = 1;
        }
        $regions = $em->getRepository("AppBundle:Region")->findOnlyRegion();
        // Total inscrits
        $nombre_scout = $em->getRepository("AppBundle:Scout")->getNombreByRegion($slug, $gestionScout->cotisation());
        if (!$nombre_scout){
            $nombre_scout = 1;
        }

        $loup_pourcent = $louveteau*100/$total_jeune;
        $eclai_pourcent = $eclaireur*100/$total_jeune;
        $chemin_pourcent = $cheminot*100/$total_jeune;
        $rout_pourcent = $routier*100/$total_jeune;
        $jeune_porcent = $total_jeune*100/$nombre_scout;
        $adulte_pourcent = $total_adulte*100/$nombre_scout;

        // Liste des districts
        $districts = $em->getRepository('AppBundle:District')->findByRegion($slug);

        return $this->render("regions/index.html.twig",[
            'regions' => $regions,
            'region' => $region,
            'louveteau' => $louveteau,
            'eclaireur' => $eclaireur,
            'cheminot' => $cheminot,
            'routier' => $routier,
            'loup_pourcent' => $loup_pourcent,
            'eclai_pourcent' => $eclai_pourcent,
            'chemin_pourcent' => $chemin_pourcent,
            'route_pourcent' => $rout_pourcent,
            'total_jeune' => $total_jeune,
            'total_adulte' => $total_adulte,
            'total_scout' => $nombre_scout,
            'jeune_porcent' => $jeune_porcent,
            'adulte_pourcent' => $adulte_pourcent,
            'districts' => $districts,
        ]);
    }

    /**
     * @Route("/{region}/", name="stat_region_genre")
     * @Method("GET")
     */
    public function genreAction(Request $request,GestionScout $gestionScout)
    {
        $em = $this->getDoctrine()->getManager();
        $regionSlug = $request->get('region'); //dump($regionSlug);die();
        $regions = $em->getRepository("AppBundle:Region")->findOnlyRegion();
        $nombre_total = $em->getRepository("AppBundle:Scout")->getNombreByRegion($regionSlug,$gestionScout->cotisation());
        $total_jeune = $em->getRepository("AppBundle:Scout")->getNombreTotalParStatut('Jeune',$gestionScout->cotisation(),$regionSlug);
        $total_adulte = $em->getRepository("AppBundle:Scout")->getNombreTotalParStatut('Adulte',$gestionScout->cotisation(),$regionSlug);//dump($total_adulte);
        $total_louvetier = $em->getRepository("AppBundle:Scout")->getTotalStatutByBranche($gestionScout->cotisation(),'Adulte','L0UVETEAU',$regionSlug);
        $total_louveteau = $em->getRepository("AppBundle:Scout")->getTotalStatutByBranche($gestionScout->cotisation(),'Jeune','LOUVETEAU',$regionSlug);
        $total_troupier = $em->getRepository("AppBundle:Scout")->getTotalStatutByBranche($gestionScout->cotisation(),'Adulte','ECLAIREUR',$regionSlug);
        $total_eclaireur= $em->getRepository("AppBundle:Scout")->getTotalStatutByBranche($gestionScout->cotisation(),'Jeune','ECLAIREUR',$regionSlug);
        $total_safouin = $em->getRepository("AppBundle:Scout")->getTotalStatutByBranche($gestionScout->cotisation(),'Adulte','CHEMINOT',$regionSlug);
        $total_cheminot= $em->getRepository("AppBundle:Scout")->getTotalStatutByBranche($gestionScout->cotisation(),'Jeune','CHEMINOT',$regionSlug);
        $total_coordinateur = $em->getRepository("AppBundle:Scout")->getTotalStatutByBranche($gestionScout->cotisation(),'Adulte','ROUTIER',$regionSlug);
        $total_routier= $em->getRepository("AppBundle:Scout")->getTotalStatutByBranche($gestionScout->cotisation(),'Jeune','ROUTIER',$regionSlug);

        $nombre_masculin = $em->getRepository("AppBundle:Scout")->getNombreTotalParSexe($gestionScout->cotisation(), 'HOMME',$regionSlug);
        $nombre_feminin = $em->getRepository("AppBundle:Scout")->getNombreTotalParSexe($gestionScout->cotisation(),'FEMME',$regionSlug);
        $nombre_homme = $em->getRepository("AppBundle:Scout")->getNombreSexeByStatut($gestionScout->cotisation(),'HOMME','Adulte',$regionSlug);
        $nombre_femme = $em->getRepository("AppBundle:Scout")->getNombreSexeByStatut($gestionScout->cotisation(),'FEMME','Adulte',$regionSlug);
        $nombre_garcon = $em->getRepository("AppBundle:Scout")->getNombreSexeByStatut($gestionScout->cotisation(),'HOMME','Jeune',$regionSlug);
        $nombre_fille = $em->getRepository("AppBundle:Scout")->getNombreSexeByStatut($gestionScout->cotisation(),'FEMME','Jeune',$regionSlug);

        $nombre_louvetier = $em->getRepository("AppBundle:Scout")->getNombreSexeByStatutAndBranche($gestionScout->cotisation(),'HOMME','Adulte','L0UVETEAU',$regionSlug);
        $nombre_louvetiere = $em->getRepository("AppBundle:Scout")->getNombreSexeByStatutAndBranche($gestionScout->cotisation(),'FEMME','Adulte','L0UVETEAU',$regionSlug);
        $nombre_louveteau = $em->getRepository("AppBundle:Scout")->getNombreSexeByStatutAndBranche($gestionScout->cotisation(),'HOMME','Jeune','LOUVETEAU',$regionSlug);
        $nombre_louvette = $em->getRepository("AppBundle:Scout")->getNombreSexeByStatutAndBranche($gestionScout->cotisation(),'FEMME','Jeune','LOUVETEAU',$regionSlug);


        $nombre_troupier = $em->getRepository("AppBundle:Scout")->getNombreSexeByStatutAndBranche($gestionScout->cotisation(),'HOMME','Adulte','ECLAIREUR',$regionSlug);
        $nombre_troupiere = $em->getRepository("AppBundle:Scout")->getNombreSexeByStatutAndBranche($gestionScout->cotisation(),'FEMME','Adulte','ECLAIREUR',$regionSlug);
        $nombre_eclaireur = $em->getRepository("AppBundle:Scout")->getNombreSexeByStatutAndBranche($gestionScout->cotisation(),'HOMME','Jeune','ECLAIREUR',$regionSlug);
        $nombre_eclaireuse = $em->getRepository("AppBundle:Scout")->getNombreSexeByStatutAndBranche($gestionScout->cotisation(),'FEMME','Jeune','ECLAIREUR',$regionSlug);


        $nombre_safouin = $em->getRepository("AppBundle:Scout")->getNombreSexeByStatutAndBranche($gestionScout->cotisation(),'HOMME','Adulte','CHEMINOT',$regionSlug);
        $nombre_safouine = $em->getRepository("AppBundle:Scout")->getNombreSexeByStatutAndBranche($gestionScout->cotisation(),'FEMME','Adulte','CHEMINOT',$regionSlug);
        $nombre_cheminot = $em->getRepository("AppBundle:Scout")->getNombreSexeByStatutAndBranche($gestionScout->cotisation(),'HOMME','Jeune','CHEMINOT',$regionSlug);
        $nombre_cheminote = $em->getRepository("AppBundle:Scout")->getNombreSexeByStatutAndBranche($gestionScout->cotisation(),'FEMME','Jeune','CHEMINOT',$regionSlug);


        $nombre_coordinateur = $em->getRepository("AppBundle:Scout")->getNombreSexeByStatutAndBranche($gestionScout->cotisation(),'HOMME','Adulte','ROUTIER',$regionSlug);
        $nombre_coordinatrice = $em->getRepository("AppBundle:Scout")->getNombreSexeByStatutAndBranche($gestionScout->cotisation(),'FEMME','Adulte','ROUTIER',$regionSlug);
        $nombre_routier = $em->getRepository("AppBundle:Scout")->getNombreSexeByStatutAndBranche($gestionScout->cotisation(),'HOMME','Jeune','ROUTIER',$regionSlug);
        $nombre_routiere = $em->getRepository("AppBundle:Scout")->getNombreSexeByStatutAndBranche($gestionScout->cotisation(),'FEMME','Jeune','ROUTIER',$regionSlug);


        //Pourcentage
        if ($nombre_total == 0){ $nombre_total = 1;}
        if ($total_adulte == 0){$total_adulte =1;}
        if ($total_jeune == 0){$total_jeune =1;}
        if ($total_louvetier == 0){$total_louvetier = 1;}
        if ($total_louveteau == 0){$total_louveteau = 1;}
        if ($total_troupier == 0){$total_troupier = 1;}
        if ($total_eclaireur == 0){$total_eclaireur = 1;}
        if ($total_safouin == 0){$total_safouin = 1;}
        if ($total_cheminot == 0){$total_cheminot = 1;}
        if ($total_coordinateur == 0){$total_coordinateur = 1;}
        if ($total_routier == 0){$total_routier = 1;}

        $pourcentage_masculin = $nombre_masculin*100/$nombre_total;
        $pourcentage_femin = $nombre_feminin*100/$nombre_total;
        $pourcentage_homme = $nombre_homme*100/$total_adulte;
        $pourcentage_femme = $nombre_femme*100/$total_adulte;
        $pourcentage_garcon = $nombre_garcon*100/$total_jeune;
        $pourcentage_fille = $nombre_fille*100/$total_jeune;

        $pourcentage_louvetier = $nombre_louvetier*100/$total_louvetier;
        $pourcentage_louvetiere = $nombre_louvetiere*100/$total_louvetier;
        $pourcentage_louveteau = $nombre_louveteau*100/$total_louveteau;
        $pourcentage_louvette = $nombre_louvette*100/$total_louveteau;

        $pourcentage_troupier = $nombre_troupier*100/$total_troupier;
        $pourcentage_troupiere = $nombre_troupiere*100/$total_troupier;
        $pourcentage_eclaireur = $nombre_eclaireur*100/$total_eclaireur;
        $pourcentage_eclaireuse = $nombre_eclaireuse*100/$total_eclaireur;

        $pourcentage_safouin = $nombre_safouin*100/$total_safouin;
        $pourcentage_safouine = $nombre_safouine*100/$total_safouin;
        $pourcentage_cheminot = $nombre_cheminot*100/$total_cheminot;
        $pourcentage_cheminote = $nombre_cheminote*100/$total_cheminot;

        $pourcentage_coordinateur = $nombre_coordinateur*100/$total_coordinateur;
        $pourcentage_coordinatrice = $nombre_coordinatrice*100/$total_coordinateur;
        $pourcentage_routier = $nombre_routier*100/$total_routier;
        $pourcentage_routiere = $nombre_routiere*100/$total_routier;

        $region = $em->getRepository("AppBundle:Region")->findOneBy(['slug'=>$regionSlug]);

        return $this->render('regions/genre.html.twig',[
            'regions' => $regions,
            'nombre_masculin' => $nombre_masculin,
            'nombre_feminin' => $nombre_feminin,
            'pourcentage_masculin' => $pourcentage_masculin,
            'pourcentage_feminin' => $pourcentage_femin,
            'nombre_homme' => $nombre_homme,
            'nombre_femme' => $nombre_femme,
            'pourcentage_homme' => $pourcentage_homme,
            'pourcentage_femme' => $pourcentage_femme,
            'nombre_garcon' => $nombre_garcon,
            'nombre_fille' => $nombre_fille,
            'pourcentage_garcon' => $pourcentage_garcon,
            'pourcentage_fille' => $pourcentage_fille,
            'nombre_louveteau_H' => $nombre_louvetier,
            'nombre_louveteau_F' => $nombre_louvetiere,
            'nombre_louveteau_G' => $nombre_louveteau,
            'nombre_louveteau_L' => $nombre_louvette,
            'pourcentage_louvetier' => $pourcentage_louvetier,
            'pourcentage_louvetiere' => $pourcentage_louvetiere,
            'pourcentage_louveteau' => $pourcentage_louveteau,
            'pourcentage_louvette' => $pourcentage_louvette,
            'nombre_troupier' => $nombre_troupier,
            'nombre_troupiere' => $nombre_troupiere,
            'nombre_eclaireur' => $nombre_eclaireur,
            'nombre_eclaireuse' => $nombre_eclaireuse,
            'pourcentage_troupier' => $pourcentage_troupier,
            'pourcentage_troupiere' => $pourcentage_troupiere,
            'pourcentage_eclaireur' => $pourcentage_eclaireur,
            'pourcentage_eclaireuse' => $pourcentage_eclaireuse,
            'nombre_safouin' => $nombre_safouin,
            'nombre_safouine' => $nombre_safouine,
            'nombre_cheminot' => $nombre_cheminot,
            'nombre_cheminote' => $nombre_cheminote,
            'pourcentage_safouin' => $pourcentage_safouin,
            'pourcentage_safouine' => $pourcentage_safouine,
            'pourcentage_cheminot' => $pourcentage_cheminot,
            'pourcentage_cheminote' => $pourcentage_cheminote,
            'nombre_coordinateur' => $nombre_coordinateur,
            'nombre_coordinatrice' => $nombre_coordinatrice,
            'nombre_routier' => $nombre_routier,
            'nombre_routiere' => $nombre_routiere,
            'pourcentage_coordinateur' => $pourcentage_coordinateur,
            'pourcentage_coordinatrice' => $pourcentage_coordinatrice,
            'pourcentage_routier' => $pourcentage_routier,
            'pourcentage_routiere' => $pourcentage_routiere,
            'region' => $region,
            'total' => $nombre_total
        ]);
    }
}
