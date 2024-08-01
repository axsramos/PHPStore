<?php

use app\core\Controller;

class Identity extends Controller {
    private $data_content = [];

    public function index() {
        $message  = new MessageDictionary;
        $messages = array();
        $methods  = array('GET','POST','PUT','DELETE');

        if($this->checkMethod($message, $methods)) {
            
            $this->data_content = json_decode(file_get_contents('php://input'));

            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $this->id();
                    break;
                case 'POST':
                    $this->methodPost();
                    break;
                case 'PUT':
                    $this->methodPut();
                    break;
                default:
                    # code...
                    break;
            }
        }
    }

    public function id($id = null) {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            if($id == null) {
                $csCasIdy = $this->model('CasIdy');
                $csCasIdy->setCasIdyCod($GLOBALS['identity']);
                $data = $csCasIdy->readAllLines();
            } else {
                $csCasIdy = $this->model('CasIdy');
                $csCasIdy->setCasIdyCod($GLOBALS['identity']);
                $csCasIdy->setCasIdyCod($id);
                $data = $csCasIdy->readLine();
            }
        }
        if($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $this->methodDelete($id);
        } else {
            if($data == FALSE) {
                $this->noContent();
            } else {
                http_response_code(200);
                $this->view('json_result', array("results" => $data));
            }
        }
    }

    private function methodPost() {
        $message  = new MessageDictionary;
        $messages = array();
        
        $csCasIdy = $this->model('CasIdy');
        $csCasIdy->setCasIdyCod($GLOBALS['identity']);
        
        if(isset($this->data_content->CasIdyCod)) {
            $csCasIdy->setCasIdyCod($this->data_content->CasIdyCod);
        }
        if(isset($this->data_content->CasIdyDsc)) {
            $csCasIdy->setCasIdyDsc($this->data_content->CasIdyDsc);
        }
        if(isset($this->data_content->CasIdyBlq)) {
            $csCasIdy->setCasIdyBlq($this->data_content->CasIdyBlq);
        }
        if($csCasIdy->insertLine()) {
            http_response_code(201);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
        }
        $this->view('json_result', array("Messages" => $messages));
    }
    
    private function methodPut() {
        $message  = new MessageDictionary;
        $messages = array();
        
        $csCasIdy = $this->model('CasIdy');
        $csCasIdy->setCasIdyCod($GLOBALS['identity']);
        
        if(isset($this->data_content->CasIdyCod)) {
            $csCasIdy->setCasIdyCod($this->data_content->CasIdyCod);
        }
        if(isset($this->data_content->CasIdyDsc)) {
            $csCasIdy->setCasIdyDsc($this->data_content->CasIdyDsc);
        }
        if(isset($this->data_content->CasIdyBlq)) {
            $csCasIdy->setCasIdyBlq($this->data_content->CasIdyBlq);
        }
        if($csCasIdy->updateLine()) {
            http_response_code(202);
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            http_response_code(200);
            array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
        }
        $this->view('json_result', array("Messages" => $messages));
    }

    private function methodDelete($id) {
        $message  = new MessageDictionary;
        $messages = array();
        
        http_response_code(200);
        
        $csCasIdy = $this->model('CasIdy');
        $csCasIdy->setCasIdyCod($GLOBALS['identity']);
        $csCasIdy->setCasIdyCod($id);
        
        if($csCasIdy->deleteLine()) {
            array_push($messages, $message->getDictionaryError(0, "Messages", "Success."));
        } else {
            array_push($messages, $message->getDictionaryError(1, "Messages", "Failed."));
        }
        $this->view('json_result', array("Messages" => $messages));
    }
}
