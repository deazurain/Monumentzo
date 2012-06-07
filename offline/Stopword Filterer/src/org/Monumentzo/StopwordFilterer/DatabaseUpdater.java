package org.Monumentzo.StopwordFilterer;

import java.sql.DriverManager;
import java.sql.SQLException;

import com.mysql.jdbc.Connection;
import com.mysql.jdbc.PreparedStatement;
import com.mysql.jdbc.Statement;

public class DatabaseUpdater {

	private Connection dbConnection = null;
	private String currentDatabase = "";
	
	public DatabaseUpdater(String databaseURL, String Database, String user, String password) throws SQLException {
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
	
	public void UpdateDatabase(String word) {
		
		// Get the TextTagID from the database
		int textTagId = -1;
		try {
			PreparedStatement tagIdSelect = 
					(PreparedStatement) dbConnection.prepareStatement("SELECT TextTagID FROM ?.TextTag WHERE TextTag = ?");
			tagIdSelect.setString(1, currentDatabase);
			tagIdSelect.setString(2, word);
			ResultSet rs = tagIdSelect.execute();
			
			if(!rs.next())
				return;
			
			textTagId = rs.getInt("TextTagID");
			
		} catch (SQLException e) {
			System.out.println("EXCEPTION!!! " + e.getMessage());
		}
		
		// Remove all the Monument_TextTag rows that have the TextTagID
		// that was previously taken from the database
		try {
			PreparedStatement removeMonumentTextTags = 
					(PreparedStatement) dbConnection.prepareStatement("DELETE FROM ?.Monument_TextTag WHERE TextTagID = ?");
			removeMonumentTextTags.setString(1, currentDatabase);
			removeMonumentTextTags.setInt(2, textTagId);
			removeMonumentTextTags.execute();
			
		} catch (SQLException e) {
			System.out.println("EXCEPTION!!! " + e.getMessage());
		}
		
		// Remove the text tag from the TextTag table
		try {
			PreparedStatement removeMonumentTextTags = 
					(PreparedStatement) dbConnection.prepareStatement("DELETE FROM ?.TextTag WHERE TextTagID = ?");
			removeMonumentTextTags.setString(1, currentDatabase);
			removeMonumentTextTags.setInt(2, textTagId);
			removeMonumentTextTags.execute();
			
		} catch (SQLException e) {
			System.out.println("EXCEPTION!!! " + e.getMessage());
		}
	}
}
