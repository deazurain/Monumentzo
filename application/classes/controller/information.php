<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Monumentzo class to retrieve external information and save it in the database.
 * 
 * @author Monumetnzo 
 */
class Controller_Information {

    public function before() {
        if (PHP_SAPI !== "cli")
            exit("Execute this from command line.");
    }
    
    public function __construct() {
        
    }
    
    public function action_get_googlebooks() {     
        require_once 'google-api-php-client/src/apiClient.php';
        require_once 'google-api-php-client/src/contrib/apiBooksService.php';

        $client = new apiClient();
        $client->setApplicationName("Monumentzo");
        $service = new apiBooksService($client);

        $optParams = array('langRestrict' => 'nl', 'q' => 'subject:delft');
        $results = $service->volumes->listVolumes('Delft', $optParams);
        //$results = $service->volumes->getVolume('qPV0AAAAIAAJ', '');

        foreach ($results['items'] as $item) {
            echo "[" . $item['volumeInfo']['title'] . "]\n";
        }
    }
    
    public function after() {
        
    }

}

?>
