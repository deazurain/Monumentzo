package org.Monumentzo.RijksmonumtenScraper;

import java.io.File;
import java.net.URL;

public class Monument {

	private int monumentID;
	private String name;
	private String description;
	private float latitude;
	private float longitude;
	private String city;
	private String province;
	private String street;
	private String streetNumber;
	private String foundationDateText;
	private int foundationYear;
	private String wikiArticle;
	private URL wikiImageURL;
	private File imagePath;
	
	public Monument(int id, String name, String desc,
					float latitude, float longitude,
					String city, String province, String street, String streetNumber,
					String foundationDate, int foundationYear,
					String wikiArticle, URL wikiImageURL) {
		this.monumentID = id;
		this.name = name;
		this.description = desc;
		
		this.latitude = latitude;
		this.longitude = longitude;
		
		this.city = city;
		this.province = province;
		this.street = street;
		this.streetNumber = streetNumber;
		
		this.foundationDateText = foundationDate;
		this.foundationYear = foundationYear;
		
		this.wikiArticle = wikiArticle;
		this.wikiImageURL = wikiImageURL;
	}
	
	public int getMonumentID() { return monumentID; }
	public String getName() { return name; }
	public String getDescription() { return description; }
	
	public float getLatitude() { return latitude; }
	public float getLongitude() { return longitude; }
	
	public String getCity() { return city; }
	public String getProvince() { return province; }
	public String getStreet() { return street; }
	public String getStreetNumber() { return streetNumber; }
	
	public String getFoundationDate() { return foundationDateText; }
	public int getFoundationYear() { return foundationYear; }
	
	public String getWikiArticle() { return wikiArticle; }
	public URL getWikiImageURL() { return wikiImageURL; }
	public File getImagePath() { return imagePath; }
	public void setImagePath(File image) { imagePath = image; }
}
