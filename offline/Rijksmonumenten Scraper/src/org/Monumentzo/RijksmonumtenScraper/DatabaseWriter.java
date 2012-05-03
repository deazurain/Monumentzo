package org.Monumentzo.RijksmonumtenScraper;

import java.sql.DriverManager;
import java.sql.SQLException;

import com.mysql.jdbc.Connection;
import com.mysql.jdbc.Statement;

public class DatabaseWriter {
	
	private Connection dbConnection = null;
	private String currentDatabase = "";
	
	public DatabaseWriter(String databaseURL, String Database, String user, String password) throws SQLException {
		currentDatabase = Database;		
		
		try {
			// Create a connection to the database
			Class.forName("com.mysql.jdbc.Driver");
			dbConnection = (Connection) DriverManager.getConnection(databaseURL, user, password);
	        
			// Select the wanted database
			Statement stmt = (Statement) dbConnection.createStatement();
	        stmt.executeQuery("USE " + currentDatabase);
		} catch (ClassNotFoundException | SQLException e) {
			e.printStackTrace();
		}
		
		if(dbConnection == null) {
			throw new SQLException("Could not connect to the specified database.");
		}
	}
	
	public void StoreMonument(Monument monument) {
		
		System.out.println("Storing the information for monument " + monument.getMonumentID());
		
		// Create the query column string and the corresponding values string
		String columns = "MonumentID";
		String values = String.format("%d", monument.getMonumentID());
		
		if(monument.getName() != null) {
			columns += ", Name";
			values += String.format(", %s", monument.getName());
		}
		
		if(monument.getDescription() != null) {
			columns += ", Description";
			values += String.format(", %s", monument.getDescription());
		}
		
		if(monument.getLatitude() != -1.0f) {
			columns += ", Latitude";
			values += String.format(", %f", monument.getLatitude());
		}
		
		if(monument.getLongitude() != -1.0f) {
			columns += ", Longitude";
			values += String.format(", %f", monument.getLongitude());
		}
		
		if(monument.getCity() != null) {
			columns += ", City";
			values += String.format(", %s", monument.getCity());
		}
		
		if(monument.getStreet() != null) {
			columns += ", Street";
			values += String.format(", %s", monument.getStreet());
		}
		
		if(monument.getStreetNumber() != null) {
			columns += ", StreetNumberText";
			values += String.format(", %s", monument.getStreetNumber());
		}
		
		if(monument.getFoundationDate() != null) {
			columns += ", FoundationDateText";
			values += String.format(", %s", monument.getFoundationDate());
		}
		
		if(monument.getFoundationYear() != 0) {
			columns += ", FoundationYear";
			values += String.format(", %d", monument.getFoundationYear());
		}
		
		if(monument.getWikiArticle() != null) {
			columns += ", WikiArticle";
			values += String.format(", %s", monument.getWikiArticle());
		}
		
		// Insert the information about the monument in the mysql database
		Statement insertMonument = null;
		try {
			PreparedStatement insertMonument = (Statement) dbConnection.prepareStatement("INSERT INTO Monumentzo.Monument (?) VALUES (?);");
			insertMonument.setString(1, columns);
			insertMonument.setString(2, values);
			
			insertMonument.execute();
		} catch (SQLException e) {
			e.printStackTrace();
		}
		
		// Insert the information about the image if the information is available
		if(monument.getWikiImageURL() != null) {
			try {
				// Create a imageID
				String imageID = Integer.toString(generateImageID(1, 5000000));
				
				// Store the information
				PreparedStatement insertImage = (Statement) dbConnection.prepareStatement("INSERT INTO Monumentzo.Monument_Image (MonumentID, ImageID, ImagePath) VALUES (?, ?, ?);");
				insertImage.setInt(1, monument.getMonumentID());
				insertImage.setString(2, imageID);
				insertImage.setString(3, monument.getWikiImageURL().toString());
				
				insertImage.execute();
			} catch (SQLException e) {
				e.printStackTrace();
			}
		}
	}
	
	private int generateImageID(int min, int max) {
	    return (int) Math.floor(Math.random() * (max - min + 1)) + min;
	}
}

