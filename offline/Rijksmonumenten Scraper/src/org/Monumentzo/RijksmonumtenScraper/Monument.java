package org.Monumentzo.RijksmonumtenScraper;

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
	
	public Monument(int id, String name, String desc,
					float latitude, float longitude,
					String city, String province, String street, String streetNumber,
					String foundationDate, int foundationYear,
					String wikiArticle) {
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
}
