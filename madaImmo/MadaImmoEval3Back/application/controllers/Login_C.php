<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Prime_C.php');
class Login_C extends CI_Controller
{

    /*
    * user session set example 
    * => $this -> session -> set_userdata("employe", $employe);
    * user session destroy example 
    * => $this -> session -> sess_destroy();
    */
    public static $controller_name = 'Login_C';

    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(TRUE);
        $this->load->model('Login_M');
        $this->load->model('InformationLocation_M');
    }

    public function index()
    {
        /*
        TODO :jerena raha misy session dna coockies de raha misy de tsy makaty intsony
        */
        $data['titre_page'] = "Login des administrateur";
        $data['meta'] = $this->SEO_M->getMetadataBaliseByTitrePage($data['titre_page']);

        $this->load->view('pages/login');
    }
    public function adminSignIn()
    {
        $data['titre_page'] = "Login des administrateur";
        $data['meta'] = $this->SEO_M->getMetadataBaliseByTitrePage($data['titre_page']);

        $this->load->view('pages/login');
    }
    public function userSignIn()
    {
        $this->output->enable_profiler(TRUE);
        $data['s'] = "UwU OwO UwO (-W-)";
        $UserName = $this->input->post("userName");
        $mdp = $this->input->post("mdp");

        $loginProcessInfo = $this->Login_M->getCorrespondingAdmin($UserName, $mdp);
        $this->session->set_userdata("AdminInfo", true);

        if ($loginProcessInfo) {
            if (isset($_SESSION["AdminInfo"])) {
                $this->session->unset_userdata('AdminInfo');
                $this->session->set_userdata("AdminInfo", $loginProcessInfo);
            }
            $this->session->set_userdata("LogInfo", $loginProcessInfo);
            $data['titre_page'] = "Accueil";
            $data['meta'] = $this->SEO_M->getMetadataBaliseByTitrePage($data['titre_page']);
            $data['biens_en_vedette'] = $this->InformationLocation_M->getPhotosByReferenceBien('v110');;

            $this->load->view('static/header', $data);
            $this->load->view('pages/accueil', $data);
            $this->load->view('static/footer');
        } else {
            redirect("/?var=true");
        }
    }
    public function accueil()
    {
        $data['titre_page'] = "Accueil";
        $data['meta'] = $this->SEO_M->getMetadataBaliseByTitrePage($data['titre_page']);
        $data['biens_en_vedette'] = $this->InformationLocation_M->getPhotosByReferenceBien('v110');;
        $this->load->view('static/header', $data);
        $this->load->view('pages/accueil', $data);
        $this->load->view('static/footer');
    }

    // public function accueil()
    // {
    //     $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
    //     // Définir le temps de cache en secondes (1 minute = 60 secondes)
    //     $cache_time = 600;

    //     // Vérifier si la vue est déjà en cache
    //     $cached_view = $this->cache->get('accueil_page');

    //     if ($cached_view === FALSE) {
    //         $data['titre_page'] = "Accueil";
    //         $data['meta'] = $this->SEO_M->getMetadataBaliseByTitrePage($data['titre_page']);
    //         $data['biens_en_vedette'] = $this->InformationLocation_M->getPhotosByReferenceBien('v110');

    //         $header = $this->load->view('static/header', $data, TRUE);
    //         $content = $this->load->view('pages/accueil', $data, TRUE);
    //         $footer = $this->load->view('static/footer', $data, TRUE);

    //         // Combiner les vues en une seule
    //         $view = $header . $content . $footer;

    //         // Mettre la vue en cache
    //         $this->cache->save('accueil_page', $view, $cache_time);
    //     } else {
    //         $view = $cached_view;
    //     }
    // }
    public function goToSignUpPage()
    {
        $this->load->view('pages/signUp');
    }

    public function Deconnexion()
    {
        $this->session->sess_destroy();
        redirect("/");
    }
}
