<?php
ob_start();
//error_reporting(1);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class holiday extends CI_CONTROLLER {

    private $max_image_size = '2000';
    private $max_image_width = '1024';
    private $max_image_height = '900';

    function __construct() {
        parent :: __construct();
        $this->load->database();       
        $this->load->model('holiday_model');
        $this->load->model('home_model');
        $this->load->model('holidaypackage_model');      
		$this->load->library('upload');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
         $this->load->library('admin_auth');
         $this->is_logged_in();
    }
    private function is_logged_in() {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('login/admin_login');
        }
    }
    public function package() {
        $data['status'] = '';
        $data['package'] = $this->holiday_model->getholidaypackages();
        $this->load->view('holiday/add_holiday_package', $data);
    }

    public function update_package($id) {

        $this->holiday_model->update_package($id);
        redirect('holiday/packagelist', 'refresh');
    }

    public function update_package_del($id) {
			//echo $id;exit;
        //$data['checkhol'] = $this->holiday_model->check_hol($id);
        //echo '<pre>';print_r($data['checkhol']);exit;
        // if (!empty($data['checkhol'])) {
            // //echo "sgf";exit;
            // $this->load->view('holiday/hol_book');
        // } else {
            $this->holiday_model->update_package_del($id);
           
            redirect('holiday/packagelist', 'refresh');
        //}
        //echo '<pre>';print_r($data['checkhol']);exit;
    }

    public function edit_package($id) {
	    $data['edit'] = $this->holiday_model->edit_package($id); 
        $data['editimg'] = $this->holiday_model->edit_img($id);
        $data['theme'] = $this->holiday_model->get_theme();
        $data['holicitylist'] = $this->holiday_model->get_all_holi_citylist();
        $this->load->helper('image');
       $this->load->view('holiday/add_holiday_list_edit', $data);
    }

    public function add_packages() {

        $desti = '';
        $holiday_type = $this->input->post('package_type');
        $holidayname = $this->input->post('package_name');
        $check_packname = $this->holiday_model->check_pack($holidayname);
        if ($check_packname) {
            $error = 'Package Name Already Exists..';
            redirect('holiday/package_error_page/' . base64_encode($error));
        } else {
            if ($holiday_type == "1") {
                $desti = $_POST['intdesti'];
            }
            if ($holiday_type == "2") {
                $desti = $_POST['domdesti'];
            }


            unset($v2);
            $v2 = '';
            foreach ($desti as $vl) {
                $v2 .=$vl . ',';
            }
            $destination = substr($v2, 0, -1);
//echo print_r($destination);exit;
            $this->holiday_model->addpackage($holiday_type, $holidayname, $destination);
            redirect('holiday/dsp_pk', 'refresh');
        }
    }

    public function dsp_pk() {
//echo '<pre>';print_r($this->session->all_userdata());exit;
        $package = $this->holiday_model->getholidaypackages();
        $data['package'] = $package;
        $data['status'] = '0';
        $this->load->view('holiday/add_holiday_package', $data);
    }

    public function holidaypackagelist() {

        $data['status'] = '';
        $data['hotel_name1'] = $this->holiday_model->get_hotel_name_int();
        $data['hotel_name2'] = $this->holiday_model->get_hotel_name_dom();
        $data['cur'] = $this->holiday_model->get_currency();
        $data['theme'] = $this->holiday_model->get_theme();
        $data['holicitylist'] = $this->holiday_model->get_all_holi_citylist();

        // echo '<pre>';print_r($data['holicitylist']);exit;
        $this->load->view('holiday/add_holiday_list', $data);
    }

    public function packages($id, $status) {

        $package = $this->holiday_model->holidaypackages($id, $status);
        echo '<select name="holiday_category" style="width:200px;" id="holiday_title" onchange="return getCity(this.value);">';
        echo ' <option value="">--select Category--</option>';
        for ($i = 0; $i < count($package); $i++) {
            echo '<option value="' . $package[$i]->holi_id . '">' . $package[$i]->package_name . '</option>';
        }

        echo '</select>';
    }
      public function destinationCityList($str) {
        $packagecity = $this->holiday_model->destinationCityList($str);
        // $packagecity = $this->holiday_model->holidaypackagecity($id);
       // echo '<select name="desti1[]" size="5" id="get_city_d" multiple="multiple" class="required" style="width:275px;">';

        for ($i = 0; $i < count($packagecity); $i++) {
            echo '<option value="' . $packagecity[$i]->city_id . '"  >' . $packagecity[$i]->city_name . '</option>';
        }
       // echo '</select>';
    }
    function holidaylist_old() {
     //echo '<pre>';print_r($_POST);exit;
        $theme = $this->input->post('holiday_theme');
       $hol_theme = implode(",", $theme);
//        echo'<pre>';print_r($theme);
             //echo'<pre>';print_r($hol_theme);
             //exit;
        $package_title = $this->input->post('package_title');
        $trans = $this->input->post('trans');
        //$transport = implode(",", $trans);
        $desti = $this->input->post('desti');
        $destination = implode(",", $desti);
        $get_city_details = $this->holiday_model->get_city_l($destination);
        $city_nm = '';
        $country = $this->holiday_model->getcountry($desti);
        $cntry = '';
        foreach ($country as $c) {
            $cntry = $c->country;
        }
        $continentid=array();
        $countryid=array();
        $stateid=array();
        $i=$j=$k=0;
        foreach($desti as $destcityid)
        {
          $continentid[$i++]=$this->holiday_model->getcontinentId($destcityid)->continent_id;
          $countryid[$j++]=$this->holiday_model->getcountryId($destcityid)->country_id;
          $stateid[$k++]=$this->holiday_model->getstateId($destcityid)->state_id;
        }
		 $continentStr=implode(",",array_unique($continentid));
         $countryStr=implode(",",array_unique($countryid));
         $stateStr=implode(",",array_unique($stateid)); 
        // echo $continentStr."<br>".$countryStr."<br>".$stateStr; exit;
        $duration = $this->input->post('duration');
        $tags = $this->input->post('tour');
        //$tourtags = implode(",", $tags);
        //$s_date=$_POST['checkIn'];
        //$e_date=$_POST['checkOut'];
        $s_date = date("Y-m-d", strtotime($_POST['checkIn']));
        $e_date = date("Y-m-d", strtotime($_POST['checkOut']));
        //echo $s_date;
        //echo $s_date1;echo "and ";
        //echo $e_date;
        //echo $e_date1;exit;
        $description = addslashes($this->input->post('description'));
		
		$package_desc=addslashes($this->input->post('package_desc'));
		
        $offer = addslashes($this->input->post('spcloffer'));
        $highlight = addslashes($this->input->post('highlight'));
        // $iternery = addslashes($this->input->post('iternery'));
        $hotel_desc = $this->input->post('hotel_desc');
        $comments = addslashes($this->input->post('comments'));
        $inclusion = addslashes($this->input->post('inclusion'));
        $exclusion = addslashes($this->input->post('exclusion'));
        $hotelname = $this->input->post('hotel_name');
        //$hotel_id = implode(",", $hotelname);
        $get_hotel_details = $this->holiday_model->get_name($hotelname);
        $hotel_nm = '';
        $hol_hot_id = '';
        foreach ($get_hotel_details as $h) {
            $hotel_nm.= $h->hotel_name . ',';
            $hol_hot_id.=$h->holiday_hotel_list_id . ',';
        }
        $price = $this->input->post('price_ad');
        $price1 = $this->input->post('price_ad');
        $price2 = $this->input->post('price_ch');
        $price4 = $this->input->post('no_bed');
        $price3 = $this->input->post('price_in');
        $cur = $this->input->post('currency');
        $tax = $this->input->post('tax');
		
		
		// $price_desc = $this->input->post('price_desc');
        $price_desc = '';
		
		
		
        $pptype = $this->input->post('ptype');
        // $email = $this->input->post('email');
         $email = '';
        $term = $this->input->post('terms');
       // $jpmiles = $this->input->post('jpmiles');
      //  $priority = $this->input->post('priority');
        $month = $this->input->post('month');
        $montharray = implode(",", $month);
        $category = $this->input->post('category');
        $categoryarray = implode(",", $category);
        // $temperature = $this->input->post('temperature');
         $temperature = '';
       
        //$direction=$this->input->post('dir');
        $Gmap = $this->input->post('image3');
        $priority=0;
        //$yvideo = implode(",", $Gmap);
		//$priority=$this->input->post('priority');
        $yvideo = str_replace('width="560"', 'width="100%"', $yvideo);
        $yvideo = str_replace('height="315"', 'height="200"', $yvideo);


        $query = "INSERT INTO `holiday_list`(`holiday_id`,`pcakage_title`,`tags`,`destination`,`transportation`,`duration`,`start_date`,`end_date`,`description`,`hotel_desc`,`highlights`,`inclusion`,`exclusion`,`comments`,`email`,`thumb_image`,`large_img`,`images`,`yvideo`,`special_offers`,`status`,`adult_price`,`child_price`,`infant_price`,`currency`,`holiday_hotel_name`,`holiday_hotel_list_id`,`price`,`terms`,`theme_id`,`child_no_bed`,`package_desc`,`price_desc`,`month_dur`,`category`,`temperature`)	VALUES('$maxno','$package_title','$tourtags','$destination','$transport','$duration','$s_date','$e_date','$description','$hotel_desc','$highlight','$inclusion','$exclusion','$comments','$email','$thumbfileTime','$largefileTime','$IMAGE','$yvideo','$offer','1','$price1','$price2','$price3','$cur','$hotel_nm','$hol_hot_id','$price','$term','$hol_theme','$price4','$package_desc','$price_desc','$montharray','$categoryarray','$temperature')";
       // echo $query;exit;
        if (!mysql_query($query))
            exit(mysql_error());
        $id = mysql_insert_id();
        // echo $continentStr."<br>".$countryStr."<br>".$stateStr; exit;
        $updatesql="UPDATE `holiday_list` SET `continent`='$continentStr',`country`='$countryStr',`state`='$stateStr' WHERE holiday_id='$id'";
        mysql_query($updatesql);
        $this->upload_images($id);
        if (!mysql_query("UPDATE `holiday_package` SET `status`='1' WHERE holi_id='$holiday_category'"))
            die(mysql_error());

        $package = $this->holiday_model->getholidaylist();
		
        redirect('holiday/packagelist', 'refresh');
    }
    
    public function upload_images($id) {

        //Image Size	
        $image_size = $this->config->item('image_sizes');

        //Upload Configuration Image
        $config['upload_path'] = './holidayimages/' . $id . '/thumbnail/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        // $config['max_size'] =  $this->max_image_size;
        // $config['max_width'] =  $this->max_image_width;
        // $config['max_height'] = $this->max_image_height;		 
        // $config['resize'] = true;
        $config['rename'] = true;
        $config['image_sizes'] = $image_size;
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, TRUE);
        }
        $this->load->library("Multifile_Upload", $config);
        $this->Multifile_Upload = new Multifile_Upload;
        $this->Multifile_Upload->initialize($config);
        $this->Multifile_Upload->set_allowed_types('gif|jpg|png|jpeg');
        $this->Multifile_Upload->do_upload('thumb_image');

        //Insert Image Path into table
        foreach ($this->Multifile_Upload->saved_filename as $imgfile) {
            $imagepath = 'holidayimages/' . $id . '/thumbnail/' . $imgfile;

            $this->holiday_model->upload_images($id, $imagepath, 1);
        }



  /* if(!empty($_FILES['itineraryimage'])){
print_r($_FILES['itineraryimage']);

            $this->holiday_model->upload_images_itinerary($id, $imagepath, 1);
            echo $this->db->last_query();
exit;

   }
     */   


        //Upload Configuration Gallery
        $config1['upload_path'] = './holidayimages/' . $id . '/gallery/';
        $config1['allowed_types'] = 'gif|jpg|png|jpeg';
        // $config1['max_size'] = $this->max_image_size;
        // $config1['max_width'] = $this->max_image_width;
        //$config1['max_height'] = $this->max_image_height;
        // $config1['resize'] = true;
        $config1['rename'] = true;
        $config1['image_sizes'] = $image_size;

        if (!is_dir($config1['upload_path'])) {
            mkdir($config1['upload_path'], 0755, TRUE);
        }


        $this->Multifile_Upload->initialize($config1);
        $this->Multifile_Upload->set_allowed_types('gif|jpg|png|jpeg');
        $this->Multifile_Upload->do_multi_upload('holiday_gallery_image');

        //Insert Image Path into table		 
        foreach ($this->Multifile_Upload->saved_filename as $imgfile) {
            $imagepath = 'holidayimages/' . $id . '/gallery/' . $imgfile;

            $this->holiday_model->upload_images($id, $imagepath, 2);
        }
        // exit;

         //Upload Configuration Image
        $config['upload_path'] = './holidayimages/' . $id . '/map/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        // $config['max_size'] =  $this->max_image_size;
        // $config['max_width'] =  $this->max_image_width;
        // $config['max_height'] = $this->max_image_height;      
        // $config['resize'] = true;
        $config['rename'] = true;
        $config['image_sizes'] = $image_size;
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, TRUE);
        }
        $this->load->library("Multifile_Upload", $config);
        $this->Multifile_Upload = new Multifile_Upload;
        $this->Multifile_Upload->initialize($config);
        $this->Multifile_Upload->set_allowed_types('gif|jpg|png|jpeg');
        $this->Multifile_Upload->do_upload('holiday_map_image');

        //Insert Image Path into table
        foreach ($this->Multifile_Upload->saved_filename as $imgfile) {
            $imagepath = 'holidayimages/' . $id . '/map/' . $imgfile;

            $this->holiday_model->upload_images($id, $imagepath, 3);
        }
    }

    public function delete_image_old($id) {
//print_r($id);exit;
        if (!empty($id)) {
		unlink($id);
            $this->holiday_model->delete_image($id);
        }
        die();
    }
	//Holiday package active inactive
	/*public function holidaylist_active($hol_id,$id){
	
	
	//$this->holiday_model->holidaylist_status($hol_id,$id);
	   $package = $this->holiday_model->getholidaylist();

        $data['package'] = $package;
	      redirect('holiday/packagelist', 'refresh');
	}*/
		
		public function holiday_active($hol_id,$id){
			//	print_r($hol_id);print_r($id);
		//	$data['status']=$this->holiday_model->get_status($hol_id);
			$this->holiday_model->package_active($hol_id,$id);

				//$package = $this->holiday_model->getholidaylist();

        //$data['package'] = $package;
        //echo '<pre>';        print_r($data); exit;
        //$this->load->view('holiday/holidaylist', $data);
	    redirect('holiday/packagelist', 'refresh');
}
//ends here
    public function packagelist($linktype="",$limit=100,$upto=0) {
       $data['status']=$status=isset($_GET['status'])?$_GET['status']:'all';
       $data['from_date']=$from_date=isset($_GET['from_date'])?$_GET['from_date']:'';
       $data['to_date']=$to_date=isset($_GET['to_date'])?$_GET['to_date']:'';
        $uptopre=$upto;
        $uptonext=$upto;       
        if($upto<0)
        {
            $upto=0;
            $uptopre=0;
            $uptonext=0;
        }
        else if($upto>=100)
        {
             $uptopre=$upto-100;
             $uptonext=$upto+100;
        }
        else 
        {
          $uptopre=$upto;
          $uptonext=$upto+100;  
        }

        if($linktype==''|| $linktype=='all')     
        {
            $upto=0;
            $uptopre=0;
            $uptonext=0; 
        }

        if($limit<1)
        {           
            $limit=100;
        }

        // if($linktype=="next")
        // {          
        //   $upto=$upto;
        // }
        // else if($linktype=="pre")
        // {          
        //   $upto=$uptopre;
        // }
        // else
        // { 
        //     $upto=$upto;
        // } 

        $split_arr=explode('?', $_SERVER['REQUEST_URI']);
        $getstr=(!empty($split_arr[1]))?'?'.$split_arr[1]:'';
    
        $data['linkall']=site_url().'/holiday/packagelist/all'.$getstr;
        $data['linkpre']=site_url().'/holiday/packagelist/pre/'.$limit.'/'.$uptopre.$getstr;
        $data['linknext']=site_url().'/holiday/packagelist/next/'.$limit.'/'.$uptonext.$getstr;
       if($status=='all'||$status==1){
       $data['activepackage'] = $this->holiday_model->get_all_activeholiday_list($from_date,$to_date,$limit,$upto,$linktype);
       }
       else
       {
         $data['activepackage']='';
       }

       $data['package'] = $this->holiday_model->get_all_holiday_list($status,$from_date,$to_date,$limit,$upto,$linktype);    
        $this->load->view('holiday/holidaylist', $data);
    }
