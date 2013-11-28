package com.example.rest.helpers;

import java.io.File;
import java.io.FileReader;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

import org.xmlpull.v1.XmlPullParser;
import org.xmlpull.v1.XmlPullParserException;
import org.xmlpull.v1.XmlPullParserFactory;

import android.util.Log;
import android.widget.SlidingDrawer;

import com.example.rest.models.LandmarkEntryList;

public class Parser{
	
	public static boolean parseXML(String filename, List<LandmarkEntryList> entryList) throws XmlPullParserException, IOException
	{
		
		File file = new File(filename);
		
		XmlPullParserFactory factory = XmlPullParserFactory.newInstance();
		factory.setNamespaceAware(true);
		XmlPullParser parser = factory.newPullParser();
		parser.setInput(new FileReader(file));
		
		int eventType;
		String startTag = "";
		
		String id = "";
		String placename = "";
		String slug = "";
		String landmarkcategory = "";
		String description = "";
		String history = "";
		String latitude = "";
		String longitude = "";
		String fileurl = "";	
		String user = "";
		String created_at = "";
		String updated_at = "";
		
		while((eventType = parser.next()) != XmlPullParser.END_DOCUMENT) {
			if(eventType == XmlPullParser.START_TAG) {
				startTag = parser.getName();
			}
			else if(eventType == XmlPullParser.TEXT) {
				if(startTag.equalsIgnoreCase("id")) {
					id = parser.getText();
				}
				else if(startTag.equalsIgnoreCase("placename")) {
					placename = parser.getText();
				}
				else if(startTag.equalsIgnoreCase("slug")) {
					slug = parser.getText();
				}
				else if(startTag.equalsIgnoreCase("landmarkcategory_id")) {
					landmarkcategory = parser.getText();
				}
				else if(startTag.equalsIgnoreCase("description")) {
					description = parser.getText();
				}
				else if(startTag.equalsIgnoreCase("history")) {
					history = parser.getText();
				}
				else if(startTag.equalsIgnoreCase("latitude")) {
					latitude = parser.getText();
				}
				else if(startTag.equalsIgnoreCase("longhitude")) {
					longitude = parser.getText();
				}
				else if(startTag.equalsIgnoreCase("fileurl")) {
					fileurl = parser.getText();
				}
				else if(startTag.equalsIgnoreCase("user_id")) {
					user = parser.getText();
				}
				else if(startTag.equalsIgnoreCase("created_at")) {
					created_at = parser.getText();
				}
				else if(startTag.equalsIgnoreCase("updated_at")) {
					updated_at = parser.getText();
					entryList.add(new LandmarkEntryList(id, placename, slug, landmarkcategory, description, history, latitude, longitude, fileurl, user, created_at, updated_at));
				}
			}
		}
		
		return true;
	}
}
