package org.Monumentzo.Tagger;

import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

import com.mysql.jdbc.Connection;
import com.mysql.jdbc.Statement;

public class DatabaseReader {

	private Connection dbConnection = null;
	private String currentDatabase = "";
	
	public DatabaseReader(String databaseURL, String Database, String user, String password) throws SQLException {
		
		// Store the current database
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
	
	public ArrayList<Monument> getMonumentData() throws SQLException {
		
		PreparedStatement monumentData = null;
		try {
			monumentData =
				dbConnection.prepareStatement("SELECT MonumentID, Name, Description, City FROM monumentzo.Monument;");
			monumentData.executeQuery();
		} catch (SQLException e) {
			e.printStackTrace();
		}
		
		ResultSet results = monumentData.getResultSet();
		ArrayList<Monument> monuments = new ArrayList<Monument>();
		
		boolean hasRow = results.first();
		while(hasRow) {
			monuments.add(new Monument(results.getInt("MonumentID"), results.getString("Name"),
										results.getString("Description"), results.getString("City")));			
			hasRow = monumentData.getResultSet().next();
		}
		
		results.close();
		return monuments;
	}
}
