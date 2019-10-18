<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Scout;
use AppBundle\Utilities\GestionCotisation;
use AppBundle\Utilities\GestionScout;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Utilities\CinetPay;

/**
 * Class CinetpayController
 * @Route("/cinetpay")
 */
class CinetpayController extends Controller
{
    /**
     * @Route("/notify", name="cintepay_notification")
     * @Method({"GET","POST"})
     */
    public function indexAction(Request $request, GestionScout $gestionScout, GestionCotisation $gestionCotisation)
    {
        $em =$this->getDoctrine()->getManager();
        $cpmTransId = $request->get('cpm_trans_id'); //dump($cpmTransId);die();
        if (isset($cpmTransId)) {
            // SDK PHP de CinetPay

            try {
                // Initialisation de CinetPay et Identification du paiement
                //$id_transaction = $_POST['cpm_trans_id'];

                $id_transaction = $cpmTransId;
                $apiKey = '18714242495c8ba3f4cf6068.77597603';
                $site_id = 422630;
                $plateform = "PROD"; // Valorisé à PROD si vous êtes en production
                $version = "V1"; // Valorisé à V1 si vous voulez utiliser la version 1 de l'api
                $CinetPay = new CinetPay($site_id, $apiKey, $plateform, $version);
                //$CinetPay = new \CinetPay($site_id, $apiKey, $plateform, $version);
                // Reprise exacte des bonnes données chez CinetPay
                $CinetPay->setTransId($id_transaction)->getPayStatus();
                $cpm_site_id = $CinetPay->_cpm_site_id;
                $signature = $CinetPay->_signature;
                $cpm_amount = $CinetPay->_cpm_amount;
                $cpm_trans_id = $CinetPay->_cpm_trans_id;
                $cpm_custom = $CinetPay->_cpm_custom;
                $cpm_currency = $CinetPay->_cpm_currency;
                $cpm_payid = $CinetPay->_cpm_payid;
                $cpm_payment_date = $CinetPay->_cpm_payment_date;
                $cpm_payment_time = $CinetPay->_cpm_payment_time;
                $cpm_error_message = $CinetPay->_cpm_error_message;
                $payment_method = $CinetPay->_payment_method;
                $cpm_phone_prefixe = $CinetPay->_cpm_phone_prefixe;
                $cel_phone_num = $CinetPay->_cel_phone_num;
                $cpm_ipn_ack = $CinetPay->_cpm_ipn_ack;
                $created_at = $CinetPay->_created_at;
                $updated_at = $CinetPay->_updated_at;
                $cpm_result = $CinetPay->_cpm_result;
                $cpm_trans_status = $CinetPay->_cpm_trans_status;
                $cpm_designation = $CinetPay->_cpm_designation;
                $buyer_name = $CinetPay->_buyer_name;

                if ($cpm_result == '00'){
                    // requete  d'existence dans la table user_info
                    $userInfo = $em->getRepository("AppBundle:UserInfos")->findOneBy(['idTransaction'=>$cpmTransId]);
                    if ($userInfo){
                        $scout = new Scout();

                        // generation du matricule
                        $matricule = $gestionScout->matricule($userInfo->getGroupe());

                        $scout->setNom($userInfo->getFirstName());
                        $scout->setPrenoms($userInfo->getLastName());
                        $scout->setDatenaiss($userInfo->getBirthday());
                        $scout->setLieunaiss($userInfo->getBirthLocation());
                        $scout->setSexe($userInfo->getSexeAdh());
                        $scout->setContact($userInfo->getNumPerso());
                        $scout->setContactParent($userInfo->getPhone());
                        $scout->setMatricule($matricule);
                        // fonction
                        $fonction = $em->getRepository("AppBundle:Fonctions")->findOneBy(['id'=>$userInfo->getFonctions()->getId()]);
                        $scout->setFonction($fonction->getLibelle());
                        if ($fonction->getId() < 5){
                            $scout->setBranche($fonction->getLibelle());
                            $statut = $em->getRepository("AppBundle:Statut")->findOneBy(['id'=>1]);
                            $scout->setStatut($statut);
                        }else{
                            $scout->setBranche($userInfo->getBranche());
                            $statut = $em->getRepository("AppBundle:Statut")->findOneBy(['id'=>2]);
                            $scout->setStatut($statut);
                        }

                        // Cotisation
                        $scout->setCotisation($gestionScout->cotisation());
                        // statut
                        // groupe
                        $scout->setGroupe($userInfo->getGroupe());

                        // Verification de l'existence du scout dans le système pour cette année scoute
                        $existe = $gestionScout->verifExistence($userInfo->getLastName(),$userInfo->getFirstName(),$userInfo->getBirthday(),$userInfo->getBirthLocation());
                        if ($existe){
                            $message = "Vous êtes déjà inscrit(e) pour cette année scoute. Veuillez re-essayer à partir de septembre prochain";
                            return $this->render('default/404.html.twig', ['message'=>$message]);
                        }

                        $em->persist($scout);
                        $em->flush();

                        $gestionScout->carte($scout->getId());
                        $gestionCotisation->save($scout->getId());

                        return $this->redirectToRoute('scout_carte',['matricule'=>$scout->getMatricule()]);
                    }
                }else{
                    die('errer');
                }
            } catch (Exception $e) {
                echo "Erreur :" . $e->getMessage();
                // Une erreur s'est produite
            }
        } else {
            // Tentative d'accès direct au lien IPN
        }
        return $this->redirectToRoute('http://inscription.scoutascci.org');
    }
}