//clone
function holiday_clone($clone_id){
$clone_hol=$this->holiday_model->clone_holiday($clone_id);

redirect('holiday/packagelist');
}
    public function packagecity($id) {
        $packagecity = $this->holiday_model->holidaypackagecity($id);
        echo '<select name="desti1[]" size="5" id="get_city_d" multiple="multiple" class="required" style="width:275px;">';

        for ($i = 0; $i < count($packagecity); $i++) {
            echo '<option value="' . $packagecity[$i]->city_id . '"  >' . $packagecity[$i]->city_name . '</option>';
        }
        echo '</select>';
    }

    function testingimage() {
        $this->load->view('test');
    }

    function imageup() {
        $this->load->library('upload'); // Load Library
        $this->upload->initialize(array(
            "upload_path" => "/path/to/upload/to/"
        ));

        //Perform upload.
        if ($this->upload->do_multi_upload('files')) {

            echo 'sadsadsd';
            //Code to run upon successful upload.
        }
    }

    ///////
    function editholidaylist_old() {
        
		echo '<pre>';print_r($_POST);exit;
		
        $holidayid = $_POST['holiday_id'];
        //$gal_img=$_POST['gal_img'];
        //echo $gal_img;
        $holiday_type = $this->input->post('holiday_type');
        $holiday_category = $this->input->post('holiday_category');
        $package_title = $this->input->post('package_title');
        $package_type = $this->input->post('package_type');
        $theme = $this->input->post('holiday_theme');
        $hol_theme = implode(",", $theme);
        $trans = $this->input->post('trans');
        $transport = implode(",", $trans);
        $direction = $this->input->post('dir');
        $hotel_desc = addslashes($this->input->post('hotel_desc'));
        $hotelname = $this->input->post('hotel_name');
        $get_hotel_details = $this->holiday_model->get_name($hotelname);

        $hotel_nm = '';
        $hol_hot_id = '';
        foreach ($get_hotel_details as $h) {
            $hotel_nm.= $h->hotel_name . ',';
            $hol_hot_id.=$h->holiday_hotel_list_id . ',';
        }
        $desti = $this->input->post('desti');
        $destination = implode(",", $desti);
        $duration = $this->input->post('duration');
        $tags = $this->input->post('tour');
        $tourtags = implode(",", $tags);
        ///
        $month = $this->input->post('month');
        $montharray = implode(",", $month);
        $category = $this->input->post('category');
        $categoryarray = implode(",", $category);
        // $temperature = $this->input->post('temperature');
        $temperature = '';


        $continentid=array();
        $countryid=array();
        $stateid=array();
        $i=$j=$k=0;
        foreach($desti as $destcityid)
        {
          $continentid[$i++]=$this->holiday_model->getcontinentId($destcityid)->continent_id;
          $countryid[$j++]=$this->holiday_model->getcountryId($destcityid)->country_id;
          $stateid[$k++]=$this->holiday_model->getstateId($destcityid)->state_id;
        }
         $continentStr=implode(",",array_unique($continentid));
         $countryStr=implode(",",array_unique($countryid));
         $stateStr=implode(",",array_unique($stateid)); 
        ///
        $s_date = date("Y-m-d", strtotime($_POST['checkIn']));
        $e_date = date("Y-m-d", strtotime($_POST['checkOut']));
        $description = addslashes($this->input->post('description'));
		
		$package_desc=addslashes($this->input->post('package_desc'));
		
		// $price_desc=addslashes($this->input->post('price_desc'));
		  $price_desc='';
		
		
        $highlight = addslashes($this->input->post('highlight'));
        // $iternery = addslashes($this->input->post('iternery'));
        $inclusion = addslashes($this->input->post('inclusion'));
        $exclusion = addslashes($this->input->post('exclusion'));
        $comments = addslashes($this->input->post('exclusion'));
        $price = $this->input->post('price_ad');
        $price1 = $this->input->post('price_ad');
        $price2 = $this->input->post('price_ch');
        $price3 = $this->input->post('price_in');
        $price4 = $this->input->post('no_bed');
        $offer = $this->input->post('spcloffer');
        $cur = $this->input->post('currency');
        // $email = $this->input->post('email');
        $email = '';
        $term = $this->input->post('terms');
        //$jpmiles = $this->input->post('jpmiles');
        $priority = $this->input->post('priority');
		$longitude = $this->input->post('longitude');
		$Lattitude = $this->input->post('Lattitude');
		
        $Gmap = $this->input->post('image3');
        $yvideo = implode(",", $Gmap);
        $yvideo = str_replace('width="560"', 'width="100%"', $yvideo);
        $yvideo = str_replace('height="315"', 'height="200"', $yvideo);
        $galimgid = $this->holiday_model->get_img($holidayid, 2);
        $maxno = $holidayid;
        //$maxno++;
        // $image2 = $_FILES["image2"];
        // $imgs = count($image2['name']);
        // $allowed_filetypes = array('.jpg', '.gif', '.bmp', '.png', '.jpeg', '.JPG', '.jfif');
        // $j = 0;
        // unset($IMAGE);
        // $IMAGE = 0;
        // for ($i = 0; $i < $imgs; $i++) {
        // if ($image2['error'][$i] != 0)
        // continue;
        // $image = $image2['name'][$i];
        // $ext = substr($image, strpos($image, '.'), strlen($image) - 1);
        // $image = explode(".", $image);
        // if (!in_array($ext, $allowed_filetypes))
        // continue;
        // $j++;
        // $tmp = $maxno . "-image-" . $j . "." . $image[1];
        // move_uploaded_file($image2["tmp_name"][$i], 'holidayimages/' . $tmp);
        // $IMAGE.=$tmp . '|U|';
        // $this->holiday_model->update_img($maxno, $tmp);
        // }
//echo $IMAGE;exit;
        // if ($_FILES['thumbImage']['name'] != "") {
        // $dir = "holidayimages/";
        // $thumbfileTime = time() . $_FILES['thumbImage']['name'];
        // copy($_FILES['thumbImage']['tmp_name'], $dir . $thumbfileTime);
        // }
        // if ($_FILES['largeImage']['name'] != "") {
        // $dir = "holidayimages/";
        // $largefileTime = time() . $_FILES['largeImage']['name'];
        // copy($_FILES['largeImage']['tmp_name'], $dir . $largefileTime);
        // }
        // if (isset($largefileTime) && $largefileTime != '') {
        // $largefileTime = $largefileTime;
        // } else {
        // $oldimg = $this->holiday_model->edit_package($holidayid);
        // $largefileTime = $oldimg->large_img;
        // }
        // if (isset($thumbfileTime) && $thumbfileTime != '') {
        // $thumbfileTime = $thumbfileTime;
        // } else {
        // $oldimgthumb = $this->holiday_model->edit_package($holidayid);
        // $thumbfileTime = $oldimg->thumb_image;
        // }
        $this->upload_images($holidayid);
        $result = $this->holiday_model->updateholidaylist($holidayid, $holiday_type, $holiday_category, $package_title, $package_type, $transport, $destination, $duration, $tourtags, $s_date, $e_date, $description, $highlight, $inclusion, $exclusion, $hotel_desc, $offer, $tax, $pptype, $email, $IMAGE, '1', $yvideo, $comments, $hotel_nm, $hol_hot_id, $price1, $price2, $price3, $cur, $price, $term, $hol_theme, $price4, $priority,$package_desc,$longitude,$Lattitude,$price_desc,$montharray,$categoryarray,$temperature,$continentStr,$countryStr,$stateStr);
        //echo $this->db->last_query();exit;

        redirect('holiday/packagelist', 'refresh');
    }

    public function packagelist_ed() {

		$data['from_date']=$from_date=isset($_GET['holi_from_date']) ? $_GET['holi_from_date'] : '';
		$data['to_date']=$to_date=isset($_GET['holi_to_date']) ? $_GET['holi_to_date'] : '';
	
	
        $package = $this->holiday_model->getholidaylist_sve($from_date,$to_date);

        $data['package'] = $package;
        //echo '<pre>';        print_r($data); exit;
        $this->load->view('holiday/holidaylist', $data);
    }

    public function addcountry($error = '') {
        $data = '';
        if ($error == 1) {
            $data['error'] = 'The selected city name already exists..! Please select other city';
        }
        $data['cclist'] = $this->holiday_model->get_cclist();
        $data['country_list'] = $this->holiday_model->get_country_list();
        $this->load->view('holiday/add_country', $data);
    }

    public function add_country() {
        //echo '<pre>';print_r($_POST);exit;
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'required');
		$this->form_validation->set_rules('latitude', 'latitude', 'required');
		$this->form_validation->set_rules('longitude', 'longitude', 'required');
		
        $data = '';
        $data['country_list'] = $this->holiday_model->get_country_list();

        $city = $this->input->post('city');
        $country = $this->input->post('country');
		$latitude = $this->input->post('latitude');
		$longitude = $this->input->post('longitude');
		
        $check_city_avail = $this->holiday_model->check_city_avail($city);
        // echo '<pre>';print_r($check_city_avail);exit;
        if (!empty($check_city_avail)) {
            redirect('holiday/addcountry/1');
        } else {

            $city_type = '';
            if ($country == 'India') {
                $city_type = "Domestic";
            } else {
                $city_type = "International";
            }


            $addcounty = $this->holiday_model->add_country($city, $country, $city_type,$latitude,$longitude);
            redirect('holiday/addcountry', 'refresh');
        }
    }

    public function addhotel() {
        $data = '';
        $data['hlist'] = $this->holiday_model->get_hotel();
        $this->load->view('holiday/add_hotel', $data);
    }

    public function add_hotel() {
        //echo print_r($_POST);exit;
        $hol_hotel_type = $this->input->post('hotel_int');
        $hotel_nm = $this->input->post('hotel_name');
        $hotel_type = $this->input->post('hotel_type');
        if ($hotel_type == '') {

            $hotel_typ = "Standard";
        } else {
            $hotel_typ = $hotel_type;
        }
        $hotel_rate = $this->input->post('hotel_rate');
        $hotel_single = $this->input->post('price_single');
        $hotel_double = $this->input->post('price_double');
        $hotel_triple = $this->input->post('price_triple');
        //$hotel_bed=$this->input->post('ch_bed');
        //$hotel_nobed=$this->input->post('ch_no_bed');
        $hotel_add = $this->input->post('add_price');
        if ($_FILES['hotelimage']['name'] != "") {
            $dir = "hotelimages/";
            $thumbfileTime = time() . $_FILES['hotelimage']['name'];
            copy($_FILES['hotelimage']['tmp_name'], $dir . $thumbfileTime);
        }

        $hotel = array
            (
            'holiday_hotel_type' => $hol_hotel_type,
            'hotel_name' => $hotel_nm,
            'hotel_type' => $hotel_typ,
            'star_rating' => $hotel_rate,
            'price_per_single_room' => $hotel_single,
            'price_per_double_room' => $hotel_double,
            'price_per_triple_room' => $hotel_triple,
            'hotel_images' => $thumbfileTime,
            'additional_price_per_night' => $hotel_add
                //'child_bed'=>$hotel_bed,
                //'child_no_bed'=>$hotel_nobed
        );
        $hotel = $this->holiday_model->add_hotel($hotel); //echo $this->db->last_query();exit;
        redirect('holiday/addhotel', 'refresh');
    }

    /*     * ********************************Get Lat and Long************************************* */

    public function getLocation($address) {
        $url = 'http://maps.google.com/maps/api/geocode/json?sensor=false&address=';
        $url = $url . urlencode($address);

        $resp_json = $this->curl_file_get_contents($url);
        $resp = json_decode($resp_json, true);

        if ($resp['status'] = 'OK') {
            return $resp['results'][0]['geometry']['location'];
        } else {
            return false;
        }
    }

    private function curl_file_get_contents($URL) {
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $URL);
        $contents = curl_exec($c);
        curl_close($c);

        if ($contents)
            return $contents;
        else
            return FALSE;
    }

    public function promo_hol() {
		//print_r($_POST);exit;
        $pr = $_POST['message'];
		$rec1 = $_POST['message1'];
        foreach ($pr as $promo) {
            $promo_act = $this->holiday_model->update_promo($promo,'1');
        }
			foreach ($rec1 as $recom) {
            $rec_act = $this->holiday_model->update_promo($recom,'0');
        }
    }

	public function subpage_rec(){
	
	$subpage_rec=$_POST['message'];
	$rec1 = $_POST['message1'];
	//print_r($subpage_rec);exit;
	foreach($subpage_rec as $sb){
	
	$subpage_rec=$this->holiday_model->subpage_rec($sb,'1');
	}
		foreach ($rec1 as $recom) {
            $rec_act = $this->holiday_model->subpage_rec($recom,'0');
        }
	}
	
	public function holiday_thm(){
	
	$holiday_thm=$_POST['message'];
	$rec1 = $_POST['message1'];
	//print_r($subpage_rec);exit;
	foreach($holiday_thm as $sb){
	
	$holiday_thm=$this->holiday_model->holiday_thm($sb,'1');
	echo $this->db->last_query();
	}
	foreach ($rec1 as $recom) {
            $rec_act = $this->holiday_model->holiday_thm($recom,'0');
			//echo $this->db->last_query();
        }
	
	}

    public function dome_hol() {
	//print_r($_POST['message']);exit;
        $rec = $_POST['message'];
		 $rec1 = $_POST['message1'];
		foreach ($rec as $recom) {
            $rec_act = $this->holiday_model->update_dom($recom,'1');
        }
		foreach ($rec1 as $recom) {
            $rec_act = $this->holiday_model->update_dom($recom,'0');
        }
    }

	    public function rec_hol() {
        $rec = $_POST['message'];
		$rec1 = $_POST['message1'];
        foreach ($rec as $recom) {
            $rec_act = $this->holiday_model->update_rec($recom,'1');
        }
			foreach ($rec1 as $recom) {
            $rec_act = $this->holiday_model->update_rec($recom,'0');
        }
    }
	
    public function inter_hol() {
        $rec = $_POST['message'];
		$rec1 = $_POST['message1'];
        foreach ($rec as $recom) {
            $rec_act = $this->holiday_model->update_int($recom,'1');
        }
			foreach ($rec1 as $recom) {
            $rec_act = $this->holiday_model->update_int($recom,'0');
        }
    }

