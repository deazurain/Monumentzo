package org.Monumentzo.LIReIndexer;

import java.net.URL;
import java.sql.DriverManager;
import java.sql.SQLException;

import com.mysql.jdbc.Connection;
import com.mysql.jdbc.Statement;

public class DatabaseWriter {
	
	private Connection dbConnection = null;
	private String currentDatabase = "";
	
	public DatabaseWriter(URL databaseURL, String Database, String user, String password) throws SQLException {
		currentDatabase = Database;		
		
		try {
			// Create a connection to the database
			Class.forName("com.mysql.jdbc.Driver");
			dbConnection = (Connection) DriverManager.getConnection(databaseURL.toString(), user, password);
	        
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
}
