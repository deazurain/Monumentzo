package org.monumentzo.lire;

public class DatabaseImage {

	public int imageID;
	public int monumentID;
	public String path;
	
	public DatabaseImage(int imageID, int monumentID, String path) {
		this.imageID = imageID;
		this.monumentID = monumentID;
		this.path = path;
	}
}
