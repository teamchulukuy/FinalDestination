package com.example.rest.adapters;

import java.util.List;

import org.w3c.dom.ls.LSInput;

import com.example.rest.R;
import com.example.rest.models.LandmarkEntryList;

import android.content.Context;
import android.graphics.Color;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.MotionEvent;
import android.view.View;
import android.view.View.OnTouchListener;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;


public class LandmarkListAdapter extends BaseAdapter{
	List<LandmarkEntryList> landmarkEntryList;
	Context context;
	int entryResID;
	int selectedIndex = -1;
	
	public LandmarkListAdapter(Context context, List<LandmarkEntryList> landmarkEntryList, int entryResID) {
		this.landmarkEntryList = landmarkEntryList;
		this.context = context;
		this.entryResID = entryResID;
		
	}

	@Override
	public int getCount() {
		// TODO Auto-generated method stub
		return landmarkEntryList.size();
	}

	@Override
	public LandmarkEntryList getItem(int arg0) {
		// TODO Auto-generated method stub
		return landmarkEntryList.get(arg0);
	}

	@Override
	public long getItemId(int arg0) {
		// TODO Auto-generated method stub
		return arg0;
	}

	private static class ViewHolder{
		public TextView tv_placename;
		public TextView tv_desc;
	}
	
	@Override
	public View getView(int position, View convertView, ViewGroup parent) {
		// TODO Auto-generated method stub
		ViewHolder holder;
		if(convertView == null) {
			LayoutInflater inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
			convertView = inflater.inflate(entryResID, null);
			
			holder = new ViewHolder();
			holder.tv_placename = (TextView) convertView.findViewById(R.id.tv_placename);
			holder.tv_desc = (TextView) convertView.findViewById(R.id.tv_desc);
			
			convertView.setTag(holder);
		}
		else {
			holder = (ViewHolder) convertView.getTag();
		}

		LandmarkEntryList listEntry = landmarkEntryList.get(position);
		holder.tv_placename.setText(listEntry.placename);
		holder.tv_desc.setText(listEntry.description);
		
		return convertView;
	}
}