///////////////////hol_cruises//////////////////
    public function hol_cruises() {
        $data = '';
        $data['from_dest'] = $this->holiday_model->get_cruise_dest();
        $data['country_list'] = $this->holiday_model->get_country_list();
        $this->load->view('holiday/add_cruise', $data);
    }

    public function add_cruise() {
        $cruise_name = $this->input->post('package_title');
        $cruise_from = $this->input->post('from_dest');
        $cruise_to = $this->input->post('to_dest');
        $cruise_country = $this->input->post('country');
        $cruise_shipname = $this->input->post('ship_name');
        $cruise_duration = $this->input->post('duration');
        $s_date = date("Y-m-d", strtotime($_POST['checkIn']));
        $e_date = date("Y-m-d", strtotime($_POST['checkOut']));
        $cruise_shipdtls = addslashes($this->input->post('shipdtls'));
        $cruise_iternery = $this->input->post('iternery');
        $cruise_desc = addslashes($this->input->post('desc'));
        $cruise_price = $this->input->post('price');
        $cruise_cabin = $this->input->post('cab_cat');
        if ($_FILES['thumbImage']['name'] != "") {
            $dir = "holidayimages/";
            $thumbfileTime = time() . $_FILES['thumbImage']['name'];
            copy($_FILES['thumbImage']['tmp_name'], $dir . $thumbfileTime);
        }
        if ($_FILES['shipimage']['name'] != "") {
            $dir = "holidayimages/";
            $shipimage = time() . $_FILES['shipimage']['name'];
            copy($_FILES['shipimage']['tmp_name'], $dir . $shipimage);
        }

        $cruise = array(
            'cruise_name' => $cruise_name,
            'embarkation' => $cruise_from,
            'disembarkation' => $cruise_to,
            'ship_name' => $cruise_shipname,
            'duration' => $cruise_duration,
            'start_date' => $s_date,
            'end_date' => $e_date,
            'ship_details' => $cruise_shipdtls,
            'itinerary' => $cruise_iternery,
            'price' => $cruise_price,
            'cr_image' => $thumbfileTime,
            'cabin_category' => $cruise_cabin,
            'country' => $cruise_country,
            'ship_image' => $shipimage,
            'description' => $cruise_desc
        );
        $this->holiday_model->insert_cruise($cruise);
        redirect('holiday/cruise_list');
    }

    public function cruise_list() {
        $data['cr_result'] = $this->holiday_model->get_cr_dtls();
        $this->load->view('holiday/cruise_list', $data);
    }

    public function edit_cruise_hol($id) {
        $data['edit'] = $this->holiday_model->edit_cr_package($id);
//echo '<pre>';print_r($data['edit']);exit;
        $data['from_dest'] = $this->holiday_model->get_cruise_dest();
        $data['country_list'] = $this->holiday_model->get_country_list();
        $this->load->view('holiday/cruise_edit', $data);
    }

    public function del_cruise_hol($id) {
        $data['del'] = $this->holiday_model->delete_cruise($id);
//$this->load->view('holiday/cruise_edit',$data);
        redirect('holiday/cruise_list');
    }

    public function edit_cruise() {
//echo '<pre>';print_r($_POST);exit;
        $cruise_id = $_POST['cr_id'];
        $cr_img1 = $_POST['eimg'];
        $cr_img2 = $_POST['simg'];
        $cruise_name = $this->input->post('package_title');
        $cruise_from = $this->input->post('from_dest');
        $cruise_to = $this->input->post('to_dest');
        $cruise_country = $this->input->post('country');
        $cruise_shipname = $this->input->post('ship_name');
        $cruise_duration = $this->input->post('duration');
        $s_date = date("Y-m-d", strtotime($_POST['checkIn']));
        $e_date = date("Y-m-d", strtotime($_POST['checkOut']));
        $cruise_shipdtls = addslashes($this->input->post('shipdtls'));
        $cruise_iternery = $this->input->post('iternery');
        $cruise_desc = addslashes($this->input->post('desc'));
        $cruise_price = $this->input->post('price');
        $cruise_cabin = $this->input->post('cab_cat');
        $thumbfileTime = '';
        $shipimage = '';

        if ($_FILES['thumbImage']['name'] != "") {
            $dir = "holidayimages/";
            $thumbfileTime = time() . $_FILES['thumbImage']['name'];
            copy($_FILES['thumbImage']['tmp_name'], $dir . $thumbfileTime);
        } else {
            $thumbfileTime = $cr_img1;
        }


        if ($_FILES['shipimage']['name'] != "") {
            $dir = "holidayimages/";
            $shipimage = time() . $_FILES['shipimage']['name'];
            copy($_FILES['shipimage']['tmp_name'], $dir . $shipimage);
        } else {
            $shipimage = $cr_img2;
        }

        $this->holiday_model->update_cruise($cruise_id, $cruise_name, $cruise_from, $cruise_to, $cruise_shipname, $cruise_duration, $s_date, $e_date, $cruise_shipdtls, $cruise_iternery, $cruise_price, $thumbfileTime, $cruise_cabin, $cruise_country, $shipimage, $cruise_desc);
        redirect('holiday/cruise_list');
    }

    public function edit_hotel($id) {
        $data = '';
        $data['res'] = $this->holiday_model->edit_hotel($id);
        $this->load->view('holiday/edit_hotel', $data);
    }

    public function add_edit_hotel() {
        //echo print_r($_POST);exit;
        $hid = $_POST['hid'];
        $old_img = $_POST['old_img'];
        $hol_hotel_type = $this->input->post('hotel_int');
        $hotel_nm = $this->input->post('hotel_name');
        $hotel_type = $this->input->post('hotel_type');
        if ($hotel_type == '') {

            $hotel_typ = "Standard";
        } else {
            $hotel_typ = $hotel_type;
        }
        $hotel_rate = $this->input->post('hotel_rate');
        $hotel_single = $this->input->post('price_single');
        $hotel_double = $this->input->post('price_double');
        $hotel_triple = $this->input->post('price_triple');
        $hotel_add = $this->input->post('add_price');
        //$hotel_bed=$this->input->post('ch_bed');
        //$hotel_nobed=$this->input->post('ch_no_bed');
        //$thumbfileTime='';
        if ($_FILES['hotelimage']['name'] != "") {
            $dir = "hotelimages/";
            $thumbfileTime = time() . $_FILES['hotelimage']['name'];
            copy($_FILES['hotelimage']['tmp_name'], $dir . $thumbfileTime);
        }
        if ($thumbfileTime == '') {
            $thumbfileTime = $old_img;
        }
        /* if (isset($thumbfileTime) && $thumbfileTime != '') {
          $thumbfileTime = $thumbfileTime;
          } else {
          //$oldimg = $this->holiday_model->edit_package($hid);
          $thumbfileTime = $old_img;
          } */
        //echo $thumbfileTime;exit;
        $this->holiday_model->update_hotel($hid, $hol_hotel_type, $hotel_nm, $hotel_typ, $hotel_rate, $hotel_single, $hotel_double, $hotel_triple, $thumbfileTime, $hotel_add);
        redirect('holiday/addhotel', 'refresh');
    }

    public function del_hotel($id) {
        $data['res'] = $this->holiday_model->del_hotel($id);
        redirect('holiday/addhotel', 'refresh');
    }

    function package_error_page($error) {
        $data['error'] = $error;
        $data['package'] = $this->holiday_model->getholidaypackages();
        $this->load->view('holiday/package_error_page', $data);
    }

    public function preview($id) {
        $data = '';
        $data['holiday_details'] = $this->holiday_model->get_prev($id);
        $data['hol_img_id'] = $this->holiday_model->get_img($id, 2);
        $this->load->view('holiday/prev_hol', $data);
    }

    public function edit_holiday_package($id) {
        $data['package'] = $this->holiday_model->get_hol_package_by_id($id);
        $this->load->view('holiday/edit_holiday_package', $data);
        //   echo '<pre>'; print_r($data); exit;
    }

    public function update_holiday_package($id) {
        $desti = '';
        $holiday_type = $this->input->post('package_type');
        $holidayname = $this->input->post('package_name');
        //$check_packname = $this->holiday_model->check_pack($holidayname);

        if ($holiday_type == "1") {
            $desti = $_POST['intdesti'];
        }
        if ($holiday_type == "2") {
            $desti = $_POST['domdesti'];
        }


        unset($v2);
        $v2 = '';
        foreach ($desti as $vl) {
            $v2 .=$vl . ',';
        }
        $destination = substr($v2, 0, -1);
//echo print_r($destination);exit;
        $this->holiday_model->update_holiday_package($holiday_type, $holidayname, $destination, $id);
        redirect('holiday/dsp_pk', 'refresh');
    }

    public function edit_country($id, $error = '') {
        if ($error == 1) {
            $data['error'] = 'The selected city name already exists..! Please select other city';
        }
        $data['city'] = $this->holiday_model->get_city_by_id($id);
        $data['country_list'] = $this->holiday_model->get_country_list();
        // echo '<pre>';print_r($data);exit;
        $this->load->view('holiday/edit_country', $data);
    }

    public function update_country($id) {
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $data = '';
        $data['country_list'] = $this->holiday_model->get_country_list();

        $city = $this->input->post('city');
        $country = $this->input->post('country');
		$latitude = $this->input->post('latitude');
		$longitude = $this->input->post('longitude');
      //  $check_city_avail = $this->holiday_model->check_city_avail($city);
        // echo '<pre>';print_r($check_city_avail);exit;
     //   if (!empty($check_city_avail)) {
     //       redirect('holiday/edit_country/' . $id . '/1');
    //    } else {

            $city_type = '';
            if ($country == 'India') {
                $city_type = "Domestic";
            } else {
                $city_type = "International";
            }


            $addcounty = $this->holiday_model->update_country($city, $country, $city_type, $id,$latitude,$longitude);
            redirect('holiday/addcountry', 'refresh');
     //   }
    }

    public function delete_country($id) {
        $this->holiday_model->delete_country($id);
        redirect('holiday/addcountry');
    }

    public function add_themes() {
        $data['theme_info'] = $this->holiday_model->get_theme_info();
        //echo '<pre>';print_r($data);exit;
        $this->load->view('holiday/add_themes', $data);
    }

    public function add_theme_data($id = '') {

        $theme_name = $this->input->post('theme_name');
        $theme_desc = $this->input->post('content');
		$theme_img = $this->input->post('theme_img');
        $theme_price = $this->input->post('price');
		//echo '<pre/>';print_r($_POST);exit;
		$data['theme_img'] = $this->input->post('theme_img');
		
        if ($id == '') {
            $insert_id = $this->holiday_model->insert_theme($theme_name, $theme_desc, $theme_price);
			$this->upload_theme_image($insert_id);
			
        } else {
            $this->holiday_model->insert_theme($theme_name, $theme_desc, $theme_price, $id);
			//echo $id;exit;
			$this->upload_theme_image($id);
			
        }
        redirect('holiday/add_themes');
    }
	
	public function upload_theme_image($insert_id) { //echo $insert_id;exit;
        $config['upload_path'] = './public/upload_files/theme/' . $insert_id . '/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, TRUE);
        }

        if (!$this->upload->do_upload('theme_img')) {
            $error = $this->upload->display_errors();
            $data['errors'] = $error;
			//echo $error;exit;
            $this->load->view('holiday/add_themes', $data);
        } else {
			//echo $insert_id;exit;
            $theme = $this->holiday_model->get_theme_id($insert_id);
            if (!empty($theme->theme_img)) {
                unlink($theme->theme_img);
            }

            $upload_data = $this->upload->data();
			//print_r($upload_data);
            $file_name = $upload_data["file_name"];
			//echo $file_name;exit;
            $source_image = '/public/upload_files/theme/' . $insert_id . '/' . $file_name;

            $this->holiday_model->update_theme_img($insert_id, $source_image);
        }
    }

    public function edit_theme($id) {
        $data['get_theme'] = $this->holiday_model->get_theme_info_by_id($id);
        //echo '<pre>';print_r($data);exit;
        $this->load->view('holiday/edit_themes', $data);
    }

    public function delete_theme($id) {
        $this->holiday_model->delete_theme($id);
        redirect('holiday/add_themes');
    }
	public function expiry_report(){
	$data['holiday_exp']=$this->holiday_model->get_expiry_report();
	$this->load->view('holiday/expiry_report',$data);
	}
	public function gallaery_theme(){
	//$data['result']='';
	$data['get_gallery']=$this->holiday_model->get_gallery_themes();
	$this->load->view('holiday/gallery_theme',$data);
	}
	
	public function add_gallery_theme($id){
	$package_name = $this->input->post('package_name');
	$package_desc = $this->input->post('package_desc');
	
	$package_price = $this->input->post('package_price');
	$package_link = $this->input->post('package_link');
	$this->holiday_model->add_gallery_theme($package_name,$package_price,$package_link,$package_desc);
	//print_r($data['holiday_exp']);exit;
	redirect('holiday/gallaery_theme','refresh');
	}
	
	public function edit_gallery_theme($id){
	//echo '1';
	$data['holiday_exp']=$this->holiday_model->edit_gallery_theme($id);
	//print_r($data['holiday_exp']);exit;
		$this->load->view('holiday/edit_gallery_theme',$data);
	}
	
	public function update_package_themes($id){
	//echo '<pre>';print_r($_POST);exit;
	$package_name = $this->input->post('package_name');
	$package_desc = $this->input->post('package_desc');
	$package_price = $this->input->post('package_price');
	$package_link = $this->input->post('package_link');
	
	$this->holiday_model->update_gallery_themes($id,$package_name,$package_price,$package_link,$package_desc);
	//echo $this->db->last_query();exit;
	redirect('holiday/gallaery_theme','refresh');
	}
	public function delete_gallery_theme($id){
	
	$this->holiday_model->delete_gallery_theme($id);
	redirect('holiday/gallaery_theme','refresh');
	}
    public function itinerary($id)
    {
    $data['holiday_list']=$this->holiday_model->get_holiday_list_by_id($id);
    $data['hol_id']=$id;
    $data['hol_itinerary']=$this->holiday_model->get_itinerary($id);
    $this->load->view('holiday/itinerary',$data);  
    }
     public function add_itinerary()
    {

      $holiday_id = $this->input->post('hol_id');
      $holiday_list=$this->holiday_model->get_holiday_list_by_id($holiday_id);
      // echo $holiday_list->duration; exit;
      $this->holiday_model->del_itinerary($holiday_id);
      $day_no = $this->input->post('day_no');     
      $itinerary = $this->input->post('itinerary'); 
      $itineraryhotel = $this->input->post('itineraryhotel');
      $itinerarydate = $this->input->post('itinerarydate');
      $itineraryroom = $this->input->post('itineraryroomname');
      $itineraryrate = $this->input->post('itineraryrate');
      $itinerarystar = $this->input->post('itinerarystar');
      //$itineraryimage = $this->input->post('itineraryimage');

      $itineraryinclusion = $this->input->post('itineraryinclusion');
      $itineraryexclusion = $this->input->post('itineraryexclusion');
      $itinerarycab = $this->input->post('itinerarycab');
      $itinerarypickup = $this->input->post('itinerarypickup');
      $itinerarydropoff_name = $this->input->post('itinerarydropoff_name');
      $itineraryseats = $this->input->post('itineraryseats');
     // $itinerarycab_thumb_image = $this->input->post('itinerarycab_thumb_image');
      $itinerarytinclusion = $this->input->post('itinerarytinclusion');
      $itinerarycab_exclusion = $this->input->post('itinerarycab_exclusion');

       if(!empty($day_no)) {
       for($i=0;$i<=($holiday_list->duration);$i++)
       {
        $data = array(
            'itinerary_id' => '',
            'holiday_id' => $holiday_id,
            'day_no' => $day_no[$i],
            'itinerary' =>$itinerary[$i],
            'itineraryhotel' =>$itineraryhotel[$i],
            'itinerarydate' =>$itinerarydate[$i],
            'itineraryroom' =>$itinerarydate[$i],
            'itineraryrate' =>$itineraryrate[$i],
            'itinerarystar' =>$itinerarystar[$i],
            //'itineraryimage' =>$itineraryimage[$i],
             'itineraryinclusion' =>$itineraryinclusion[$i],
             'itineraryexclusion' =>$itineraryexclusion[$i],
             'itinerarycab' =>$itinerarycab[$i],
             'itinerarypick' =>$itinerarypickup[$i],
             'itinerarydrop' =>$itinerarydropoff_name[$i],             
             'itineraryseats' =>$itineraryseats[$i],
             //'itinerarycab_image' =>$itinerarycab_thumb_image[$i],
             'itinerarytinclusion' =>$itinerarytinclusion[$i],
             'itinerarycab_exclusion' =>$itinerarycab_exclusion[$i],
             'itineraryheader' =>$this->input->post('itineraryheader_'.($i+1))
        );
          $this->holiday_model->insert_itinerary($data);
          $id = $this->db->insert_id();
          //print_r($id); echo "tsig";exit;
          $this->upload_hotel_images($id);
          $this->upload_cab_images($id);
          //echo $this->db->last_query();exit;
       }
    }
        redirect('holiday/packagelist','refresh');
    }


    public function upload_hotel_images($id) {


     if(!empty($_FILES['itineraryimage'])){


     $data = [];

      $count = count($_FILES['itineraryimage']['name']);
 
      for($i=0;$i<$count;$i++){
 
        if(!empty($_FILES['itineraryimage']['name'])){

          $_FILES['file']['name'] = $_FILES['itineraryimage']['name'][$i];
          $_FILES['file']['type'] = $_FILES['itineraryimage']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['itineraryimage']['tmp_name'][$i];
          $_FILES['file']['error'] = $_FILES['itineraryimage']['error'][$i];
          $_FILES['file']['size'] = $_FILES['itineraryimage']['size'][$i];

          $config['upload_path'] = './holidayitinerary/' . $id . '/thumbnail/'; 
         
          $config['allowed_types'] = 'jpg|jpeg|png|gif';
         //$config['max_size'] = '5000'; // max_size in kb
          $config['file_name'] = $_FILES['itineraryimage']['name'][$i];

            if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
            }
             $this->upload->initialize($config); 
            $this->load->library('upload',$config); 
 
          if($this->upload->do_upload('file')){
            $uploadData = $this->upload->data();
            $filename = $uploadData['file_name'];

            $data['totalFiles'][] = $filename;
            $imagepath = 'holidayitinerary/' . $id . '/thumbnail/' . $_FILES['itineraryimage']['name'][$i];
          

            $this->holiday_model->upload_images_itinerary($id, $imagepath, 1); 
            
          }
        }
 
     }

      
   }   
      
     
  }


     public function upload_cab_images($id) {


     if(!empty($_FILES['itinerarycab_thumb_image'])){


     $data = [];

      $count = count($_FILES['itinerarycab_thumb_image']['name']);
 
      for($i=0;$i<$count;$i++){
 
        if(!empty($_FILES['itinerarycab_thumb_image']['name'])){

          $_FILES['file']['name'] = $_FILES['itinerarycab_thumb_image']['name'][$i];
          $_FILES['file']['type'] = $_FILES['itinerarycab_thumb_image']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['itinerarycab_thumb_image']['tmp_name'][$i];
          $_FILES['file']['error'] = $_FILES['itinerarycab_thumb_image']['error'][$i];
          $_FILES['file']['size'] = $_FILES['itinerarycab_thumb_image']['size'][$i];

          $config['upload_path'] = './cab_image/' . $id . '/thumbnail/'; 
         
          $config['allowed_types'] = 'jpg|jpeg|png|gif';
         //$config['max_size'] = '5000'; // max_size in kb
          $config['file_name'] = $_FILES['itinerarycab_thumb_image']['name'][$i];

            if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
            }
             $this->upload->initialize($config); 
            $this->load->library('upload',$config); 
 
          if($this->upload->do_upload('file')){
            $uploadData = $this->upload->data();
            $filename = $uploadData['file_name'];

            $data['totalFiles'][] = $filename;
            $imagepath = 'cab_image/' . $id . '/thumbnail/' . $_FILES['itinerarycab_thumb_image']['name'][$i];
          

            $this->holiday_model->upload_images_cabitinerary($id, $imagepath, 1); 
            
          }
        }
 
     }

      
   }   
      
     
  }

    public function holiday_booking_report()
    {
        if ($this->admin_auth->is_admin()) {
             $data['assignto']=$assignto=isset($_GET['assignto']) ? $_GET['assignto'] : '';        
       }
       else
       {
          $assignto = $this->session->userdata('admin_id');
       }
        $data['package_title']=$package_title=isset($_GET['package_title']) ? $_GET['package_title'] : '';
        $data['package_code']=$package_code=isset($_GET['package_code']) ? $_GET['package_code'] : '';

         $data['promo_code']=$promo_code=isset($_GET['promo_code']) ? $_GET['promo_code'] : '';

        $data['user_email']=$user_email=isset($_GET['user_email']) ? $_GET['user_email'] : '';
        $data['booking_status']=$booking_status=isset($_GET['booking_status']) ? $_GET['booking_status'] : '';
        $data['first_name']=$first_name=isset($_GET['first_name']) ? $_GET['first_name'] : '';
        $data['last_name']=$last_name=isset($_GET['last_name']) ? $_GET['last_name'] : '';
        $data['uniqueRefNo']=$uniqueRefNo=isset($_GET['uniqueRefNo']) ? $_GET['uniqueRefNo'] : '';
       $data['user_mobile']=$user_mobile=isset($_GET['user_mobile']) ? $_GET['user_mobile'] : '';
       $data['from_date']=$from_date=isset($_GET['from_date']) ? $_GET['from_date'] : '';
        $data['to_date']=$to_date=isset($_GET['to_date']) ? $_GET['to_date'] : '';
        $data['holi_booking_report']=$this->holiday_model->holi_booking_report_details($first_name,$last_name,$uniqueRefNo,$user_mobile,$from_date,$to_date,$package_title,$user_email,$booking_status,$package_code,$assignto,$promo_code);
        $data['subadmin']=$this->holiday_model->get_subadmin();     
         $this->load->view('holiday/holiday_booking_report', $data);
    }
     public function holiday_pre_booking_report()
    {
        $data['package_title']=$package_title=isset($_GET['package_title']) ? $_GET['package_title'] : '';
        $data['package_code']=$package_code=isset($_GET['package_code']) ? $_GET['package_code'] : '';
        $data['user_email']=$user_email=isset($_GET['user_email']) ? $_GET['user_email'] : '';
        $data['booking_status']=$booking_status=isset($_GET['booking_status']) ? $_GET['booking_status'] : '';
        $data['first_name']=$first_name=isset($_GET['first_name']) ? $_GET['first_name'] : '';
        $data['last_name']=$last_name=isset($_GET['last_name']) ? $_GET['last_name'] : '';
        $data['uniqueRefNo']=$uniqueRefNo=isset($_GET['uniqueRefNo']) ? $_GET['uniqueRefNo'] : '';
        $data['user_mobile']=$user_mobile=isset($_GET['user_mobile']) ? $_GET['user_mobile'] : '';
        $data['from_date']=$from_date=isset($_GET['from_date']) ? $_GET['from_date'] : '';
        $data['to_date']=$to_date=isset($_GET['to_date']) ? $_GET['to_date'] : '';
        $data['holi_pre_booking_report']=$this->holiday_model->holi_pre_booking_report_details($first_name,$last_name,$uniqueRefNo,$user_mobile,$from_date,$to_date,$package_title,$user_email,$booking_status,$package_code); 
        $data['holiday_pre_enquiry'] = $this->holiday_model->get_holiday_pre_enquiry();      
        $this->load->view('holiday/holiday_pre_booking_report', $data);
    }
    public function holiday_enquiry() 
    {
       $data['holiday_enquiry']=$this->holiday_model->holiday_enquiry_report();
    $data['holiday_mice_enquiry']=$this->holiday_model->holiday_mice_enquiry_report();
        $data['holiday_subcribe']=$this->holiday_model->holiday_subscriber();
       $this->load->view('holiday/holiday_enquiry', $data);
    }
    public function holiday_rates($id){
    $data['holiday_id']=$id;
    $data['hol_info']=$this->holiday_model->get_prev($id);
    $data['result']=$this->holiday_model->get_holiday_rates($id);  
    $this->load->view('holiday/holiday_rates',$data);
}
public function edit_pax_package_type(){    
            $holiday_id=$this->input->post('holiday_id');
            $comfort_single=$this->input->post('comfort_single');
            $comfort_twin=$this->input->post('comfort_twin');
            $comfort_triple=$this->input->post('comfort_triple');
            $comfort_infant=$this->input->post('comfort_infant');
            $comfort_cwb=$this->input->post('comfort_cwb');
            $comfort_cwithoutbed=$this->input->post('comfort_cwithoutbed');
            $quality_single=$this->input->post('quality_single');
            $quality_twin=$this->input->post('quality_twin');
            $quality_triple=$this->input->post('quality_triple');
            $quality_infant=$this->input->post('quality_infant');
            $quality_cwb=$this->input->post('quality_cwb');
            $quality_cwithoutbed=$this->input->post('quality_cwithoutbed');
            $luxury_single=$this->input->post('luxury_single');
            $luxury_twin=$this->input->post('luxury_twin');
            $luxury_triple=$this->input->post('luxury_triple');
            $luxury_infant=$this->input->post('luxury_infant');
            $luxury_cwb=$this->input->post('luxury_cwb');
            $luxury_cwithoutbed=$this->input->post('luxury_cwithoutbed');  
         if(empty($comfort_single)&&empty($comfort_twin)&&empty($comfort_triple)&&empty($comfort_infant)&&empty($comfort_cwb)&&empty($comfort_cwithoutbed)&&empty($quality_single)&&empty($quality_twin)&&empty($quality_triple)&&empty($quality_infant)&&empty($quality_cwb)&&empty($quality_cwithoutbed)&&empty($luxury_single)&&empty($luxury_twin)&&empty($luxury_triple)&&empty($luxury_infant)&&empty($luxury_cwb)&&empty($luxury_cwithoutbed))
       {
        redirect('holiday/packagelist','refresh');
       }      
            $data=array(
                    'comfort_single'=>$comfort_single,
                    'comfort_twin'=>$comfort_twin,
                    'comfort_triple'=>$comfort_triple,
                    'comfort_infant'=>$comfort_infant,
                    'comfort_cwb'=>$comfort_cwb,
                    'comfort_cwithoutbed'=>$comfort_cwithoutbed,
                    'quality_single'=>$quality_single,
                    'quality_twin'=>$quality_twin,
                    'quality_triple'=>$quality_triple,
                    'quality_infant'=>$quality_infant,
                    'quality_cwb'=>$quality_cwb,
                    'quality_cwithoutbed'=>$quality_cwithoutbed,
                    'luxury_single'=>$luxury_single,
                    'luxury_twin'=>$luxury_twin,
                    'luxury_triple'=>$luxury_triple,
                    'luxury_infant'=>$luxury_infant,
                    'luxury_cwb'=>$luxury_cwb,
                    'luxury_cwithoutbed'=>$luxury_cwithoutbed,
                    );
$this->holiday_model->update_rates($data,$holiday_id);
$this->session->set_flashdata('edit_curr_values', 'Package rate has been Updated successfully');
redirect('holiday/packagelist','refresh');
}
public function add_pax_package_type(){
            // echo '<pre>'; print_r($_POST);exit;
            
            $holiday_id=$this->input->post('holiday_id');
            $comfort_single=$this->input->post('comfort_single');
            $comfort_twin=$this->input->post('comfort_twin');
            $comfort_triple=$this->input->post('comfort_triple');            
            $comfort_infant=$this->input->post('comfort_infant');
            $comfort_cwb=$this->input->post('comfort_cwb');
            $comfort_cwithoutbed=$this->input->post('comfort_cwithoutbed');
            $quality_single=$this->input->post('quality_single');
            $quality_twin=$this->input->post('quality_twin');
            $quality_triple=$this->input->post('quality_triple');            
            $quality_infant=$this->input->post('quality_infant');
            $quality_cwb=$this->input->post('quality_cwb');
            $quality_cwithoutbed=$this->input->post('quality_cwithoutbed');
            $luxury_single=$this->input->post('luxury_single');
            $luxury_twin=$this->input->post('luxury_twin');
            $luxury_triple=$this->input->post('luxury_triple');
            $luxury_infant=$this->input->post('luxury_infant');
            $luxury_cwb=$this->input->post('luxury_cwb');
            $luxury_cwithoutbed=$this->input->post('luxury_cwithoutbed');          
       if(empty($comfort_single)&&empty($comfort_twin)&&empty($comfort_triple)&&empty($comfort_infant)&&empty($comfort_cwb)&&empty($comfort_cwithoutbed)&&empty($quality_single)&&empty($quality_twin)&&empty($quality_triple)&&empty($quality_infant)&&empty($quality_cwb)&&empty($quality_cwithoutbed)&&empty($luxury_single)&&empty($luxury_twin)&&empty($luxury_triple)&&empty($luxury_infant)&&empty($luxury_cwb)&&empty($luxury_cwithoutbed))
       {
        redirect('holiday/packagelist','refresh');
       }
                    $data=array(
                    'holiday_id'=>$holiday_id,
                    'comfort_single'=>$comfort_single,
                    'comfort_twin'=>$comfort_twin,
                    'comfort_triple'=>$comfort_triple,
                    'comfort_infant'=>$comfort_infant,
                    'comfort_cwb'=>$comfort_cwb,
                    'comfort_cwithoutbed'=>$comfort_cwithoutbed,
                    'quality_single'=>$quality_single,
                    'quality_twin'=>$quality_twin,
                    'quality_triple'=>$quality_triple,
                    'quality_infant'=>$quality_infant,
                    'quality_cwb'=>$quality_cwb,
                    'quality_cwithoutbed'=>$quality_cwithoutbed,
                    'luxury_single'=>$luxury_single,
                    'luxury_twin'=>$luxury_twin,
                    'luxury_triple'=>$luxury_triple,
                    'luxury_infant'=>$luxury_infant,
                    'luxury_cwb'=>$luxury_cwb,
                    'luxury_cwithoutbed'=>$luxury_cwithoutbed,
                    );
$this->holiday_model->insert_rates($data);

$this->session->set_flashdata('insert_curr_values', 'Package rate has been added successfully');            
redirect('holiday/packagelist','refresh');
}

 public function holiday_review($id){
   if(empty($id))
   redirect('holiday/packagelist','refresh');   
    $data['holiday_id']=$id;
    $data['hol_info']=$this->holiday_model->get_prev($id);
    $data['review_list']=$this->holiday_model->get_review_list('',$id);
    $this->load->view('holiday/holiday_review',$data);
}
public function set_status_review_active($id,$isactive)
{
   $data['review_list']=$this->holiday_model->get_review_list($id,'');
  $this->holiday_model->set_active_status_holiday_review($id,$isactive);
 redirect('holiday/holiday_review/'. $data['review_list'][0]->holiday_id,'refresh');   
}
public function add_holiday_review(){
    $res=array(
        'review_id'=>'',
        'holiday_id'=> $this->input->post('holiday_id'),
        'user_name'=> $this->input->post('user_name'),
        'review_title'=> $this->input->post('review_title'),
        'review_desc'=> $this->input->post('review_desc'),
        'location'=> $this->input->post('location'),
        'isActive'=>0
    ); 
    $this->holiday_model->insert_review_list($res);
    $data['holiday_id']=$this->input->post('holiday_id');
    $data['review_list']=$this->holiday_model->get_review_list('',$this->input->post('holiday_id'));
  redirect('holiday/holiday_review/'.$this->input->post('holiday_id'),'refresh');   
}
public function edit_review($id){
     if(empty($id))
   redirect('holiday/packagelist','refresh');   
    $data['review_list']=$this->holiday_model->get_review_list($id,'');
     $data['hol_info']=$this->holiday_model->get_prev($data['review_list'][0]->holiday_id);
     $this->load->view('holiday/edit_holiday_review',$data);
}
public function update_review($id)
{
    // print_r($_POST); exit;
   $res=array(
        'user_name'=> $this->input->post('user_name'),
        'review_title'=> $this->input->post('review_title'),
        'review_desc'=> $this->input->post('review_desc'),
        'location'=> $this->input->post('location'),
    ); 
    $this->holiday_model->update_review_list($id,$res);  
  redirect('holiday/holiday_review/'.$this->input->post('holiday_id'),'refresh');     
}

 public function hot_offer() {
    //print_r($_POST['message']);exit;
        $rec = $_POST['message'];
         $rec1 = $_POST['message1'];
        foreach ($rec as $recom) {
            $rec_act = $this->holiday_model->update_hotoffer($recom,'1');
        }
        foreach ($rec1 as $recom) {
            $rec_act = $this->holiday_model->update_hotoffer($recom,'0');
        }
    }

