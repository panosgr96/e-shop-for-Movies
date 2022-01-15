<?php
//namespace ApiClass;
require_once("Enumerations.php");
class WebClient {
    public $ServerUrl="";
    public $ignorErrorCode = array();
    public $DataStr;
    public $httMethod;
    public $Timout;


    public function __construct($url =null) {
        $this->Timout =30;
        $this->DataStr ="";
        $this->httMethod = HttpMethod::Get;
        $this->ServerUrl =  $url;
        $this->ignorErrorCode = array();
        
    }
      
    public function Add_IgnorErrorCode($errorcode)
    {
       array_push($this->ignorErrorCode,$errorcode); 
    }
   
    private function GetErrorMessage($errorcode) {
        switch ($errorcode) {
            case 100: $text = 'Continue';
                break;
            case 101: $text = 'Switching Protocols';
                break;
            case 200: $text = 'OK';
                break;
            case 201: $text = 'Created';
                break;
            case 202: $text = 'Accepted';
                break;
            case 203: $text = 'Non-Authoritative Information';
                break;
            case 204: $text = 'No Content';
                break;
            case 205: $text = 'Reset Content';
                break;
            case 206: $text = 'Partial Content';
                break;
            case 300: $text = 'Multiple Choices';
                break;
            case 301: $text = 'Moved Permanently';
                break;
            case 302: $text = 'Moved Temporarily';
                break;
            case 303: $text = 'See Other';
                break;
            case 304: $text = 'Not Modified';
                break;
            case 305: $text = 'Use Proxy';
                break;
            case 400: $text = 'Bad Request';
                break;
            case 401: $text = 'Unauthorized';
                break;
            case 402: $text = 'Payment Required';
                break;
            case 403: $text = 'Permission denied.';
                break;
            case 404: $text = 'Not Found';
                break;
            case 405: $text = 'Method Not Allowed';
                break;
            case 406: $text = 'Not Acceptable';
                break;
            case 407: $text = 'Proxy Authentication Required';
                break;
            case 408: $text = 'Request Time-out';
                break;
            case 409: $text = 'Conflict';
                break;
            case 410: $text = 'Gone';
                break;
            case 411: $text = 'Length Required';
                break;
            case 412: $text = 'Precondition Failed';
                break;
            case 413: $text = 'Request Entity Too Large';
                break;
            case 414: $text = 'Request-URI Too Large';
                break;
            case 415: $text = 'Unsupported Media Type';
                break;
            case 500: $text = 'Internal Server Error';
                break;
            case 501: $text = 'Not Implemented';
                break;
            case 502: $text = 'Bad Gateway';
                break;
            case 503: $text = 'Service Unavailable';
                break;
            case 504: $text = 'Gateway Time-out';
                break;
            case 505: $text = 'HTTP Version not supported';
                break;
            default:
                $text = 'Unknown http status code ';
                break;
        }
        return 'Errorcode('.$errorcode.') '. $text;
    }
    
    public function Get_HttpServices() {
        try {
            $ch = curl_init($this->ServerUrl);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->httMethod);
            curl_setopt($ch, CURLOPT_TIMEOUT, $this->Timout);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->Timout);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
 //           curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  //          curl_setopt($ch, CURLOPT_USERPWD, $this->CurentLogin . ":" . $this->CurentPassword);
            curl_setopt($ch, CURLOPT_POSTFIELDS,  $this->DataStr);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($this->DataStr))
            );
            $result = curl_exec($ch);
            $curl_errno = curl_errno($ch);
            $curl_error = curl_error($ch);
            //   $header  = curl_getinfo( $ch,CURLINFO_EFFECTIVE_URL );
            if ($curl_errno > 0) {
                curl_close($ch);
                throw new Exception($curl_error);
            }
            $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $info = curl_getinfo($ch);
            curl_close($ch);
           
            if ($status_code != '200') {
                $countErr = count($this->ignorErrorCode);
                if ( $countErr> 0 ){
                    for ($index = 0; $index < $countErr; $index++) {
                        if ($this->ignorErrorCode[$index] == $status_code){
                            return $result;
                           // return json_decode($result, true);
                        }
                    }
                }
                throw new Exception($this->GetErrorMessage($status_code));
            }
 //           return json_decode($result, true);
            return $result;

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function HttpServices($DataString) {
        try {
            $ch = curl_init($this->ServerUrl);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->httMethod);
            curl_setopt($ch, CURLOPT_TIMEOUT, $this->Timout);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->Timout);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
 //           curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  //          curl_setopt($ch, CURLOPT_USERPWD, $this->CurentLogin . ":" . $this->CurentPassword);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $DataString);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($DataString))
            );
            $result = curl_exec($ch);
            $curl_errno = curl_errno($ch);
            $curl_error = curl_error($ch);
            //   $header  = curl_getinfo( $ch,CURLINFO_EFFECTIVE_URL );
            if ($curl_errno > 0) {
                curl_close($ch);
                throw new Exception($curl_error);
            }
            $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $info = curl_getinfo($ch);
            curl_close($ch);
           
            if ($status_code != '200') {
                $countErr = count($this->ignorErrorCode);
                if ( $countErr> 0 ){
                    for ($index = 0; $index < $countErr; $index++) {
                        if ($this->ignorErrorCode[$index] == $status_code){
                             return $result;
                           // return json_decode($result, true);
                        }
                    }
                }
                throw new Exception($this->GetErrorMessage($status_code));
            }
           // return json_decode($result, true);
            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());

        }
    }
}

