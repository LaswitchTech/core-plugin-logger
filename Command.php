<?php

// Import additionnal class into the global namespace
use LaswitchTech\Core\Abstracts\Command;

class LoggerCommand extends Command {

    // Constants
    const DEBUG_LABEL = 'DEBUG';
    const INFO_LABEL = 'INFO';
    const SUCCESS_LABEL = 'SUCCESS';
    const WARNING_LABEL = 'WARNING';
    const ERROR_LABEL = 'ERROR';
    const DEBUG_LEVEL = 5;
    const INFO_LEVEL = 4;
    const SUCCESS_LEVEL = 3;
    const WARNING_LEVEL = 2;
    const ERROR_LEVEL = 1;

    /**
     * Constructor
     */
    public function __construct()
    {
        // Call Parent Constructor
        parent::__construct();
    }

    /**
     * Set log level
     */
    public function setAction()
    {
        // Check if the user provided a log level
        if(!$this->Request->getArguments(3)){
            $this->Output->error("Please provide a log level.");
            $this->Output->print("Usage: " . $this->Request->getArguments(0) . " logger set <level>");
            $this->Output->print("Available levels: debug, info, success, warning, error");
            return;
        }

        // Retrieve the log level from the arguments
        $level = strtoupper($this->Request->getArguments(3));

        // Check if the log level is valid
        switch($level) {
            case self::DEBUG_LABEL:
                $this->Config->set('log', 'level', self::DEBUG_LEVEL);
                break;
            case self::INFO_LABEL:
                $this->Config->set('log', 'level', self::INFO_LEVEL);
                break;
            case self::SUCCESS_LABEL:
                $this->Config->set('log', 'level', self::SUCCESS_LEVEL);
                break;
            case self::WARNING_LABEL:
                $this->Config->set('log', 'level', self::WARNING_LEVEL);
                break;
            case self::ERROR_LABEL:
                $this->Config->set('log', 'level', self::ERROR_LEVEL);
                break;
            default:
                $this->Output->error("Invalid log level: " . $level);
                return;
        }

        // Output the status
        $this->statusAction();
    }

    /**
     * Check logger mode
     */
    public function statusAction()
    {
        // Output the stored value
        switch($this->Config->get('log', 'level')) {
            case self::DEBUG_LEVEL:
                $this->Output->print("Logger mode is set to ".self::DEBUG_LABEL.".");
                break;
            case self::INFO_LEVEL:
                $this->Output->print("Logger mode is set to ".self::INFO_LABEL.".");
                break;
            case self::SUCCESS_LEVEL:
                $this->Output->print("Logger mode is set to ".self::SUCCESS_LABEL.".");
                break;
            case self::WARNING_LEVEL:
                $this->Output->print("Logger mode is set to ".self::WARNING_LABEL.".");
                break;
            case self::ERROR_LEVEL:
                $this->Output->print("Logger mode is set to ".self::ERROR_LABEL.".");
                break;
            default:
                $this->Output->print("Logger mode is not set or invalid.");
        }
    }
}
