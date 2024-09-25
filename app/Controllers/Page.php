<?php

namespace App\Controllers;

// include "/vendor/autoload.php";
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

class Page extends BaseController
{
    protected $helpers = ['form', 'global']; 

    public function index()
    {
        return view('home');
    }

    public function login()
    {
        if($this->request->getPost('submit')){

			if($this->request->getPost('user_name') == '' || $this->request->getPost('password') == '') {
				$this->session->setFlashdata('warning', 'Please input both user name and password!');
                
                return view('auth/login');
			}

            if($this->request->getPost('user_name') != 'admin' || $this->request->getPost('password') != 'admin') {
				$this->session->setFlashdata('warning', 'User name or password is incorrect');
                
                return view('auth/login');
			}

            $this->session->set('user', array(
                'role' => 'admin',
                'name' => 'admin'
            ));

			return redirect()->to('/applications');
		}
		else{
			$this->session->remove('user');
			return view('auth/login');
		}
    }

    public function logout() {
        $this->session->remove('user');
        return redirect()->to('/login');
    }

    public function applications()
    {
        if(!$this->session->has('user')) {
            return redirect()->to('/login');
        }

        $data = array(
            'title' => 'Applications',
            'sub_page' => 'applications'
        );

        return view('dashboard/basic', $data);
    }

    public function applicationView($application_id)
    {
        if(!$this->session->has('user')) {
            return redirect()->to('/login');
        }

        $db = db_connect();
        $query = $db->query('SELECT applications.*, application_users.* FROM applications JOIN application_users ON applications.application_user_id = application_users.id WHERE applications.id="'.$application_id.'" GROUP BY applications.application_user_id');

        $application_data = null;
        foreach($query->getResult() as $application) {
            $application_data = $application;
            $application_data->company = json_decode($application->companies, true);
            $application_data->reference = json_decode($application->references, true);
            break;
        }

        $data = array(
            'title' => 'Application View',
            'sub_page' => 'view',
            'application' => $application_data,
            'application_id' => $application_id
        );

        return view('dashboard/basic', $data);
    }

    public function qr()
    {
        // if(!$this->session->has('user')) {
        //     return redirect()->to('/login');
        // }

        $data = array(
            'title' => 'Dashboard',
            'sub_page' => 'qr',
            'qr_code_img' => file_exists(FCPATH.'/qrcode.png') ? base_url('/qrcode.png') : ''
        );

        return view('dashboard/basic', $data);
    }

    public function generateQR() {
        $result = Builder::create()
        ->writer(new PngWriter())
        ->writerOptions([])
        ->data(isset($_POST['url']) ? $_POST['url'] : '')
        ->encoding(new Encoding('UTF-8'))
        ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
        ->size(300)
        ->margin(10)
        ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
        // ->logoPath(APPPATH.'../public/assets/images/qr-logo.jpg')
        // ->labelText('This is the label1')
        // ->labelFont(new NotoSans(20))
        // ->labelAlignment(new LabelAlignmentCenter())
        ->build();

        // Directly output the QR code
        header('Content-Type: '.$result->getMimeType());
        // echo $result->getString();

        // Save it to a file
        $result->saveToFile(FCPATH.'/qrcode.png');

        // Generate a data URI to include image data inline (i.e. inside an <img> tag)
        $dataUri = $result->getDataUri();
        echo json_encode(array(
            'success' => true,
            'qr_img' => "<img src='".$dataUri."'>"
        ));
    }

    public function apply()
    {
        return view('apply');
    }

    public function applyView($application_id)
    {
        $db = db_connect();
        $query = $db->query('SELECT applications.*, application_users.* FROM applications JOIN application_users ON applications.application_user_id = application_users.id WHERE applications.id="'.$application_id.'" GROUP BY applications.application_user_id');

        $application_data = null;
        foreach($query->getResult() as $application) {
            $application_data = $application;
            $application_data->company = json_decode($application->companies, true);
            $application_data->reference = json_decode($application->references, true);
            break;
        }

        $data = array(
            'application' => $application_data,
            'application_id' => $application_id
        );

        return view('apply_view', $data);
    }

