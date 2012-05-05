package org.Monumentzo.Tagger;

import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
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
		} catch (Exception e) {
			System.out.println(e.getMessage());
			e.printStackTrace();
		}
		
		if(dbConnection == null) {
			throw new SQLException("Could not connect to the specified database.");
		}
	}
	
	public int writeIdfInformation(String word, double idf) {
		
		// Insert the tag
		int tagID = -1;
		try {
			if(idf > 0) {
				PreparedStatement insertTag =
						dbConnection.prepareStatement("INSERT INTO Monumentzo.TextTag (TextTag, InverseDocumentFrequency) " +
													  "VALUES (?, ?);");
				insertTag.setString(1, word);
				insertTag.setDouble(2, idf);
				insertTag.execute();
				
				// Get the generated ID of the tag that was inserted above 
				PreparedStatement tagIDRetrieving = dbConnection.prepareStatement("SELECT TextTagID" +
																				  " FROM Monumentzo.TextTag" +
																				  " WHERE TextTag = ?;");
				tagIDRetrieving.setString(1, word);
				
				ResultSet tag = tagIDRetrieving.executeQuery();
				tag.next();
				tagID = tag.getInt("TextTagID");
			}
		} catch (SQLException e) {
			e.printStackTrace();
		}
		
		return tagID;
	}
	
	public void writeTfIdfInformation(int monumentID, int tagID, double tf, double tfIdf) {
		
		try {			
			if(tfIdf > 0 && tagID >= 0) {
				// Insert the link of the monument to the tag
				PreparedStatement insertMonument_TagLink = 
					dbConnection.prepareStatement("INSERT INTO Monumentzo.Monument_TextTag (MonumentID, TextTagID, TermFrequencyInverseDocumentFrequency, TermFrequency)" +
												  "VALUES (?, ?, ?, ?);");
				insertMonument_TagLink.setInt(1, monumentID);
				insertMonument_TagLink.setInt(2, tagID);
				insertMonument_TagLink.setDouble(3, tfIdf);
				insertMonument_TagLink.setDouble(4, tf);
				insertMonument_TagLink.execute();
			}
		} catch (SQLException e) {
			e.printStackTrace();
		}
	}
	
	public void writeMonumentVector(int monumentID, String vector) {
		
		try {
			// Write the vector representation of the monument to the database
			PreparedStatement insertVector = 
					dbConnection.prepareStatement("UPDATE Monumentzo.Monument SET Vector = ? WHERE MonumentID = ?;");
			insertVector.setString(1, vector);
			insertVector.setInt(2, monumentID);
			insertVector.execute();
		} catch (SQLException e) {
			e.printStackTrace();
		}
	}
}