public function change_package_status() {
    //print_r($_POST['message']);exit;
        $rec = $_POST['message'];
         $rec1 = $_POST['message1'];
        foreach ($rec as $recom) {           
            $rec_act = $this->holiday_model->package_active($recom,'1');
        }
        foreach ($rec1 as $recom) {
            $rec_act = $this->holiday_model->package_active($recom,'0');
        }
    }

        public function trending_dest() {
        $rec = $_POST['message'];
        $rec1 = $_POST['message1'];
        foreach ($rec as $recom) {
            $rec_act = $this->holiday_model->update_trending_dest($recom,'1');
        }
            foreach ($rec1 as $recom) {
            $rec_act = $this->holiday_model->update_trending_dest($recom,'0');
        }
    }
    
    public function offbeat_place() {
        $rec = $_POST['message'];
        $rec1 = $_POST['message1'];
        foreach ($rec as $recom) {
            $rec_act = $this->holiday_model->update_offbeat_place($recom,'1');
        }
            foreach ($rec1 as $recom) {
            $rec_act = $this->holiday_model->update_offbeat_place($recom,'0');
        }
    }

     public function deals() {
        $rec = $_POST['message'];
        $rec1 = $_POST['message1'];
        foreach ($rec as $recom) {
            $rec_act = $this->holiday_model->update_deals($recom,'1');
        }
            foreach ($rec1 as $recom) {
            $rec_act = $this->holiday_model->update_deals($recom,'0');
        }
    }
     public function inspiration_place() {
        $rec = $_POST['message'];
        $rec1 = $_POST['message1'];
        foreach ($rec as $recom) {
            $rec_act = $this->holiday_model->update_inspiration_place($recom,'1');
        }
            foreach ($rec1 as $recom) {
            $rec_act = $this->holiday_model->update_inspiration_place($recom,'0');
        }
    }
    function holidaylist() {
         // echo '<pre>';print_r($_POST);exit; 
        $bookable = $this->input->post('bookable');
        $package_title = $this->input->post('package_title');
        $package_code = $this->input->post('package_code');
        $taggingservices = implode(',', $this->input->post('taggingservices'));
        $desti = $this->input->post('desti');
        $destination = implode(",", $desti);        
        $continentid=array();
        $countryid=array();
        $stateid=array();
        $i=$j=$k=0;
        foreach($desti as $destcityid)
        {
        $continentid[$i++]=$this->holiday_model->getcontinentId($destcityid)->continent_id;
        $countryid[$j++]=$this->holiday_model->getcountryId($destcityid)->country_id;
        $stateid[$k++]=$this->holiday_model->getstateId($destcityid)->state_id;
        }
        $continentStr=implode(",",array_unique($continentid));
        $countryStr=implode(",",array_unique($countryid));
        $stateStr=implode(",",array_unique($stateid)); 
        $package_popularity = $this->input->post('package_popularity');
        $package_rating = $this->input->post('package_rating');
        $theme = $this->input->post('holiday_theme');
        $hol_theme = implode(",", $theme);
        $category = $this->input->post('category');
        $categoryarray = implode(",", $category);
        $duration = $this->input->post('duration');
        $month = $this->input->post('month');
        $montharray = implode(",", $month);
        $start_date = date("Y-m-d", strtotime($_POST['checkIn']));
        $end_date = date("Y-m-d", strtotime($_POST['checkOut'])); 
        $package_desc=addslashes($this->input->post('package_desc'));
        $package_good=addslashes($this->input->post('package_good'));
        $comfort=addslashes($this->input->post('comfort'));
        $quality=addslashes($this->input->post('quality'));
        $luxury=addslashes($this->input->post('luxury'));
        $highlight=addslashes($this->input->post('highlight'));
        $inclusion = addslashes($this->input->post('inclusion'));
        $exclusion = addslashes($this->input->post('exclusion'));
        $price = $this->input->post('price_ad');
        $terms = $this->input->post('terms'); 
        $insertdata=array(
                        'holiday_id'=>'', 
                        'bookable'=>$bookable,
                        'package_title'=>$package_title,
                        'package_code'=>$package_code,
                        'taggingservices'=>$taggingservices,
                        'package_popularity'=>$package_popularity,
                        'package_rating'=>$package_rating,
                        'theme_id'=>$hol_theme,
                        'category'=>$categoryarray,
                        'destination'=>$destination,
                        'continent'=>$continentStr,
                        'country'=>$countryStr,
                        'state'=>$stateStr,
                        'duration'=>$duration,
                        'month_dur'=>$montharray,
                        'start_date'=>$start_date,
                        'end_date'=>$end_date,
                        'package_desc'=>$package_desc,
                        'package_good'=>$package_good,
                        'comfort'=>$comfort,
                        'quality'=>$quality,
                        'luxury'=>$luxury,
                        'highlights'=>$highlight,
                        'inclusion'=>$inclusion,
                        'exclusion'=>$exclusion,
                        'price'=>$price,
                        'terms'=>$terms,
                        'status'=>1);
                    $id=$this->holiday_model->insert_holiday_list($insertdata);
                    $this->upload_images($id);
                    redirect('holiday/packagelist', 'refresh');
            }

     function editholidaylist() {
         // echo '<pre>';print_r($_POST);exit;
        $bookable = $this->input->post('bookable');
        $package_title = $this->input->post('package_title');
        $package_code = $this->input->post('package_code');
        $taggingservices = implode(',', $this->input->post('taggingservices'));     
        $id=$this->input->post('holiday_id');
        $desti = $this->input->post('desti');
        $destination = implode(",", $desti);        
        $continentid=array();
        $countryid=array();
        $stateid=array();
        $i=$j=$k=0;
        foreach($desti as $destcityid)
        {
        $continentid[$i++]=$this->holiday_model->getcontinentId($destcityid)->continent_id;
        $countryid[$j++]=$this->holiday_model->getcountryId($destcityid)->country_id;
        $stateid[$k++]=$this->holiday_model->getstateId($destcityid)->state_id;
        }
        $continentStr=implode(",",array_unique($continentid));
        $countryStr=implode(",",array_unique($countryid));
        $stateStr=implode(",",array_unique($stateid)); 
        $package_popularity = $this->input->post('package_popularity');
        $package_rating = $this->input->post('package_rating');
        $theme = $this->input->post('holiday_theme');
        $hol_theme = implode(",", $theme);
        $category = $this->input->post('category');
        $categoryarray = implode(",", $category);
        $duration = $this->input->post('duration');
        $month = $this->input->post('month');
        $montharray = implode(",", $month);
        $start_date = date("Y-m-d", strtotime($_POST['checkIn']));
        $end_date = date("Y-m-d", strtotime($_POST['checkOut'])); 
        $package_desc=addslashes($this->input->post('package_desc'));    
        $package_good=addslashes($this->input->post('package_good'));
        $comfort=addslashes($this->input->post('comfort'));
        $quality=addslashes($this->input->post('quality'));
        $luxury=addslashes($this->input->post('luxury'));
        $highlight=addslashes($this->input->post('highlight'));
        $inclusion = addslashes($this->input->post('inclusion'));
        $exclusion = addslashes($this->input->post('exclusion'));
        $price = $this->input->post('price_ad');
        $terms = $this->input->post('terms'); 
        $insertdata=array(
                        'bookable'=>$bookable,
                        'package_title'=>stripslashes($package_title),
                        'package_code'=>$package_code,
                        'taggingservices'=>$taggingservices,                         
                        'package_popularity'=>$package_popularity,
                        'package_rating'=>$package_rating,
                        'theme_id'=>$hol_theme,
                        'category'=>$categoryarray,
                        'destination'=>$destination,
                        'continent'=>$continentStr,
                        'country'=>$countryStr,
                        'state'=>$stateStr,
                        'duration'=>$duration,
                        'month_dur'=>$montharray,
                        'start_date'=>$start_date,
                        'end_date'=>$end_date,
                        'package_desc'=>stripslashes($package_desc),
                        'package_good'=>stripslashes($package_good),
                        'comfort'=>stripslashes($comfort),
                        'quality'=>stripslashes($quality),
                        'luxury'=>stripslashes($luxury),
                        'highlights'=>stripslashes($highlight),
                        'inclusion'=>stripslashes($inclusion),
                        'exclusion'=>stripslashes($exclusion),
                        'price'=>$price,
                        'terms'=>stripslashes($terms));
                    $this->holiday_model->updateholidaylist($id,$insertdata);
                    $this->upload_images($id);
                    redirect('holiday/packagelist', 'refresh');
            }
