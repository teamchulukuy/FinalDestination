package com.example.rest.models;

public class LandmarkEntryList {
	public String id;
	public String placename;
	public String slug;
	public String landmarkcategory;
	public String description;
	public String history;
	public String latitude;
	public String longitude;
	public String fileurl;	
	public String user;
	public String created_at;
	public String updated_at;
	
	public LandmarkEntryList(String id, String placename, String slug,
			String landmarkcategory, String description, String history,
			String latitude, String longitude, String fileurl, String user,
			String created_at, String updated_at) {
		super();
		this.id = id;
		this.placename = placename;
		this.slug = slug;
		this.landmarkcategory = landmarkcategory;
		this.description = description;
		this.history = history;
		this.latitude = latitude;
		this.longitude = longitude;
		this.fileurl = fileurl;
		this.user = user;
		this.created_at = created_at;
		this.updated_at = updated_at;
	}
	
	
}
