<?php

/**
 * Core Framework - LoggerEndpoint
 *
 * @license    MIT (https://mit-license.org/)
 * @author     Louis Ouellet <louis@laswitchtech.com>
 */

// Import additionnal class into the global namespace
use \LaswitchTech\Core\Objects;
use \LaswitchTech\Core\Abstracts\Endpoint;

class LoggerEndpoint extends Endpoint {

    /**
     * Constructor
     */
    public function __construct()
    {

        // Call Parent Constructor
        parent::__construct();

        // Retrieve the namespace
        $namespace = $this->Request->getNamespace();

        // Set Global access
        $this->Public = false;

        // Set Properties
        switch($namespace){
            case "/logger/set":
                $this->Level = 3;
                break;
            case "/logger/level":
            case "/logger/read":
                $this->Level = 1;
                break;
        }
    }

    /**
     * Set the Log level
     */
    public function setAction(): array
    {
        // Set the default message
        $message = ["status" => 200, "message" => "OK", "data" => []];

        // Check if the status is still OK
        if($message['status'] == 200){

            // Check the request method
            if($this->Request->getMethod() == "GET"){

                // Retrieve the log level
                $level = intval($this->Request->getParams("GET","level"));

                // Set the log level
                $this->Config->set("log","level",$level);

                // Set the message
                switch($level){
                    case 0:
                        $message["data"]["message"] = $this->Locale->get("Log level set to Diabled");
                        break;
                    case 1:
                        $message["data"]["message"] = $this->Locale->get("Log level set to Error");
                        break;
                    case 2:
                        $message["data"]["message"] = $this->Locale->get("Log level set to Warning");
                        break;
                    case 3:
                        $message["data"]["message"] = $this->Locale->get("Log level set to Success");
                        break;
                    case 4:
                        $message["data"]["message"] = $this->Locale->get("Log level set to Info");
                        break;
                    default:
                        $message["data"]["message"] = $this->Locale->get("Log level set to Debug");
                        break;
                }
            } else {

                // Set an error message
                $message = ["status" => 405, "message" => "Method Not Allowed", "data" => "Invalid Request"];
            }
        }

        // Return the message
        return $message;
    }

    /**
     * Retrieve the Log level
     */
    public function levelAction(): array
    {
        // Set the default message
        $message = ["status" => 200, "message" => "OK", "data" => []];

        // Check if the status is still OK
        if($message['status'] == 200){

            // Check the request method
            if($this->Request->getMethod() == "GET"){

                // Retrieve the log level
                $message["data"]["level"] = intval($this->Config->get("log","level"));

                // Set the message
                switch($message["data"]["level"]){
                    case 0:
                        $message["data"]["message"] = $this->Locale->get("Log level set to Diabled");
                        break;
                    case 1:
                        $message["data"]["message"] = $this->Locale->get("Log level set to Error");
                        break;
                    case 2:
                        $message["data"]["message"] = $this->Locale->get("Log level set to Warning");
                        break;
                    case 3:
                        $message["data"]["message"] = $this->Locale->get("Log level set to Success");
                        break;
                    case 4:
                        $message["data"]["message"] = $this->Locale->get("Log level set to Info");
                        break;
                    default:
                        $message["data"]["message"] = $this->Locale->get("Log level set to Debug");
                        break;
                }
            } else {

                // Set an error message
                $message = ["status" => 405, "message" => "Method Not Allowed", "data" => "Invalid Request"];
            }
        }

        // Return the message
        return $message;
    }

    /**
     * Read a log file
     */
    public function readAction(): array
    {
        // Set the default message
        $message = ["status" => 200, "message" => "OK", "data" => []];

        // Check if the status is still OK
        if($message['status'] == 200){

            // Check the request method
            if($this->Request->getMethod() == "GET"){

                // Retrieve the log file
                $file = $this->Request->getParams("GET","file");

                // Read the log file and set the message
                $message["data"]["file"] = $file;
                $message["data"]["entries"] = $this->Log->read($file);
            } else {

                // Set an error message
                $message = ["status" => 405, "message" => "Method Not Allowed", "data" => "Invalid Request"];
            }
        }

        // Return the message
        return $message;
    }
}
