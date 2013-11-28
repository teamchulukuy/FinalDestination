<?php
class Controller_Admin_Landmarkphotos extends Controller_Admin 
{

	public function action_index()
	{
		$data['landmarkphotos'] = Model_Landmarkphoto::find('all');
		$this->template->title = "Landmarkphotos";
		$this->template->content = View::forge('admin\landmarkphotos/index', $data);

	}

	public function action_view($id = null)
	{
		$data['landmarkphoto'] = Model_Landmarkphoto::find($id);

		$this->template->title = "Landmarkphoto";
		$this->template->content = View::forge('admin\landmarkphotos/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Landmarkphoto::validate('create');

			if ($val->run())
			{
				$landmarkphoto = Model_Landmarkphoto::forge(array(
					'filename' => Input::post('filename'),
					'size' => Input::post('size'),
					'type' => Input::post('type'),
					'fileurl' => Input::post('fileurl'),
					'landmarkid' => Input::post('landmarkid'),
				));

				if ($landmarkphoto and $landmarkphoto->save())
				{
					Session::set_flash('success', e('Added landmarkphoto #'.$landmarkphoto->id.'.'));

					Response::redirect('admin/landmarkphotos');
				}

				else
				{
					Session::set_flash('error', e('Could not save landmarkphoto.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Landmarkphotos";
		$this->template->content = View::forge('admin\landmarkphotos/create');

	}

	public function action_edit($id = null)
	{
		$landmarkphoto = Model_Landmarkphoto::find($id);
		$val = Model_Landmarkphoto::validate('edit');

		if ($val->run())
		{
			$landmarkphoto->filename = Input::post('filename');
			$landmarkphoto->size = Input::post('size');
			$landmarkphoto->type = Input::post('type');
			$landmarkphoto->fileurl = Input::post('fileurl');
			$landmarkphoto->landmarkid = Input::post('landmarkid');

			if ($landmarkphoto->save())
			{
				Session::set_flash('success', e('Updated landmarkphoto #' . $id));

				Response::redirect('admin/landmarkphotos');
			}

			else
			{
				Session::set_flash('error', e('Could not update landmarkphoto #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$landmarkphoto->filename = $val->validated('filename');
				$landmarkphoto->size = $val->validated('size');
				$landmarkphoto->type = $val->validated('type');
				$landmarkphoto->fileurl = $val->validated('fileurl');
				$landmarkphoto->landmarkid = $val->validated('landmarkid');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('landmarkphoto', $landmarkphoto, false);
		}

		$this->template->title = "Landmarkphotos";
		$this->template->content = View::forge('admin\landmarkphotos/edit');

	}

	public function action_delete($id = null)
	{
		if ($landmarkphoto = Model_Landmarkphoto::find($id))
		{
			$landmarkphoto->delete();

			Session::set_flash('success', e('Deleted landmarkphoto #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete landmarkphoto #'.$id));
		}

		Response::redirect('admin/landmarkphotos');

	}



	public function action_doupload() {
		
			$val = Model_Landmarkphoto::validate('doupload');

			if ($val->run())
			{

            $upload = Model_Landmarkphoto::forge();

            $config = array(
            'path' => DOCROOT.'uploads/landmarkphoto',
            'normalize'   => true,
            'randomize' => false,
            'ext_whitelist' => array('jpg','png','jpeg'),
            'max_size'    => 1024 * 1024,
            );

           
            
                while(Upload::get_files()){

                     Upload::process($config);

                        if (Upload::is_valid()) {
                                                                        
                                        Upload::save();

                                           $value = Upload::get_files();

                                           foreach($value as $files) {
                                               //print_r($files); 

                                                $upload->filename = $value[0]['saved_as'];
                                                $upload->size = $value[1]['size']/1024;
                                                $upload->fileurl = $value[1]['saved_to'].$value[0]['saved_as'];
                                                //$upload->fileurl = $value[1]['saved_to'];
                                                $upload->type = $value[1]['extension'];
                                                $upload->save();
                                            }
                                           

                            if ($upload->save())
                            {
                            	Session::set_flash('success', e('Added Landmark photo >> '.$upload->filename.'.'));
                            	Response::redirect('admin/landmarkphoto/create');

                            }
                                        
                        }
                       
                      else{
                            Session::set_flash('error', 'Invalid File Format, '.
                            'please try again!');
                       }

                       Response::redirect('admin/landmarkphoto/create');
                                
                 }//end of while
      
    		}//end of if

    		else
			{
				Session::set_flash('error', $val->error());
			}
               Response::redirect('admin/landmarkphoto/create');


	}//end of function


}