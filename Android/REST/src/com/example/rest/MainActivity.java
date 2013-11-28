package com.example.rest;

import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.io.UnsupportedEncodingException;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.ArrayList;
import java.util.List;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import org.xmlpull.v1.XmlPullParserException;

import android.app.Activity;
import android.os.Bundle;
import android.os.Environment;
import android.util.Log;
import android.view.Menu;
import android.view.View;
import android.view.ViewTreeObserver;
import android.view.View.OnClickListener;
import android.view.ViewTreeObserver.OnGlobalLayoutListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.Button;
import android.widget.ListView;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import com.example.rest.adapters.LandmarkListAdapter;
import com.example.rest.helpers.Parser;
import com.example.rest.models.LandmarkEntryList;

public class MainActivity extends Activity {

	boolean isXMLDownloaded = false;
	TextView tv_error;
	Button btn;
	List<LandmarkEntryList> landmarkEntryList;
	ListView lv;
	ProgressBar progressBar;
	View parent;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main);
		
		
		tv_error = (TextView) findViewById(R.id.textView1);
		btn = (Button) findViewById(R.id.button1);
		lv = (ListView) findViewById(R.id.listView1);
		progressBar = (ProgressBar) findViewById(R.id.progressBar1);
		parent = (View) findViewById(R.id.parent);
		
		btn.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View arg0) {
				// TODO Auto-generated method stub
				initFiles();
			}
		});
		
		progressBar.post(new Runnable() {
			
			@Override
			public void run() {
				// TODO Auto-generated method stub

				initFiles();
			}
		});
	}
	

	private void initFiles() {
		btn.setEnabled(false);
		lv.setVisibility(View.GONE);
		progressBar.setVisibility(View.VISIBLE);
		
		isXMLDownloaded = false;
		downloadXML();
        while(!isXMLDownloaded) {
        	try {
				Thread.sleep(100);
			} catch (InterruptedException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
        }
        
        landmarkEntryList  = new ArrayList<LandmarkEntryList>();
        
        boolean done = false;
        try {
			done = Parser.parseXML(Environment.getExternalStorageDirectory() + "/REST/rest.xml", landmarkEntryList); 
		} catch (XmlPullParserException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
        while(!done) {
        	try {
				Thread.sleep(100);
			} catch (InterruptedException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
        }
        
        if(landmarkEntryList.size() == 0) {
        	tv_error.setText("Empty");
        }
        else {
        	progressBar.setVisibility(View.GONE);
        }
        
        progressBar.setVisibility(View.GONE);
 
        
        LandmarkListAdapter adapter = new LandmarkListAdapter(getApplicationContext(), landmarkEntryList, R.layout.landmark_list);
		lv.setAdapter(adapter);
		lv.setOnItemClickListener(new OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
					long arg3) {
				// TODO Auto-generated method stub
				String str = "";
				LandmarkEntryList listEntry = landmarkEntryList.get(arg2);
				
				
				str = str.concat("- " + listEntry.id + "\n");
				str = str.concat("- " + listEntry.slug + "\n");
				str = str.concat("- " + listEntry.landmarkcategory + "\n");
				str = str.concat("- " + listEntry.history + "\n");
				str = str.concat("- " + listEntry.latitude + ", " + listEntry.longitude + "\n");
				str = str.concat("- " + listEntry.fileurl + "\n");
				str = str.concat("- " + listEntry.user + "\n");
				str = str.concat("- " + listEntry.created_at + "\n");
				str = str.concat("- " + listEntry.updated_at + "\n");
				Toast.makeText(getApplicationContext(), str, Toast.LENGTH_LONG).show();
			}
		});
		
		btn.setEnabled(true);
		lv.setVisibility(View.VISIBLE);
		progressBar.setVisibility(View.GONE);
		
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.main, menu);
		return true;
	}
	
	public void downloadXML() {
		Thread t = new Thread(new Runnable() {
			
			@Override
			public void run() {
				// TODO Auto-generated method stub
				 String uri = "http://192.168.196.1/finaldestination/public/api/landmarks?format=xml";

			        try {
			        	URL url = new URL(uri); 
			        	HttpURLConnection connection = (HttpURLConnection) url.openConnection();
//			        	connection.setRequestMethod("GET");
//			        	connection.setDoOutput(true);
			        	connection.connect();
			        	InputStream xml = connection.getInputStream();
			        	
			        	File folder = new File(Environment.getExternalStorageDirectory(), "REST");
			        	if(!folder.exists()) {
			        		folder.mkdirs();
			        		Log.d("Created Folder: ", "" + folder); 
			        	}
			        	File file = new File(folder, "rest.xml");
			        	
			        	OutputStream out = new FileOutputStream(file);
						byte[] buffer = new byte[1024];
						int read;
						
						while ((read = xml.read(buffer)) != -1)
							out.write(buffer, 0, read);
						xml.close();
						xml = null;
						out.flush();
						out.close();
						out = null;
						Log.d("File ", "Copied: " + file);
			        	
			        	isXMLDownloaded = true;
			        } catch(MalformedURLException e) {
			        	tv_error.setText(e.toString());
			        } catch(IOException e) {
			        	tv_error.setText(e.toString());
			        }
			}
		});
		t.start();
	}
	
	

}
