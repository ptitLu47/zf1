<?php
/**
 * @author Lu
 * @desc Controller pour les erreurs
 *
 */

class Core_ErrorController extends Zend_Controller_Action
{
    public function errorAction()
    {
        $errorHandler = $this->_getParam("error_handler");
        switch($errorHandler->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION :
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER :
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE :
                $this->view->message = "Document not found";
                $this->getResponse()->setHttpResponseCode(404);
                break;
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_OTHER :
                $this->view->message = "Internal Error";
                $this->getResponse()->setHttpResponseCode(500);
                break;
            default :
                $this->view->message = "";
                $this->getResponse()->setHttpResponseCode(200);
        }
        $this->view->exception = $errorHandler->exception;
    }
}