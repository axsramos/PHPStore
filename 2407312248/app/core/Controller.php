<?php

namespace app\core;

require_once('../app/shared/message_dictionary.php');
require_once('../app/shared/request_headers_token.php');
require_once('../app/shared/validate_token_session.php');

class Controller {
  public function model($model) {
    require '../app/models/' . $model . '.php';
    $classe = 'app\\models\\' . $model;
    return new $classe();
  }

  public function view(string $view, $data = []) {
    require '../app/views/' . $view . '.php';
  }

  public function pageAccessDined() {
    $this->view('erro401');
  }

  public function pageNotFound() {
    $this->view('erro404');
  }

  public function methodNotAllowed() {
    $this->view('erro405');
  }

  public function noContent() {
    $this->view('status204');
  }

  protected function verifyIdentity() {
    if($GLOBALS['identity'] == '') {
      $this->pageAccessDined();
      return FALSE;
    } else {
        return TRUE;
    }
  }

  protected function checkMethod($message, $methods) {
    if(substr(filter_input(INPUT_SERVER, 'REQUEST_URI'), 1) == 'token') {
      return TRUE;
    } else {
      if($this->verifyIdentity()) {
        if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
          http_response_code(200);
          $messages = array();
    
          array_push($messages, $message->getDictionaryError(0, "Messages", "Accept Method: " . implode(',', $methods)));
          $data = array("Messages" => $messages);
    
          $this->view('json_result', $data);
        } else {
          if(in_array($_SERVER['REQUEST_METHOD'], $methods)) {
            return TRUE;
          } else {
              $this->methodNotAllowed();
          }
        }
      }
      return FALSE;
    }
  }
  
}