public function delete_image() {
            // print_r($id);exit;
            $id=$_POST['del_id'];
            if (!empty($id)) {
            $path='';
            $res=$this->holiday_model->select_image($id);
            // print_r($res);exit;
            $this->load->helper("url");
            $path.='./'.$res[0]->holiday_images;
            // echo $path; exit;
            unlink($path);
            $this->holiday_model->delete_image($id);
        }
        die();
      
    }
    public function voucher()
    {
    $uniqueRefNo=$_GET['referId'];
    $data['holiday_booking_info'] =$this->holiday_model->get_holiday_booking($uniqueRefNo);
    $data['passenger_info'] =$this->holiday_model->get_holiday_pass_info($uniqueRefNo);
    $data['pay_info'] =$this->holiday_model->get_holiday_pay_info($uniqueRefNo);
    $data['holidaydetails'] = $this->holiday_model->get_holiday($data['holiday_booking_info']->holiday_id);
    $this->load->view('holiday/voucher',$data);  
    }

    public function add_inspiration()
    {
      $id=$this->input->post('continent');     
    $inspiration_header_text=$this->input->post('inspiration_header_text');
      $inspiration_text=$this->input->post('inspiration_text');
      $promotional_name=$this->input->post('promotional_name');
      // print_r($_POST); exit;
      $this->holiday_model->update_inspiration_text($id,$inspiration_header_text,$inspiration_text,$promotional_name);
       $this->upload__ins_images($id);
       redirect('holidaypackage/continent', 'refresh');
    }

   public function upload__ins_images($id) {

        //Image Size  
        $image_size = $this->config->item('image_sizes');
        
         //Upload Configuration Image
        $config['upload_path'] = './holidayimages/inspiration/' . $id . '/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        // $config['max_size'] =  $this->max_image_size;
        // $config['max_width'] =  $this->max_image_width;
        // $config['max_height'] = $this->max_image_height;      
        // $config['resize'] = true;
        $config['rename'] = true;
        $config['image_sizes'] = $image_size;
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, TRUE);
        }
        $this->load->library("Multifile_Upload", $config);
        $this->Multifile_Upload = new Multifile_Upload;
        $this->Multifile_Upload->initialize($config);
        $this->Multifile_Upload->set_allowed_types('gif|jpg|png|jpeg');
        $this->Multifile_Upload->do_upload('inspiration_image');

        //Insert Image Path into table
        foreach ($this->Multifile_Upload->saved_filename as $imgfile) {
            $imagepath = 'holidayimages/inspiration/' . $id . '/' . $imgfile;

            $this->holiday_model->upload_inspiration_images($id, $imagepath);
        }
    }
    public function bannner()
    {
        $data['banner']=$this->holiday_model->get_banner_images();
         $data['country_list'] = $this->holidaypackage_model->get_holi_country_list();
         $this->load->view('holiday/homebanner',$data);
    }

    public function add_banner()
    {   
        if(isset($_POST['bannerurl']))
        {       
            $id= $this->holiday_model->insert_banner($_POST['bannerurl']);
            $this->upload_banner($id,'');
        }
       redirect('holiday/bannner', 'refresh');  
    }
    public function upload_banner($id,$bannerpath='')
    {
         //Image Size  
        $image_size = $this->config->item('image_sizes');
        
         //Upload Configuration Image
        $config['upload_path'] = './holidayimages/homebanner/' . $id . '/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        // $config['max_size'] =  $this->max_image_size;
        // $config['max_width'] =  $this->max_image_width;
        // $config['max_height'] = $this->max_image_height;      
        // $config['resize'] = true;
        $config['rename'] = true;
        $config['image_sizes'] = $image_size;
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, TRUE);
        }
        $this->load->library("Multifile_Upload", $config);
        $this->Multifile_Upload = new Multifile_Upload;
        $this->Multifile_Upload->initialize($config);
        $this->Multifile_Upload->set_allowed_types('gif|jpg|png|jpeg');
        $this->Multifile_Upload->do_upload('banner_image');

        //Insert Image Path into table
        foreach ($this->Multifile_Upload->saved_filename as $imgfile) {
            $imagepath = 'holidayimages/homebanner/' . $id . '/' . $imgfile;
            if($bannerpath!='')
            {
                  $this->load->helper("url");
                  unlink($bannerpath);   
            }

            $this->holiday_model->upload_banner_images($id, $imagepath);
        }
    }

     public function edit_banner($id='') {
        if (empty($id)) {
          redirect('holiday/bannner', 'refresh');  
        }
        $data['country_list'] = $this->holidaypackage_model->get_holi_country_list();        
        $data['banner']=$this->holiday_model->get_banner_images($id);
        $this->load->view('holiday/edithomebanner',$data);
    }

     public function update_banner($id='') {
      if (empty($id)) {
          redirect('holiday/bannner', 'refresh');  
        } 
         $data['banner']=$this->holiday_model->get_banner_images($id);
         $path=''; 
         if(isset($_POST['bannerurl'])) 
         {
             $dataarr=array('bannerurl'=>$_POST['bannerurl']);
             $this->holiday_model->update_banner_country($dataarr,$id);
         }                
               
       $this->upload_banner($id,$path);
       redirect('holiday/bannner', 'refresh'); 
    }
    public function set_banner_status($id,$active)
    {
       $this->holiday_model->set_active_status_home_banner($id,$active);
      redirect('holiday/bannner', 'refresh'); 
    }

    /* Holiday theme 01/02/2017 */

     public function upload_package_theme_image($id) {

        //Image Size    
        $image_size = $this->config->item('image_sizes');

             //Upload home_category_image 
        $config['upload_path'] = './holidayimages/category/homepage/' . $id . '/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        // $config['max_size'] =  $this->max_image_size;
        // $config['max_width'] =  $this->max_image_width;
        // $config['max_height'] = $this->max_image_height;      
        // $config['resize'] = true;
        $config['rename'] = true;
        $config['image_sizes'] = $image_size;
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, TRUE);
        }
        $this->load->library("Multifile_Upload", $config);
        $this->Multifile_Upload = new Multifile_Upload;
        $this->Multifile_Upload->initialize($config);
        $this->Multifile_Upload->set_allowed_types('gif|jpg|png|jpeg');
        $this->Multifile_Upload->do_upload('home_category_image');

        //Insert Image Path into table
        foreach ($this->Multifile_Upload->saved_filename as $imgfile) {
            $imagepath = 'holidayimages/category/homepage/' . $id . '/' . $imgfile;

            $this->holiday_model->upload_package_home_category_theme_images($id, $imagepath);
        }

        //Upload category_image
        $config['upload_path'] = './holidayimages/category/categorypage/' . $id . '/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        // $config['max_size'] =  $this->max_image_size;
        // $config['max_width'] =  $this->max_image_width;
        // $config['max_height'] = $this->max_image_height;      
        // $config['resize'] = true;
        $config['rename'] = true;
        $config['image_sizes'] = $image_size;
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, TRUE);
        }
        $this->load->library("Multifile_Upload", $config);
        $this->Multifile_Upload = new Multifile_Upload;
        $this->Multifile_Upload->initialize($config);
        $this->Multifile_Upload->set_allowed_types('gif|jpg|png|jpeg');
        $this->Multifile_Upload->do_upload('category_image');

        //Insert Image Path into table
        foreach ($this->Multifile_Upload->saved_filename as $imgfile) {
            $imagepath = 'holidayimages/category/categorypage/' . $id . '/' . $imgfile;

    $this->holiday_model->upload_package_category_theme_images($id, $imagepath);
        }

    
    }
    public function add_new_theme()
    {
         $data = array(
            'theme_id'=>'',
            'theme_name' =>$this->input->post('theme_name'),           
        );
        $id= $this->holiday_model->insert_new_package_theme($data);
       $this->upload_package_theme_image($id);
       redirect('holiday/holidaypackagethemelist', 'refresh');   
    }

    public function holidaypackagethemelist()
    {
      $data['theme']=$this->holiday_model->get_theme_list();
       $this->load->view('holiday/packagethemelist',$data);
    }

    public function edit_package_theme($id='')
    {
         if (empty($id)) {
          redirect('holiday/holidaypackagethemelist', 'refresh');  
        }
        $data['theme']=$this->holiday_model->get_theme_list($id);
        $this->load->view('holiday/editpackagetheme',$data);
    }

     public function update_holiday_package_themes($id='') {
      if (empty($id)) {
          redirect('holiday/bannner', 'refresh');  
        } 
        //  $data['theme']=$this->holiday_model->get_banner_images($id);
        //  $path='';        
        // $this->load->helper("url");
        // $path.='./'.$data['theme'][0]->home_category_image;       
        //  unlink($path);
        //    $path='';        
        // $this->load->helper("url");
        // $path.='./'.$data['theme'][0]->category_image;       
        //  unlink($path);
        $theme_name=$this->input->post('theme_name');
        $this->holiday_model->update_holiday_package_theme($id,$theme_name);
        $this->upload_package_theme_image($id);
       redirect('holiday/holidaypackagethemelist', 'refresh'); 
    }
     public function set_theme_status($id,$active)
    {
       $this->holiday_model->set_package_theme_status($id,$active);
      redirect('holiday/holidaypackagethemelist', 'refresh'); 
    }

     public function upload__ins_country_images($id,$countryid) {

        //Image Size  
        $image_size = $this->config->item('image_sizes');
        
         //Upload Configuration Image
        $config['upload_path'] = './holidayimages/inspiration/' . $id . '/'. $countryid . '/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        // $config['max_size'] =  $this->max_image_size;
        // $config['max_width'] =  $this->max_image_width;
        // $config['max_height'] = $this->max_image_height;      
        // $config['resize'] = true;
        $config['rename'] = true;
        $config['image_sizes'] = $image_size;
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, TRUE);
        }
        $this->load->library("Multifile_Upload", $config);
        $this->Multifile_Upload = new Multifile_Upload;
        $this->Multifile_Upload->initialize($config);
        $this->Multifile_Upload->set_allowed_types('gif|jpg|png|jpeg');
        $this->Multifile_Upload->do_upload('country_inspiration_image');

        //Insert Image Path into table
        foreach ($this->Multifile_Upload->saved_filename as $imgfile) {
            $imagepath = 'holidayimages/inspiration/' . $id . '/' .$countryid . '/'.$imgfile;

            $this->holiday_model->upload_inspiration_country_images($countryid, $imagepath);
        }
    }

    public function add_inspiration_country()
    {
        // print_r($_POST); exit;
    $countryid=$this->input->post('country');
     $id=$this->holiday_model->getcontinentbyID($countryid)->continent_id;
     if(empty($id))
     {
         redirect('holidaypackage/continent', 'refresh');  
     }
       $this->upload__ins_country_images($id,$countryid);
       redirect('holidaypackage/inspiration_country/'.$id, 'refresh');
    }

     public function hotofferpackagelist() {
       $data['package'] = $this->holiday_model->get_all_holiday_list_by_order('hot_offer');
       $data['hotofferpackage'] = $this->holiday_model->get_hotofferpackagelist();      
        $this->load->view('holiday/hotofferpackagelist', $data);
    }

    public function trenddestipackagelist() {
       $data['package'] = $this->holiday_model->get_all_holiday_list_by_order('trending_dest'); 
        $data['trenddestipackage'] = $this->holiday_model->get_trenddestipackagelist();     
        $this->load->view('holiday/trenddestipackagelist', $data);
    }

      public function location_destipackagelist() {
       $data['package'] = $this->holiday_model->get_all_holiday_list_by_order('location_dest'); 
        $data['location_destipackagelist'] = $this->holiday_model->get_location_destipackagelist();     
        $this->load->view('holiday/location_destipackagelist', $data);
    }

    public function offbeatpackagelist() {
       $data['package'] = $this->holiday_model->get_all_holiday_list_by_order('offbeat_place'); 
        $data['offbeatpackage'] = $this->holiday_model->get_offbeatpackagelist('offbeat_place');     
        $this->load->view('holiday/offbeatpackagelist', $data);
    }
    public function dealspackagelist() {
       $data['package'] = $this->holiday_model->get_all_holiday_list_by_order('deals'); 
        $data['dealspackage'] = $this->holiday_model->get_dealspackagelist();     
        $this->load->view('holiday/dealspackagelist', $data);
    }
    public function add_deals_offer($id='')
    {
        if($id=='')
        {
            redirect('holiday/dealspackagelist','refresh');
        }
       
       
        $this->form_validation->set_rules('deals_amount', 'Deals Amount', 'trim|required|integer|');       
        $this->form_validation->set_rules('deals_expire', 'Valid Upto', 'required');

        $data['status']='';
        $data['errors']='';

        $data['deals_offer'] = $this->holiday_model->get_holiday_deals_offer($id); 
        $data['dealspackage'] = $this->holiday_model->get_holiday_list_package_by_id($id);   
        $data['holiday_id']=$id; 

        if($this->form_validation->run() == FALSE)
        {
             
            $this->load->view('holiday/deals_offer', $data); 

        }
        else
        {
           $deals_amount = $this->input->post('deals_amount');
           $deals_expire = $this->input->post('deals_expire');         
            $dataarray=array(
                             'deals_amount'=>$deals_amount,
                             'deals_expire'=>$deals_expire,                             
                             );
           if($this->holiday_model->updatedeals_offer($dataarray,$id))
           { 
                redirect('holiday/dealspackagelist','refresh');
           }
           else
           {
               $data['errors']='Deals values is not updated...';
              $this->load->view('holiday/deals_offer', $data); 
           }

        }
    }


    public function cancelholidaybooking($id='')
    {
        if(empty($id))
        redirect('holiday/holiday_booking_report','refresh');
        $data= array('booking_status' =>'Cancelled');
        $this->holiday_model->cancelholidaybooking($data,$id);
        redirect('holiday/holiday_booking_report','refresh');
    }

     public function holiday_booking_payment_report()
     { 
         $data['status']=$status=isset($_GET['status']) ? $_GET['status'] : '';
        $data['contact']=$contact=isset($_GET['contact']) ? $_GET['contact'] : '';
        $data['email']=$email=isset($_GET['email']) ? $_GET['email'] : '';
        $data['razorpay_id']=$razorpay_id=isset($_GET['razorpay_id']) ? $_GET['razorpay_id'] : '';      
        $data['paid_amount']=$paid_amount=isset($_GET['paid_amount']) ? $_GET['paid_amount'] : '';
        $data['uniqueRefNo']=$uniqueRefNo=isset($_GET['uniqueRefNo']) ? $_GET['uniqueRefNo'] : '';
       $data['card_id']=$card_id=isset($_GET['card_id']) ? $_GET['card_id'] : '';
       $data['from_date']=$from_date=isset($_GET['from_date']) ? $_GET['from_date'] : '';
        $data['to_date']=$to_date=isset($_GET['to_date']) ? $_GET['to_date'] : '';
        $data['holi_booking_payment_report']=$this->holiday_model->holiday_booking_payment_report(trim($status),trim($contact),trim($email),trim($razorpay_id),trim($paid_amount),trim($uniqueRefNo),trim($card_id),trim($from_date),trim($to_date));    
         $this->load->view('holiday/holiday_booking_payment_report', $data);
    }
    public function assignto(){
        
            $assigntoemail=$_POST['email']; 
            $assignto=$_POST['assignto'];  
            $id=$_POST['id']; 
            $uniqueRefNo=$_POST['uniqueRefNo'];
            $data=array('assignto'=>$assignto);
            $this->holiday_model->update_holiday_booking_report($id,$uniqueRefNo,$data);           
            if($assigntoemail!='')
            {  
            $subadmininfo=$this->home_model->get_admin_info($assignto); 
                $uniqueRefNo=$uniqueRefNo;
                $data['holiday_booking_info'] =$this->holiday_model->get_holiday_booking($uniqueRefNo);
                $data['passenger_info'] =$this->holiday_model->get_holiday_pass_info($uniqueRefNo);
                $data['pay_info'] =$this->holiday_model->get_holiday_pay_info($uniqueRefNo);
                $data['holidaydetails'] = $this->holiday_model->get_holiday($data['holiday_booking_info']->holiday_id);
                $data_email = array(
                         'user_name'=>$subadmininfo->first_name.' '.$subadmininfo->middle_name.' '.$subadmininfo->last_name,
                         'assigntoemail'    => $assigntoemail,
                        'voucher'=>  $this->load->view('holiday/voucher',$data,true),
                        'subject'=>'Holiday Booking Voucher Details - '.$uniqueRefNo
                      );  
                      include_once (FCPATH . APPPATH . 'controllers/email.php');
                      $email=new email();                                  
                    $email->voucher_email($data_email);
            }
            echo 1;
    }


     public function update_trending_img($id='')
    {
      if($id=='')
      {
         redirect('holiday/trenddestipackagelist', 'refresh');  
      }
       $this->upload_trending_img($id);
       redirect('holiday/trenddestipackagelist', 'refresh');  
    }
    public function upload_trending_img($id)
    {
         //Image Size  
        $image_size = $this->config->item('image_sizes');
        
         //Upload Configuration Image
        $config['upload_path'] = './holidayimages/trending/' . $id . '/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        // $config['max_size'] =  $this->max_image_size;
        // $config['max_width'] =  $this->max_image_width;
        // $config['max_height'] = $this->max_image_height;      
        // $config['resize'] = true;
        $config['rename'] = true;
        $config['image_sizes'] = $image_size;
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, TRUE);
        }
        $this->load->library("Multifile_Upload", $config);
        $this->Multifile_Upload = new Multifile_Upload;
        $this->Multifile_Upload->initialize($config);
        $this->Multifile_Upload->set_allowed_types('gif|jpg|png|jpeg');
        $this->Multifile_Upload->do_upload('trending_img');

        //Insert Image Path into table
        foreach ($this->Multifile_Upload->saved_filename as $imgfile) {
            $imagepath = 'holidayimages/trending/' . $id . '/' . $imgfile;

            $this->holiday_model->upload_trending_img($id, $imagepath);
        }
    }


       public function trending_section_update() {
        $trending_section = $_POST['message'];
       
        foreach ($trending_section as $section) {

           $sec=explode('_', $section);

            $this->holiday_model->update_trending_section($sec[0],$sec[1]);
        }
         
    }

       public function update_location_img($id='')
    {
      if($id=='')
      {
         redirect('holiday/location_destipackagelist', 'refresh');  
      }
       $this->upload_location_img($id);
       redirect('holiday/location_destipackagelist', 'refresh');  
    }
    public function upload_location_img($id)
    {
         //Image Size  
        $image_size = $this->config->item('image_sizes');
        
         //Upload Configuration Image
        $config['upload_path'] = './holidayimages/locationimg/' . $id . '/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        // $config['max_size'] =  $this->max_image_size;
        // $config['max_width'] =  $this->max_image_width;
        // $config['max_height'] = $this->max_image_height;      
        // $config['resize'] = true;
        $config['rename'] = true;
        $config['image_sizes'] = $image_size;
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, TRUE);
        }
        $this->load->library("Multifile_Upload", $config);
        $this->Multifile_Upload = new Multifile_Upload;
        $this->Multifile_Upload->initialize($config);
        $this->Multifile_Upload->set_allowed_types('gif|jpg|png|jpeg');
        $this->Multifile_Upload->do_upload('location_img');

        //Insert Image Path into table
        foreach ($this->Multifile_Upload->saved_filename as $imgfile) {
            $imagepath = 'holidayimages/locationimg/' . $id . '/' . $imgfile;

            $this->holiday_model->upload_location_img($id, $imagepath);
        }
    }

      public function location_dest() {
        $rec = $_POST['message'];
        $rec1 = $_POST['message1'];
        foreach ($rec as $recom) {
            $rec_act = $this->holiday_model->update_location_dest($recom,'1');
        }
            foreach ($rec1 as $recom) {
            $rec_act = $this->holiday_model->update_location_dest($recom,'0');
        }
    }
     public function update_holiday_enquiry_status($id){
        $data = array(
            'status'=> 1
        );
        $this->holiday_model->update_holiday_enquiry_status($data,$id);
        // echo $this->db->last_query();exit;
        // echo '<pre/>';print_r($data['holiday_enquiry']);exit;
        redirect('holiday/holiday_enquiry','refresh');
    }

    public function approve_holiday_enquiry($id){
        $data['holiday_enquiry'] = $this->holiday_model->get_holiday_enquiry_by_id($id);
        $data['country_list'] = $this->holiday_model->get_country_list();
        // $this->db->last_query();
        // echo '<pre/>';print_r($data['holiday_enquiry']);exit;
        $this->load->view('holiday/approve_enquiry',$data);
    }
     public function add_booking_reports(){
        // echo '<pre/>';print_r($_POST);exit;$
        $id =  $this->input->post('id');
        $price =  $this->input->post('price');
        $tax =  $this->input->post('tax');
        $total_cost = $price +$tax ;
        $data = array(
            'holiday_id '=> $this->input->post('id'),
            'user_id '=> $this->input->post('user_id'),
            'agent_id '=> $this->input->post('agent_id'),
            'uniqueRefNo '=> $this->input->post('uniqueRefNo'),
            'invoice_number '=> $this->input->post('invoice_number'),
            'package_title '=> $this->input->post('package_title'),
            'holiday_duration '=> $this->input->post('package_validity'),
            'depart_date '=> $this->input->post('departuredate'),
            'arrival_date '=> $this->input->post('arrivaledate'),
            'title '=> $this->input->post('title'),
            'first_name '=> $this->input->post('fname'),
            'middle_name '=> $this->input->post('mname'),
            'last_name '=> $this->input->post('lname'),
            'adults_no '=> $this->input->post('Adults'),
            'childs_no '=> $this->input->post('Child'),
            'infants_no '=> $this->input->post('Infant'),
            'address '=> $this->input->post('address'),
            'user_city '=> $this->input->post('city'),
            'user_state '=> $this->input->post('state'),
            'user_country '=> $this->input->post('country'),
            'user_pincode '=> $this->input->post('pincode'),
            'user_mobile '=> $this->input->post('phone'),
            'user_email '=> $this->input->post('email'),
            'package_cost '=> $this->input->post('price'),
            'tax'=> $this->input->post('tax'),
            'received_amount'=> $this->input->post('received_amount'),
            'balance_amount'=> $this->input->post('balance_amount'),
            'pending'=> $this->input->post('pending'),
            'total_cost'=> $total_cost,
            'booking_status'=> 1
        );
        // echo '<pre/>';print_r($data);exit;
        $this->holiday_model->add_booking_reports($data);
        $data = array(
            'status' => 2);
        $this->holiday_model->update_holiday_enquiry_status($data,$id);
        // $this->db->last_query();
        // echo '<pre/>';print_r($data['holiday_enquiry']);exit;
        $this->load->view('holiday/approve_enquiry',$data);
    }
}

