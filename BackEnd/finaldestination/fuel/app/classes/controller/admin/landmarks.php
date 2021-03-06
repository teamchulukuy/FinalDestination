<?php
class Controller_Admin_Landmarks extends Controller_Admin 
{

	public function action_index()
	{

		$landmark = Model_Landmark::find('all', array('related' => array('user', 'comments', 'voteitems')));

		$data['landmarks'] = $landmark;

		$view = View::forge('admin\landmarks/index', $data,  array('landmark' => $landmark));

		$view->set_global('landmarkcategory', Arr::assoc_to_keyval(Model_Landmarkcategory::find('all'),'id','categories'));
		$view->set_global('users', Arr::assoc_to_keyval(Model_User::find('all'), 'id', 'username'));


		$this->template->title = "Landmarks";
		$this->template->content = $view;

	}

	public function action_view($slug = null)
	{
		$landmark = Model_Landmark::find_by_slug($slug, array('related' => array('user', 'comments', 'voteitems')));

		is_null($slug) and Response::redirect('admin/landmarks');

		if ( ! $data['landmark'] = $landmark)
		{
			Session::set_flash('error', 'Could not find landmark #'.$slug);
			Response::redirect('admin/landmarks');
		}

		$this->template->title = "Landmark";
		$this->template->content = View::forge('admin/landmarks/view', $data,  array('landmark' => $landmark));

	}

	public function action_create()
	{
		$view = View::forge('admin\landmarks/create');

		if (Input::method() == 'POST')
		{
			$val = Model_Landmark::validate('create');

			if ($val->run())
			{
				$landmark = Model_Landmark::forge(array(
					'placename' => Input::post('placename'),
					'slug' => Inflector::friendly_title(Input::post('placename'),'-',true),
					'landmarkcategory_id' => Input::post('landmarkcategory_id'),
					'description' => Input::post('description'),
					'history' => Input::post('history'),
					'latitude' => Input::post('latitude'),
					'longhitude' => Input::post('longhitude'),
					'fileurl' => Input::post('fileurl'),
					'user_id' => $this->current_user->id,
				));

				 
				$config = array(
		            'path' => DOCROOT.'uploads/landmarks',
		            'normalize'   => true,
		            'randomize' => false,
		            'ext_whitelist' => array('png','jpg','bmp','jpeg'),
		            'max_size'    => 1024 * 1024,
		            );


				  while(Upload::get_files()){

                     Upload::process($config);

                        if (Upload::is_valid()) {
                                                                        
                                        Upload::save();

                                           $value = Upload::get_files();

                                           foreach($value as $files) {
                                               //print_r($files); 

                                                //$upload->filename = $value[0]['saved_as'];
                                                //$upload->size = $value[1]['size']/1024;
                                                //$landmark->fileurl = $value[1]['saved_to'].$value[0]['saved_as'];
                                                $landmark->fileurl = $value[0]['saved_as'];
                                                //$upload->type = $value[1]['extension'];
                                                $landmark->save();
                                            }

                                            Image::load('uploads/landmarks/'.$landmark->fileurl)
                                                ->resize(230,230)
                                                ->save('uploads/landmarks/thumb/'.$landmark->fileurl);

                                            Image::load('uploads/landmarks/'.$landmark->fileurl)
                                                ->resize(450,450)
                                                ->save('uploads/landmarks/orig/'.$landmark->fileurl);

                                            Image::load('uploads/landmarks/'.$landmark->fileurl)
                                                ->resize(90,68)
                                                ->save('uploads/landmarks/icon/'.$landmark->fileurl);




				if ($landmark and $landmark->save())
				{
					Session::set_flash('success', e('Added landmark: '.$landmark->placename.'.'));

					Response::redirect('admin/landmarks');
				}

				else
				{
					Session::set_flash('error', e('Could not save landmark.'));
				}
					}//end of if(Upload::is_valid())
				}//end of while loop
			}//end of if($val->run())
			
			else
			{
				Session::set_flash('error', $val->error());
			}


		}

		$view->set_global('landmarkcategory', Arr::assoc_to_keyval(Model_Landmarkcategory::find('all'),'id','categories'));
		$view->set_global('users', Arr::assoc_to_keyval(Model_User::find('all'), 'id', 'username'));


		$this->template->title = "Landmarks";
		$this->template->content = $view;

	}

