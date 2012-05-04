package org.Monumentzo.RijksmonumtenScraper;

import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;

import com.mysql.jdbc.Connection;
import com.mysql.jdbc.PreparedStatement;
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
		} catch (Exception e) {
			System.out.println(e.getMessage());
			e.printStackTrace();
		}
		
		if(dbConnection == null) {
			throw new SQLException("Could not connect to the specified database.");
		}
	}
	
	public void StoreMonument(Monument monument) {
		
		System.out.println("Storing the information for monument " + monument.getMonumentID());

		// Insert the information about the monument in the mysql database
		PreparedStatement insertMonument = null;
		try {
			insertMonument = (PreparedStatement) dbConnection.prepareStatement(
				"INSERT INTO monumentzo.Monument (MonumentID, Name, Description, Latitude, Longitude, Province, City, Street, StreetNumberText,FoundationDateText, FoundationYear, WikiArticle)" +
				"VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			
			// ID
			int i = 1;
			insertMonument.setInt(i, monument.getMonumentID());
			
			// name
			i++;
			if(monument.getName() != null) {
				insertMonument.setString(i, monument.getName());
			}
			else {
				insertMonument.setNull(i, 0);
			}
			
			// description
			i++;
			if(monument.getDescription() != null) {
				insertMonument.setString(i, monument.getDescription());
			}
			else {
				insertMonument.setNull(i, 0);
			}
			
			// latitude
			i++;
			if(monument.getLatitude() != Float.MAX_VALUE) {
				insertMonument.setFloat(i, monument.getLatitude());
			}
			else {
				insertMonument.setNull(i, 0);
			}
			
			// longitude
			i++;
			if(monument.getLongitude() != Float.MAX_VALUE) {
				insertMonument.setFloat(i, monument.getLongitude());
			}
			else {
				insertMonument.setNull(i, 0);
			}

			// province
			i++;
			if(monument.getProvince() != null) {
				insertMonument.setString(i, monument.getProvince());
			}
			else {
				insertMonument.setNull(i, 0);
			}

			// city
			i++;
			if(monument.getCity() != null) {
				insertMonument.setString(i, monument.getCity());
			}
			else {
				insertMonument.setNull(i, 0);
			}

			// street
			i++;
			if(monument.getStreet() != null) {
				insertMonument.setString(i, monument.getStreet());
			}
			else {
				insertMonument.setNull(i, 0);
			}

			// streetnumber
			i++;
			if(monument.getStreetNumber() != null) {
				insertMonument.setString(i, monument.getStreetNumber());
			}
			else {
				insertMonument.setNull(i, 0);
			}

			// foundation date
			i++;
			if(monument.getFoundationDate() != null) {
				insertMonument.setString(i, monument.getFoundationDate());
			}
			else {
				insertMonument.setNull(i, 0);
			}
			
			// foundation year
			i++;
			if(monument.getFoundationYear() != 0) {
				insertMonument.setLong(i, monument.getFoundationYear());
			}
			else {
				insertMonument.setNull(i, 0);
			}
			
			// wiki article
			i++;
			if(monument.getWikiArticle() != null) {
				insertMonument.setString(i, monument.getWikiArticle());
			}
			else {
				insertMonument.setNull(i, 0);
			}
			
			System.out.println(insertMonument);
			insertMonument.execute();
		} catch (SQLException e) {
			System.out.println("EXCEPTION!!! " + e.getMessage());
			//e.printStackTrace();
		}
		
		// Insert the information about the image if the information is available
		if(monument.getWikiImageURL() != null) {
			try {
			    
				// Store the information
				PreparedStatement insertImage = (PreparedStatement) dbConnection.prepareStatement(
						"INSERT INTO monumentzo.Image (MonumentID, Path) " +
						"VALUES (?, ?) ", Statement.RETURN_GENERATED_KEYS);
				insertImage.setInt(1, monument.getMonumentID());
				insertImage.setString(2, monument.getImagePath());
				
				// DEBUG info
				System.out.println(insertImage);
				
				insertImage.execute();
				ResultSet rs = insertImage.getGeneratedKeys();
				
				int imageID = -1;
				
				if(rs.next()) {
					imageID = rs.getInt(1);
					
					PreparedStatement um = (PreparedStatement) dbConnection.prepareStatement(
							"UPDATE monumentzo.Monument " +
							"SET ImageID=? " + 
							"WHERE MonumentID=? ");
					um.setInt(1, imageID);
					um.setInt(2, monument.getMonumentID());
					
					System.out.println("monument update query: " + um);
					
					um.execute();
				}
				else {
					// throw new Exception("Could not insert image");
				}
				


			} catch (SQLException e) {
				System.out.println("EXCEPTION!!! " + e.getMessage());
				//e.printStackTrace();
			}
		}
	}
}

