<?php

class MessageDictionary {

    const TYPE_MESSAGE_SUCCESS = "SUCCESS";
    const TYPE_MESSAGE_INFORMATION = "INFORMATION";
    const TYPE_MESSAGE_WARNING = "WARNING";
    const TYPE_MESSAGE_ERROR = "ERROR";
    
    private $message;

    public function getDictionaryError($code, $title = 'Message', $description = '') {
        switch ($code) {
            case 0:
                $this->message["code"] = $code;
                $this->message["type"] = self::TYPE_MESSAGE_SUCCESS;
                $this->message["title"] = $title;
                $this->message["message"] = $description;
                break;
            case 1:
                $this->message["code"] = $code;
                $this->message["type"] = self::TYPE_MESSAGE_ERROR;
                $this->message["title"] = $title;
                $this->message["message"] = $description;
                break;
            case 2:
                $this->message["code"] = $code;
                $this->message["type"] = self::TYPE_MESSAGE_WARNING;
                $this->message["title"] = $title;
                $this->message["message"] = $description;
                break;
            case 3:
                $this->message["code"] = $code;
                $this->message["type"] = self::TYPE_MESSAGE_INFORMATION;
                $this->message["title"] = $title;
                $this->message["message"] = $description;
                break;
            default:
                $this->message["code"] = $code;
                $this->message["type"] = self::TYPE_MESSAGE_INFORMATION;
                $this->message["title"] = $title;
                $this->message["message"] = $description;
        }

        return $this->message;
    }
}