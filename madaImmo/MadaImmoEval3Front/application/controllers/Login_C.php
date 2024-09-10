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

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_M');
        $this->load->model('Proprietaire_M');
    }

    public function index()
    {
        $this->load->view('pages/accueil');
    }
    public function adminSignIn()
    {
        $this->load->view('pages/login');
    }
    public function clientRedirection()
    {
        $choice = $this->input->post("typeClient");
        if ($choice == "locataire") {
            redirect("Login_C/locataireForm");
        }
        redirect("Login_C/proprietaireForm");
    }
    public function locataireForm()
    {
        $this->load->view('pages/locataire/LoginLocataire_V');
    }
    public function proprietaireForm()
    {
        $this->load->view('pages/proprio/LoginProprietaire_V');
    }
    public function locataireLogin()
    {
        $this->load->model('InformationLocation_M');
        
        $this->output->enable_profiler(TRUE);
        $data['s'] = "UwU OwO UwO (-W-)";
        $email = $this->input->post("email");
        $loginProcessInfo = $this->Login_M->getCorrespondingLocataire($email);
        
        $date_debut="1900-01-01";
        $date_fin="2100-01-01";
        $data['information_location'] = $this->InformationLocation_M->getInformationLocation($date_debut, $date_fin, $email);
        
        $this->session->set_userdata("LocataireInfo", true);

        if ($loginProcessInfo) {
            if (isset($_SESSION["LocataireInfo"])) {
                $this->session->unset_userdata('LocataireInfo');
                $this->session->set_userdata("LocataireInfo", $loginProcessInfo);
            }
            $this->session->set_userdata("LogInfo", $loginProcessInfo);
            $this->load->view('static/header');
            $this->load->view('pages/Information_location_v', $data);
            $this->load->view('static/footer');
        } else {
            redirect("Login_C/locataireForm/?var=true");
        }
    }
    public function proprietaireLogin()
    {
        $this->output->enable_profiler(TRUE);
        $data['s'] = "UwU OwO UwO (-W-)";
        $conatct = $this->input->post("contact");
        $loginProcessInfo = $this->Login_M->getCorrespondingProprietaire($conatct);
        $this->session->set_userdata("ProprietaireInfo", true);
        $conatct = 0;
        if ($loginProcessInfo) {
            if (isset($_SESSION["ProprietaireInfo"])) {
                $this->session->unset_userdata('ProprietaireInfo');
                $this->session->set_userdata("ProprietaireInfo", $loginProcessInfo);
                $proprio = $_SESSION['ProprietaireInfo'];
                $contact = $proprio['contact'];
            }
            $this->session->set_userdata("LogInfo", $loginProcessInfo);

            $data['biens'] = $this->Proprietaire_M->getProprieteByContactProprietaire($contact);
            $this->load->view('static/header');
            $this->load->view('pages/proprio/ListeBiens_V', $data);
            $this->load->view('static/footer');
        } else {
            redirect("Login_C/proprietaireForm/?var=true");
        }
    }
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