    public function qrTest()
    {
        $result = Builder::create()
        ->writer(new PngWriter())
        ->writerOptions([])
        ->data('http://jpdinvestmentsllc.com/apply')
        ->encoding(new Encoding('UTF-8'))
        ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
        ->size(300)
        ->margin(10)
        ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
        // ->logoPath(APPPATH.'../public/assets/images/qr-logo.jpg')
        // ->labelText('This is the label1')
        // ->labelFont(new NotoSans(20))
        // ->labelAlignment(new LabelAlignmentCenter())
        ->build();

        // Directly output the QR code
        header('Content-Type: '.$result->getMimeType());
        // echo $result->getString();

        // Save it to a file
        $result->saveToFile(__DIR__.'/qrcode.png');

        // Generate a data URI to include image data inline (i.e. inside an <img> tag)
        $dataUri = $result->getDataUri();
        echo "<img src='".$dataUri."'>";
    }

    public function apiApplicantsLoad()
    {
        $db = db_connect();
        $query = $db->query('SELECT applications.id, application_users.first_name, application_users.last_name, application_users.middle_name, application_users.email, application_users.cell_phone, applications.status  FROM applications JOIN application_users ON applications.application_user_id = application_users.id GROUP BY applications.application_user_id');

        $resp_data = array();
        foreach($query->getResult() as $application) {
            $resp_data[] = array(
                $application->first_name." ".$application->middle_name." ".$application->last_name,
                $application->email,
                $application->cell_phone,
                $application->status,
                '<div class="btn-group-wrap d-flex align-items-center">
                    <div class="btn-group btn-group-actions">
                        <button type="button" class="btn btn-default">Action</button>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <span class="dropdown-item action-view" style="cursor: pointer" application-id="'.$application->id.'">View</span>
                            <span class="dropdown-item action-delete" style="cursor: pointer" application-id="'.$application->id.'">Delete</span>
                        </div>
                    </div>
                    <div class="actions-loading-wrap">
                        <div class="actions-loader"></div>
                    </div>
                </div>',
            );
        }
        

        echo json_encode(array(
            'data' => $resp_data
        ));
    }

