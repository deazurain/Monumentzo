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

        require_once 'google-api-php-client/src/apiClient.php';
        require_once 'google-api-php-client/src/contrib/apiBooksService.php';
    }

    public function __construct() {
        
    }

    public function action_get_googlebooks() {
        $client = new apiClient();
        $client->setApplicationName("Monumentzo");
        $service = new apiBooksService($client);

        // Retrieve monument id's
        $monuments = DB::query(Database::SELECT, 'SELECT MonumentID FROM Monument LIMIT 1')->execute()->as_array();

        echo "Number of monuments to search books for: " . count($monuments) . ".\n";

        $i = 1;

        // Get books for each of the retrieved monuments
        foreach ($monuments as $monument) {
            $resultsID = array();
            $books = array();

            $monument['MonumentID'] = 3403;

            echo "Monument " . $i . " : " . $monument['MonumentID'] . "\n";
            // Get information about the current monumnet
            $monumentInfo = DB::query(Database::SELECT, 'SELECT * FROM Monument WHERE MonumentID = :id')
                    ->bind(':id', $monument['MonumentID'])
                    ->execute()
                    ->as_array();

            // Get the people associated with this monument
            $people = DB::query(Database::SELECT, 'SELECT Name FROM Person JOIN Monument_Person ON Person.PersonID = Monument_Person.PersonID WHERE Monument_Person.MonumentID = :id')
                    ->bind(':id', $monument['MonumentID'])
                    ->execute()
                    ->as_array();
            echo "Number of related people: " . count($people) . ".\n";

            // Get the event associated with this monument
            $events = DB::query(Database::SELECT, 'SELECT Year FROM Event JOIN Monument_Event ON Event.EventID = Monument_Event.EventID WHERE Monument_Event.MonumentID = :id')
                    ->bind(':id', $monument['MonumentID'])
                    ->execute()
                    ->as_array();
            echo "Number of related events: " . count($events) . ".\n";

            // Set the parameters for the query
            $optParams = array('langRestrict' => 'nl', 'orderBy' => 'relevance');
            // Set parameters with maximum number of books allowed
            $optParamsWithMax = array('langRestrict' => 'nl', 'orderBy' => 'relevance', 'maxResults' => '3');

            echo "Books based on query with name and city: \n";
            echo "{{" . $monumentInfo[0]['Name'] . " " . $monumentInfo[0]['City'] . "}}\n";

            // Send query to google
            $results = $service->volumes->listVolumes($monumentInfo[0]['Name'] . "+" . $monumentInfo[0]['City'], $optParams);

            // If there are results, save them to the resultsID array. Unless the id is already in there
            if (isset($results['items'])) {
                foreach ($results['items'] as $item) {
                    if (!in_array($item['id'], $resultsID)) {
                        $resultsID[] = $item['id'];
                        $books[] = $item;
                        echo "[ID: " . $item['id'] . " - " . $item['volumeInfo']['title'] . "]\n";
                    }
                }
            }

            // Get books about the people related to the monument
            echo "Books based on query with related person: \n";
            foreach ($people as $person) {
                echo "{{" . $person['Name'] . "}}\n";
                $results = $service->volumes->listVolumes($person['Name'], $optParamsWithMax);

                if (isset($results['items'])) {
                    foreach ($results['items'] as $item) {
                        if (!in_array($item['id'], $resultsID)) {
                            $resultsID[] = $item['id'];
                            $books[] = $item;
                            //echo "[ID: " . $item['id'] . " - " . $item['volumeInfo']['title'] . "]\n";
                        }
                    }
                }
            }

            // Get books related to the events of this monument
            echo "Books based on query with related event: \n";
            foreach ($events as $event) {
                echo "{{" . $event['Year'] . "}}\n";
                $results = $service->volumes->listVolumes($event['Year'], $optParamsWithMax);

                if (isset($results['items'])) {
                    foreach ($results['items'] as $item) {
                        if (!in_array($item['id'], $resultsID)) {
                            $resultsID[] = $item['id'];
                            $books[] = $item;
                            echo "[ID: " . $item['id'] . " - " . $item['volumeInfo']['title'] . "]\n";
                        }
                    }
                }
            }

            // Save books to the databases
            foreach ($books as $book) {
                $googleID = $book['id'];

                $query = DB::query(Database::SELECT, 'SELECT COUNT(*) FROM Book WHERE GoogleID = :id')
                        ->bind(':id', $googleID)
                        ->execute()
                        ->as_array();


                $title = $book['volumeInfo']['title'];

                if (isset($book['volumeInfo']['authors'][0])) {
                    $author = $book['volumeInfo']['authors'][0];
                } else {
                    $author = null;
                }

                if (isset($book['volumeInfo']['imageLinks']['thumbnail'])) {
                    $img = $book['volumeInfo']['imageLinks']['thumbnail'];
                    $img = parse_url($img);
                } else if (isset($book['volumeInfo']['imageLinks']['small'])) {
                    $img = $book['volumeInfo']['imageLinks']['small'];
                    $img = parse_url($img);
                } else {
                    $img = "assets/img/default_book.jpg";
                }

                if (isset($book['volumeInfo']['description'])) {
                    $des = $book['volumeInfo']['description'];
                } else {
                    $des = null;
                }

                if (isset($book['volumeInfo']['previewLink'])) {
                    $link = $book['volumeInfo']['previewLink'];
                    $link = parse_url($link);
                } else if (isset($book['volumeInfo']['infoLink'])) {
                    $link = $book['volumeInfo']['infoLink'];
                    $link = parse_url($link);
                } else {
                    $link = null;
                }

                $img = null;
                $link = null;

                $toSaveBook = DB::query(Database::INSERT, 'INSERT IGNORE INTO Book (GoogleID, Title, Author, ImgUrl, Description, Link) VALUES(:googleID, :title, :author, :img, :des, :link)')
                        ->bind(':bookID', $bookID)
                        ->bind(':googleID', $googleID)
                        ->bind(':title', $title)
                        ->bind(':author', $author)
                        ->bind(':img', $img)
                        ->bind(':des', $des)
                        ->bind(':link', $link)
                        ->execute();
                echo "saved book" . $monument['MonumentID'] . "\n";
                
                
                $toSaveLink = DB::query(Database::INSERT, 'INSERT INTO Monument_Book (MonumentID, BookID) VALUES(:monumentID, (SELECT BookID FROM Book WHERE GoogleID = :id))')
                        ->bind(':monumentID', $monument['MonumentID'])
                        ->bind(':id', $googleID)
                        ->execute();
                echo "saved link for " . $monument['MonumentID'] . "\n";
            }

            echo "Number of books found: " . count($books) . ".\n";

            $i++;
        }

        echo "Number of monuments handled: " . ($i--) . ".\n";
    }

    public function after() {
        
    }

}

?>