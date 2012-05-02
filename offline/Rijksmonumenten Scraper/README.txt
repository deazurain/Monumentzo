===== NAME =====
scraper - scrapes the Rijksmonument API (http://api.rijksmonumenten.info)

===== SYNOPSIS =====
java -jar scraper.jar -s SOURCE_FILE -o OUTPUT_FOLDER
java -jar scraper.jar -o OUTPUT_FOLDER -s SOURCE_FILE
java -jar scraper.jar -source SOURCE_FILE -output OUTPUT_FOLDER
java -jar scraper.jar -output OUTPUT_FOLDER -source SOURCE_FILE

===== DESCRIPTION =====
scraper searches the Rijksmonumenten API for information about the monuments with the "rijksmonumentnummer" that it reads from the SOURCE_FILE
and if the scraper can find an image that belongs to the monument it will attempt to download that image. The images that it downloads will be
stored in OUTPUT_FOLDER. The name of the images will be the "rijksmonumentnummer".

===== OPTIONS =====
-s 	  A file containing all the numbers of the monuments of which the information needs to be downloaded
-source   See -s
-o	  Path to a folder where the downloaded images should be stored
-output	  Same as -o