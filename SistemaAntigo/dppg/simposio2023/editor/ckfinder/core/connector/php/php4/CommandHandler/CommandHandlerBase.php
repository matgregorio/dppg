<?php
/*
 * CKFinder
 * ========
 * http://ckfinder.com
 * Copyright (C) 2007-2012, CKSource - Frederico Knabben. All rights reserved.
 *
 * The software, this file and its contents are subject to the CKFinder
 * License. Please read the license.txt file before using, installing, copying,
 * modifying or distribute this file or part of its contents. The contents of
 * this file is part of the Source Code of CKFinder.
 */
if (!defined('IN_CKFINDER')) exit;

/**
 * @package CKFinder
 * @subpackage CommandHandlers
 * @copyright CKSource - Frederico Knabben
 */

/**
 * Base commands handler
 *
 * @package CKFinder
 * @subpackage CommandHandlers
 * @copyright CKSource - Frederico Knabben
 * @abstract
 *
 */
class CKFinder_Connector_CommandHandler_CommandHandlerBase
{
    /**
     * CKFinder_Connector_Core_Connector object
     *
     * @access protected
     * @var CKFinder_Connector_Core_Connector
     */
    var $_connector;
    /**
     * CKFinder_Connector_Core_FolderHandler object
     *
     * @access protected
     * @var CKFinder_Connector_Core_FolderHandler
     */
    var $_currentFolder;
    /**
     * Error handler object
     *
     * @access protected
     * @var CKFinder_Connector_ErrorHandler_Base|CKFinder_Connector_ErrorHandler_FileUpload|CKFinder_Connector_ErrorHandler_Http
     */
    var $_errorHandler;

    function CKFinder_Connector_CommandHandler_CommandHandlerBase()
    {
        $this->_currentFolder =& CKFinder_Connector_Core_Factory::getInstance("Core_FolderHandler");
        $this->_connector =& CKFinder_Connector_Core_Factory::getInstance("Core_Connector");
        $this->_errorHandler =& $this->_connector->getErrorHandler();
    }

    /**
     * Get Folder Handler
     *
     * @return CKFinder_Connector_Core_FolderHandler
     * @access public
     */
    function getFolderHandler()
    {
        if (is_null($this->_currentFolder)) {
            $this->_currentFolder =& CKFinder_Connector_Core_Factory::getInstance("Core_FolderHandler");
        }

        return $this->_currentFolder;
    }

    /**
     * Check whether Connector is enabled
     * @access protected
     *
     */
    function checkConnector()
    {
        $_config =& CKFinder_Connector_Core_Factory::getInstance("Core_Config");
        if (!$_config->getIsEnabled()) {
            $this->_errorHandler->throwError(CKFINDER_CONNECTOR_ERROR_CONNECTOR_DISABLED);
        }
    }

    /**
     * Check request
     * @access protected
     *
     */
    function checkRequest()
    {
        if (preg_match(CKFINDER_REGEX_INVALID_PATH, $this->_currentFolder->getClientPath())) {
            $this->_errorHandler->throwError(CKFINDER_CONNECTOR_ERROR_INVALID_NAME);
        }

        $_resourceTypeConfig = $this->_currentFolder->getResourceTypeConfig();

        if (is_null($_resourceTypeConfig)) {
            $this->_errorHandler->throwError(CKFINDER_CONNECTOR_ERROR_INVALID_TYPE);
        }


        $_clientPath = $this->_currentFolder->getClientPath();
        $_clientPathParts = explode("/", trim($_clientPath, "/"));
        if ($_clientPathParts) {
            foreach ($_clientPathParts as $_part) {
                if ($_resourceTypeConfig->checkIsHiddenFolder($_part)) {
                    $this->_errorHandler->throwError(CKFINDER_CONNECTOR_ERROR_INVALID_REQUEST);
                }
            }
        }

        if (!is_dir($this->_currentFolder->getServerPath())) {
            if ($_clientPath == "/") {
                if (!CKFinder_Connector_Utils_FileSystem::createDirectoryRecursively($this->_currentFolder->getServerPath())) {
                    /**
                     * @todo handle error
                     */
                }
            } else {
                $this->_errorHandler->throwError(CKFINDER_CONNECTOR_ERROR_FOLDER_NOT_FOUND);
            }
        }
    }
}
