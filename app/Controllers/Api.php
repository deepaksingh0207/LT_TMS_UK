<?php
namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Api extends BaseController {
    
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger) {
        parent::initController($request, $response, $logger);
    }

    public function writeToLogFile($message = null) {
        $directory_path = FCPATH ."logs";

        $directoryPresent = 0;
        if (!is_dir($directory_path)) {
            if (mkdir($directory_path, 0777, true)) {
                $directoryPresent = 1;
            }
        }
        else {
            $directoryPresent = 1;
        }

        if($directoryPresent) {
            $file_path = $directory_path.DIRECTORY_SEPARATOR."api_logs_".date('Y_m_d').".txt";
            
            if(!file_exists($file_path)) {
                file_put_contents($file_path,"\nFile Created - ".date("Y-m-d H:i:s")."\n");
            }

            $file = fopen($file_path , "a");
            if($file) {
                fwrite($file, "\n$message\n");
                fclose($file);
            }
        }
    }

    public function pushOrder() {
        $this->writeToLogFile("-----------------".date('Y-m-d H:i:s')."--------------------");
        $this->writeToLogFile("pushOrder() start");

        $request = file_get_contents('php://input');
        $this->writeToLogFile("Request Received is - \n".$request);

        $response = $request;

        $this->writeToLogFile("response sent is - \n".$response);
        $this->writeToLogFile("pushOrder() end");
        $this->writeToLogFile("-----------------".date('Y-m-d H:i:s')."--------------------");

        return $this->response->setJSON(json_decode($response,true));
    }

    

}