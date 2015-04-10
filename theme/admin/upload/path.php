<?php 
echo $_SERVER['PHP_SELF'];

function resolveUrl($baseUrl) {
    $fileSystem =& CKFinder_Connector_Core_Factory::getInstance("Utils_FileSystem");
    $baseUrl = preg_replace("|^http(s)?://[^/]+|i", "", $baseUrl);
    return $fileSystem->getDocumentRootPath() . $baseUrl;
}

$baseUrl = '/mark/upload/';
$baseDir = resolveUrl($baseUrl);
echo $baseDir;