	public function action_edit($id = null)
	{
		$view = View::forge('admin\landmarks/create');

		$landmark = Model_Landmark::find($id);
		$val = Model_Landmark::validate('edit');

		if ($val->run())
		{
			$landmark->placename = Input::post('placename');
			$landmark->slug = Inflector::friendly_title(Input::post('placename'),'-',true);
			$landmark->landmarkcategory_id = Input::post('landmarkcategory_id');
			$landmark->description = Input::post('description');
			$landmark->history = Input::post('history');
			$landmark->latitude = Input::post('latitude');
			$landmark->longhitude = Input::post('longhitude');
			$landmark->fileurl = Input::post('upload');
			$landmark->user_id = Input::post('user_id');



			$config = array(
		            'path' => DOCROOT.'uploads/jeepneyroute',
		            'normalize'   => true,
		            'randomize' => false,
		            'ext_whitelist' => array('png','jpg','bmp','jpeg'),
		            'max_size'    => 1024 * 1024,
		            );


				  while(Upload::get_files()){

                     Upload::process($config);

                        if (Upload::is_valid()) {
                                                                        
                                        Upload::save();

                                           $value = Upload::get_files();

                                           foreach($value as $files) {
                                               //print_r($files); 

                                                //$upload->filename = $value[0]['saved_as'];
                                                //$upload->size = $value[1]['size']/1024;
                                                //$landmark->fileurl = $value[1]['saved_to'].$value[0]['saved_as'];
                                                $landmark->fileurl = $value[0]['saved_as'];
                                                //$upload->type = $value[1]['extension'];
                                                $landmark->save();
                                            }



			if ($landmark->save())
			{
				Session::set_flash('success', e('Updated landmark #' . $id));

				Response::redirect('admin/landmarks');
			}

			else
			{
				Session::set_flash('error', e('Could not update landmark #' . $id));
			}

			}//end of if(Upload::is_valid())
				}//end of while loop
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$landmark->placename = $val->validated('placename');
				$landmark->slug = Inflector::friendly_title(Input::post('placename'),'-',true);
				$landmark->landmarkcategory_id = $val->validated('landmarkcategory_id');
				$landmark->description = $val->validated('description');
				$landmark->history = $val->validated('history');
				$landmark->latitude = $val->validated('latitude');
				$landmark->longhitude = $val->validated('longhitude');
				$landmark->fileurl = $val->validated('fileurl');
				$landmark->user_id = Input::post('user_id');
			

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('landmark', $landmark, false);
		}

		$view->set_global('landmarkcategory', Arr::assoc_to_keyval(Model_Landmarkcategory::find('all'),'id','categories'));
		$view->set_global('users', Arr::assoc_to_keyval(Model_User::find('all'), 'id', 'username'));


		$this->template->title = "Landmarks";
		$this->template->content = $view;


	}

	public function action_delete($id = null)
	{
		if ($landmark = Model_Landmark::find($id))
		{
			$landmark->delete();

			Session::set_flash('success', e('Deleted landmark #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete landmark #'.$id));
		}

		Response::redirect('admin/landmarks');

	}


	public function action_comment($slug)
	{
	   $landmark = Model_Landmark::find_by_slug($slug);
	    
	   // Lazy validation
	   if (Input::post('name') AND Input::post('email') AND Input::post('message'))
	   {
	   	  if(Auth::member(1 && 100)){
	   	  	 // Create a new comment
	     	 $landmark->comments[] = new Model_Comment(array(
	         'name' => $this->current_user->username,
	         'email' => $this->current_user->email,
	         'message' => Input::post('message'),
	         'user_id' => $this->current_user->id,
	      ));
	   	  }else{
	   	  	// Create a new comment
	     	 $landmark->comments[] = new Model_Comment(array(
	         'name' => Input::post('name'),
	         'email' => Input::post('email'),
	         'message' => Input::post('message'),
	      ));
	   	  }
	     
	       
	      // Save the post and the comment will save too
	      if ($landmark->save())
	      {
	         $comment = end($landmark->comments);
	         Session::set_flash('success', 'Added comment #'.$comment->id.'.');
	      }
	      else
	      {
	         Session::set_flash('error', 'Could not save comment.');
	      }
	       
	      Response::redirect('admin/landmarks/view/'.$slug);
	   }
	    
	   // Did not have all the fields
	   else
	   {
	      // Just show the view again until they get it right
	      $this->action_view($slug);
	   }
	}



public function action_vote($slug){

		$landmark = Model_Landmark::find_by_slug($slug);
	    
	   if (Input::method() == 'POST')
		{
				
				$ip = $_SERVER['REMOTE_ADDR'];
				$ip1 = '192.168.101.1';

				

				$result = DB::query("SELECT !COUNT(*) FROM `voteraters` WHERE `raters` ='$ip1' AND `landmark_id` = '$landmark->id'", DB::SELECT)->execute();

				if ($result[0]['!COUNT(*)'] == true){


				$voteitem = Model_Voteitem::forge(array(
					'landmark_id' => $landmark->id,
					'votes' => Input::post('votes'),
					'nrates' => Input::post('nrates'),
				));


				if(@$_POST['submit']){

				   	$insert = DB::query("INSERT INTO `voteitems` (`id`,`landmark_id`,`votes`) VALUES('$voteitem->landmark_id','$voteitem->landmark_id','$voteitem->votes') ON DUPLICATE KEY UPDATE `votes`=`votes`+'$voteitem->votes', `nrates`=`nrates`+ 1")->execute();
					 
					$query = DB::query("INSERT INTO `voteraters`(`raters`, `landmark_id`) VALUES('$ip','$voteitem->landmark_id')")->execute();

						if ($landmark)
					      {
					         Session::set_flash('success', 'Added Vote # '.$voteitem->landmark->placename.'.');
					      }
				      
  				}

			}else
				{
					Session::set_flash('error', 'Sorry you have already vote this landmark.');
				}

			
			$this->template->title = "Landmark";
			$this->template->content = Response::redirect('admin/landmarks/view/'.$slug);	       
	      	
	   }

	    
	   // Did not have all the fields
	   else
	   {
	      // Just show the view again until they get it right
	      $this->action_view($slug);
	   }
	
	}
	
}