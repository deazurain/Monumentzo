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

        // Set the limit and offset for the query
        $offset = 10;
        $limit = 25;
        
        // Retrieve monument id's with the given limit and offset
        $monuments = DB::query(Database::SELECT, 'SELECT MonumentID FROM Monument ORDER BY MonumentID LIMIT :offset, :limit')
                ->bind(':offset', $offset)
                ->bind(':limit', $limit)
                ->execute()
                ->as_array();

        echo "Number of monuments to search books for: " . count($monuments) . ".\n";

        $i = 1 + $offset;

        // Get books for each of the retrieved monuments
        foreach ($monuments as $monument) {
            $resultsID = array();
            $books = array();

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
                            echo "[ID: " . $item['id'] . " - " . $item['volumeInfo']['title'] . "]\n";
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
                $title = $book['volumeInfo']['title'];
                $title = utf8_encode($title);

                // Check that the book is not already in the database.
                $query = DB::query(Database::SELECT, 'SELECT BookID FROM Book WHERE Title = :title')
                        ->bind(':title', $title)
                        ->execute()
                        ->as_array();

                // If the book is already in the database then do nothing. Otherwise save it to the database.
                if (isset($query[0]['BookID'])) {
                    echo "Book is already in database.";
                } else {                    
                    if (isset($book['volumeInfo']['authors'][0])) {
                        $author = $book['volumeInfo']['authors'][0];
                    } else {
                        $author = null;
                    }

                    if (isset($book['volumeInfo']['imageLinks']['thumbnail'])) {
                        $img = $book['volumeInfo']['imageLinks']['thumbnail'];
                    } else if (isset($book['volumeInfo']['imageLinks']['small'])) {
                        $img = $book['volumeInfo']['imageLinks']['small'];
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
                    } else if (isset($book['volumeInfo']['infoLink'])) {
                        $link = $book['volumeInfo']['infoLink'];
                    } else {
                        $link = null;
                    }
                   
                    $toSaveBook = DB::query(Database::INSERT, 'INSERT INTO Book (GoogleID, Title, Author, ImgUrl, Description, Link) VALUES(:googleID, :title, :author, :img, :des, :link)')
                            ->bind(':bookID', $bookID)
                            ->bind(':googleID', $googleID)
                            ->bind(':title', $title)
                            ->bind(':author', $author)
                            ->bind(':img', $img)
                            ->bind(':des', $des)
                            ->bind(':link', $link)
                            ->execute();
                    echo "Saved book for monument: " . $monument['MonumentID'] . "\n";
                }

                // Check if the book was saved.
                $test = DB::query(Database::SELECT, 'SELECT BookID FROM Book WHERE GoogleID = :id')
                        ->bind(':id', $googleID)
                        ->execute()
                        ->as_array();

                // If the book was saved then add a link between the book and the monument
                if (isset($test[0]['BookID'])) {
                    $toSaveLink = DB::query(Database::INSERT, 'INSERT INTO Monument_Book (MonumentID, BookID) VALUES(:monumentID, (SELECT BookID FROM Book WHERE GoogleID = :id))')
                            ->bind(':monumentID', $monument['MonumentID'])
                            ->bind(':id', $googleID)
                            ->execute();
                    echo "Saved link for monument: " . $monument['MonumentID'] . "\n";
                }
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