    public function submitApplication() {
        // echo json_encode($_POST);die();
        $db = db_connect();
        $query = $db->query("INSERT INTO application_users(`first_name`, `last_name`, `middle_name`, `preferred_first_name`, `email`, `cell_phone`, `home_phone`, `country`, `address1`, `address2`, `city`, `state`, `zip`) VALUES('".(isset($_POST["first_name"]) ? $_POST["first_name"] : '')."', '".(isset($_POST["last_name"]) ? $_POST["last_name"] : '')."', '".(isset($_POST["middle_name"]) ? $_POST["middle_name"] : '')."', '".(isset($_POST["preferred_first_name"]) ? $_POST["preferred_first_name"] : '')."', '".(isset($_POST["email"]) ? $_POST["email"] : '')."', '".(isset($_POST["cell_phone"]) ? $_POST["cell_phone"] : '')."', '".(isset($_POST["home_phone"]) ? $_POST["home_phone"] : '')."', '".(isset($_POST["country"]) ? $_POST["country"] : '')."', '".(isset($_POST["address1"]) ? $_POST["address1"] : '')."', '".(isset($_POST["address2"]) ? $_POST["address2"] : '')."', '".(isset($_POST["city"]) ? $_POST["city"] : '')."', '".(isset($_POST["state"]) ? $_POST["state"] : '')."', '".(isset($_POST["zip"]) ? $_POST["zip"] : '')."')");
        $application_user_id = $db->insertID();

        $companies = [];
        if(isset($_POST['company'])) {
            foreach($_POST['company'] as $company) {
                $companies[] = array(
                    'name' => $company['name'],
                    'address' => $company['address'],
                    'city' => $company['city'],
                    'state' => $company['state'],
                    'phone' => $company['phone'],
                    'date_from' => $company['date_from'],
                    'date_to' => $company['date_to'],
                    'salary_starting' => $company['salary_starting'],
                    'salary_ending' => $company['salary_ending'],
                    'job' => $company['job'],
                    'supervisor' => $company['supervisor'],
                    'reason_leaving' => $company['reason_leaving'],
                    'brief_description' => $company['brief_description']
                );
            }
        }

        $references = [];
        if(isset($_POST['reference'])) {
            foreach($_POST['reference'] as $reference) {
                $references[] = array(
                    'name' => $reference['name'],
                    'email' => $reference['email'],
                    'phone' => $reference['phone'],
                    'personal_work' => $reference['personal_work'],
                    'years' => $reference['years']
                );
            }
        }

        $query = $db->query("INSERT INTO applications(`application_user_id`, `location_apply_for`, `before_apply`, `age_18`, `how_hear`, `how_hear_referred`, `start_date`, `perform_essential_functions`, `restaurant_experience_food_preparation`, `restaurant_experience_sanitation`, `able_work_nights`, `food_handler_permit`, `obtain_food_handler_permit`, `available_to_work`, `companies`, `references`) VALUES('".($application_user_id)."', '".(isset($_POST["location_apply_for"]) ? $_POST["location_apply_for"] : '')."', '".(isset($_POST["before_apply"]) ? $_POST["before_apply"] : '')."', '".(isset($_POST["age_18"]) ? $_POST["age_18"] : '')."', '".(isset($_POST["how_hear"]) ? $_POST["how_hear"] : '')."', '".(isset($_POST["how_hear_referred"]) ? $_POST["how_hear_referred"] : '')."', '".(isset($_POST["start_date"]) ? $_POST["start_date"] : '')."', '".(isset($_POST["perform_essential_functions"]) ? $_POST["perform_essential_functions"] : '')."', '".(isset($_POST["restaurant_experience_food_preparation"]) ? $_POST["restaurant_experience_food_preparation"] : '')."', '".(isset($_POST["restaurant_experience_sanitation"]) ? $_POST["restaurant_experience_sanitation"] : '')."', '".(isset($_POST["able_work_nights"]) ? $_POST["able_work_nights"] : '')."', '".(isset($_POST["food_handler_permit"]) ? $_POST["food_handler_permit"] : '')."', '".(isset($_POST["obtain_food_handler_permit"]) ? $_POST["obtain_food_handler_permit"] : '')."', '".(isset($_POST["available_to_work"]) ? $_POST["available_to_work"] : '')."', '".json_encode($companies)."', '".json_encode($references)."')");
        $application_id = $db->insertID();
        
        // send email
        if(isset($_POST['location_apply_for'])) {
            if($_POST['location_apply_for'] == '1') {
                $to = 'clearlake@salata.com';
                $store = 'Salata Clear Lake';
            }
            else if($_POST['location_apply_for'] == '2') {
                $to = 'baybrook@salata.com';
                $store = 'Salata Baybrook';
            }
            else if($_POST['location_apply_for'] == '3') {
                $to = 'pasadena@salata.com';
                $store = 'Salata Pasadena';
            }
            else if($_POST['location_apply_for'] == '4') {
                $to = 'pinnaclepark@salata.com';
                $store = 'Salata League City';
            }
            else if($_POST['location_apply_for'] == '5') {
                $to = 'kingwood@salata.com';
                $store = 'Salata Kingwood';
            }
            else if($_POST['location_apply_for'] == '6') {
                $to = 'westlake@salata.com';
                $store = 'Salata Westlake';
            }
            else if($_POST['location_apply_for'] == '7') {
                $to = 'louettapines@salata.com';
                $store = 'Salata Louetta Pines';
            }
            // $to = 'jaygangkun@hotmail.com';
            // $to = 'munjeet.singh@gmail.com';

            $name = (isset($_POST["first_name"]) ? $_POST["first_name"] : '').' '.(isset($_POST["middle_name"]) ? $_POST["middle_name"] : '').' '.(isset($_POST["last_name"]) ? $_POST["last_name"] : '');
            $link = base_url('/apply-view/'.$application_id);

            if($to != '') {
                sendMail($to, 'Submit New Candidate', 'New Candidate named <strong>'.$name.'</strong> has submitted an application for '.$store.', click <a href="'.$link.'">here</a> to review');
            }
        }
        
        
        echo json_encode(array(
            'success' => true
        ));
    }

