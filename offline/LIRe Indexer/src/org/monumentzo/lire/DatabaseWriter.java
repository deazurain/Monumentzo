package org.monumentzo.lire;

import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

import com.mysql.jdbc.Connection;
import com.mysql.jdbc.PreparedStatement;
import com.mysql.jdbc.Statement;

public class DatabaseWriter {
	
	private Connection connection = null;
	
	public DatabaseWriter(String databaseURL, String schema, String user, String password) throws SQLException {
		
		// Create a connection to the database
		// Class.forName("com.mysql.jdbc.Driver");
		connection = (Connection) DriverManager.getConnection(databaseURL, user, password);
	       
		// Select the wanted database
		Statement s = (Statement) connection.createStatement();
	    s.executeQuery("USE " + schema);

	}
	
	public List<DatabaseImage> getAllImages() {
		String q = "SELECT * FROM Image";
		
		ResultSet rs;
		List<DatabaseImage> images = new ArrayList<DatabaseImage>();
		
		try {
			Statement s = (Statement) connection.createStatement();
			rs = s.executeQuery(q);
			
			while(rs.next()) {
				int imageID = rs.getInt(1);
				int monumentID = rs.getInt(2);
				String path = rs.getString(3);
				
				images.add(new DatabaseImage(imageID, monumentID, path));
			}
		} catch (SQLException e) {
			e.printStackTrace();
		}
		
		return images;
	}
	
	public boolean addSimilarImage(int ImageID, int SimilarImageID, float similarity) {
		String q = "INSERT INTO SimilarImage (ImageID, SimilarImageID, Similarity) "
				+ "VALUES (?, ?, ?)";
		
		PreparedStatement s;
		
		try {
			s = (PreparedStatement) connection.prepareStatement(q);
			s.setInt(1, ImageID);
			s.setInt(2, SimilarImageID);
			s.setFloat(3, similarity);
			
			// System.out.println("addSimilarImage: " + s);
			s.execute();
			
		} catch (SQLException e) {
			// System.out.println(e.getMessage());
			e.printStackTrace();
			return false;
		}
		
		return true;
		
	}
	
	public void close() {
		try {
			connection.close();
		} catch (SQLException e) {
			// System.out.println(e.getMessage());
			e.printStackTrace();
		}
	}

	public DatabaseImage getImageByMonumentID(int monumentID) {
		String q = "SELECT * FROM Image "
				+ "WHERE MonumentID = ? ";
		
		PreparedStatement s;
		
		int imageID = 0;
		String path = "";
		
		try {
			s = (PreparedStatement) connection.prepareStatement(q);
			s.setInt(1, monumentID);
			
			// System.out.println("getImageByMonumentID: " + s);
			s.execute();
			
			ResultSet rs = s.getResultSet();
			
			if(rs.next()) {
				imageID = rs.getInt(1);
				monumentID = rs.getInt(2);
				path = rs.getString(3);
			}
			
		} catch (SQLException e) {
			// System.out.println(e.getMessage());
			e.printStackTrace();
			return null;
		}
		
		return new DatabaseImage(imageID, monumentID, path);
		
	}

	public void clearSimilarImageTable() {
		String q = "TRUNCATE TABLE SimilarImage";
		
		try {
			Statement s = (Statement) connection.createStatement();
			s.executeQuery(q);
		} catch (SQLException e) {
			e.printStackTrace();
		}
	}
}