    public function updateApplication() {
        if(!isset($_POST['application_id']) || $_POST['application_id'] == '') {
            echo json_encode(array(
                'success' => false,
                'message' => 'No Application ID'
            ));
            die();
        }

        $db = db_connect();
        $query = $db->query("SELECT * FROM applications WHERE id='".$_POST['application_id']."'");
        $application_user_id = null;
        foreach($query->getResult() as $application) {
            $application_user_id = $application->application_user_id;
            break;
        }

        if($application_user_id) {
            $query = $db->query("UPDATE application_users SET `first_name`='".(isset($_POST["first_name"]) ? $_POST["first_name"] : '')."', `last_name`='".(isset($_POST["last_name"]) ? $_POST["last_name"] : '')."', `middle_name`='".(isset($_POST["middle_name"]) ? $_POST["middle_name"] : '')."', `preferred_first_name`='".(isset($_POST["preferred_first_name"]) ? $_POST["preferred_first_name"] : '')."', `email`='".(isset($_POST["email"]) ? $_POST["email"] : '')."', `cell_phone`='".(isset($_POST["cell_phone"]) ? $_POST["cell_phone"] : '')."', `home_phone`='".(isset($_POST["home_phone"]) ? $_POST["home_phone"] : '')."', `country`='".(isset($_POST["country"]) ? $_POST["country"] : '')."', `address1`='".(isset($_POST["address1"]) ? $_POST["address1"] : '')."', `address2`='".(isset($_POST["address2"]) ? $_POST["address2"] : '')."', `city`='".(isset($_POST["city"]) ? $_POST["city"] : '')."', `state`='".(isset($_POST["state"]) ? $_POST["state"] : '')."', `zip`='".(isset($_POST["zip"]) ? $_POST["zip"] : '')."' WHERE id='".$application_user_id."'");    
        }
        
        $companies = [];
        if(isset($_POST['company'])) {
            foreach($_POST['company'] as $company) {
                $companies[] = array(
                    'name' => $company['name'],
                    'address' => $company['address'],
                    'city' => $company['city'],
                    'state' => $company['state'],
                    'phone' => $company['phone'],
                    'date_from' => $company['date_from'],
                    'date_to' => $company['date_to'],
                    'salary_starting' => $company['salary_starting'],
                    'salary_ending' => $company['salary_ending'],
                    'job' => $company['job'],
                    'supervisor' => $company['supervisor'],
                    'reason_leaving' => $company['reason_leaving'],
                    'brief_description' => $company['brief_description']
                );
            }
        }

        $references = [];
        if(isset($_POST['reference'])) {
            foreach($_POST['reference'] as $reference) {
                $references[] = array(
                    'name' => $reference['name'],
                    'email' => $reference['email'],
                    'phone' => $reference['phone'],
                    'personal_work' => $reference['personal_work'],
                    'years' => $reference['years']
                );
            }
        }

        $query = $db->query("UPDATE applications SET `status`='".(isset($_POST["status"]) ? $_POST["status"] : '')."', `location_apply_for`='".(isset($_POST["location_apply_for"]) ? $_POST["location_apply_for"] : '')."', `before_apply`='".(isset($_POST["before_apply"]) ? $_POST["before_apply"] : '')."', `age_18`='".(isset($_POST["age_18"]) ? $_POST["age_18"] : '')."', `how_hear`='".(isset($_POST["how_hear"]) ? $_POST["how_hear"] : '')."', `how_hear_referred`='".(isset($_POST["how_hear_referred"]) ? $_POST["how_hear_referred"] : '')."', `start_date`='".(isset($_POST["start_date"]) ? $_POST["start_date"] : '')."', `perform_essential_functions`='".(isset($_POST["perform_essential_functions"]) ? $_POST["perform_essential_functions"] : '')."', `restaurant_experience_food_preparation`='".(isset($_POST["restaurant_experience_food_preparation"]) ? $_POST["restaurant_experience_food_preparation"] : '')."', `restaurant_experience_sanitation`='".(isset($_POST["restaurant_experience_sanitation"]) ? $_POST["restaurant_experience_sanitation"] : '')."', `able_work_nights`='".(isset($_POST["able_work_nights"]) ? $_POST["able_work_nights"] : '')."', `food_handler_permit`='".(isset($_POST["food_handler_permit"]) ? $_POST["food_handler_permit"] : '')."', `obtain_food_handler_permit`='".(isset($_POST["obtain_food_handler_permit"]) ? $_POST["obtain_food_handler_permit"] : '')."', `available_to_work`='".(isset($_POST["available_to_work"]) ? $_POST["available_to_work"] : '')."', `companies`='".json_encode($companies)."', `references`='".json_encode($references)."' WHERE id='".$_POST['application_id']."'");
        

        echo json_encode(array(
            'success' => true
        ));
    }

    public function deleteApplication() {
        if(!isset($_POST['application_id']) || $_POST['application_id'] == '') {
            echo json_encode(array(
                'success' => false,
                'message' => 'No Application ID'
            ));
            die();
        }

        $db = db_connect();
        $query = $db->query("SELECT * FROM applications WHERE id='".$_POST['application_id']."'");
        $application_user_id = null;
        foreach($query->getResult() as $application) {
            $application_user_id = $application->application_user_id;
            break;
        }

        $query = $db->query("DELETE FROM applications WHERE id='".$_POST['application_id']."'");

        $query = $db->query("DELETE FROM application_users WHERE id='".$application_user_id."'");

        echo json_encode(array(
            'success' => true
        ));
    }

    public function test() {
        echo sendMail('jaygangkun@hotmail.com', 'Test', 'Test email');
    }
}
