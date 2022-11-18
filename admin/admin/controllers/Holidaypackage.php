<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class HolidayPackage extends CI_CONTROLLER {
    function __construct() {
        parent :: __construct();
        $this->load->database();
        $this->load->model('holidaypackage_model');
        $this->load->library('admin_auth');
        $this->is_logged_in();
    }

    private function is_logged_in() {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('login/admin_login');
        }
    }


              /////////////////////////////////////////////////
             ///////////////HOLIDAY PACKAGES//////////////////
            /////////////////////////////////////////////////



 public function continent($error = '')
    {
       $data = array();
        if ($error == 1) {
            $data['error'] = 'This Continent name already exists..! Please Enter other Continent Name';
        }
        $data['continent_list'] = $this->holidaypackage_model->get_continent_list();
        $this->load->view('holiday_package/add_continent', $data);
    }
     public function add_continent($error = '')
    {
       $continent = $this->input->post('continent');
       $check_continent_avail = $this->holidaypackage_model->check_continent_avail($continent);
        if (!empty($check_continent_avail)) {
           redirect('holidaypackage/continent/1');
        } else {
           $data = array(
            'continent_id' => '',
            'continent_name' => $continent,
            'isActive'=>1                    
        );
          $addcontinent = $this->holidaypackage_model->add_continent($data);
           redirect('holidaypackage/continent', 'refresh');
       }
    }
    public function edit_continent($id, $error = '') {
        if ($error == 1) {
            $data['error'] = 'This Continent name already exists..! Please Enter other Continent Name';
        }
        $data['continent_list'] = $this->holidaypackage_model->get_continent_list($id);
       $this->load->view('holiday_package/edit_continent', $data);
    }
    public function delete_continent($id) {
        $this->holidaypackage_model->delete_continent($id);
       redirect('holidaypackage/continent');
    }
      public function update_continent($id) {
        $continent = $this->input->post('continent');
       $check_continent_avail = $this->holidaypackage_model->check_continent_avail($continent);
        if (!empty($check_continent_avail)) {
           redirect('holidaypackage/edit_continent/'.$id.'/1');
        } 
        else{          
            $updatecontinent = $this->holidaypackage_model->update_continent($id,$continent);
           redirect('holidaypackage/continent', 'refresh');
          }
    }
     public function country($error = '')
    {
       $data = array();
        if ($error == 1) {
            $data['error'] = 'This Country name already exists..! Please Enter other Country Name';
        }
        $data['continent_list'] =$m= $this->holidaypackage_model->get_continent_list();
        //echo $this->db->last_query();
      //  print_r($data['continent_list']);
        $data['country_list'] = $this->holidaypackage_model->get_holi_country_list();
        $this->load->view('holiday_package/add_country', $data);
    }
     public function add_country($error = '')
    {
       $continent = $this->input->post('continent');
       $country = $this->input->post('country');
       $check_country_avail = $this->holidaypackage_model->check_country_avail($country);
        if (!empty($check_country_avail)) {
           redirect('holidaypackage/country/1');
        } else {
           $data = array(
            'country_id' => '',
            'country_name' => $country,
            'continent_id' => $continent,
            'isActive'=>1                    
        );
          $addcountry = $this->holidaypackage_model->add_holi_country($data);
           redirect('holidaypackage/country', 'refresh');
       }
    }
    public function edit_country($id, $error = '') {
        if ($error == 1) {
            $data['error'] = 'This Country name already exists..! Please Enter other Country Name';
        }
        $data['continent_list'] = $this->holidaypackage_model->get_continent_list();
        $data['country_list'] = $this->holidaypackage_model->get_holi_country_list($id);
       $this->load->view('holiday_package/edit_country', $data);
    }
     public function update_country($id) {
            $country = $this->input->post('country');  
            $continent = $this->input->post('continent');   
            $check_country_avail = $this->holidaypackage_model->check_country_avail($country);
            if (!empty($check_country_avail)) {
           redirect('holidaypackage/edit_country/'.$id.'/1');
        } else {        
            $updatecontinent = $this->holidaypackage_model->update_holi_country($id,$country,$continent);
           redirect('holidaypackage/country', 'refresh');
          }
    }
     public function delete_country($id) {
        $this->holidaypackage_model->delete_holi_country($id);
       redirect('holidaypackage/country');
    }
    //State
     public function state($error = '')
    {
       $data = array();
        if ($error == 1) {
            $data['error'] = 'This State name already exists..! Please Enter other State Name';
        }
        $data['state_list'] = $this->holidaypackage_model->get_holi_state_list();
        $data['country_list'] = $this->holidaypackage_model->get_holi_country_list();
        $this->load->view('holiday_package/add_state', $data);
    }
     public function add_state()
    {      
       $country = $this->input->post('country');
       $state = $this->input->post('state');
       $check_state_avail = $this->holidaypackage_model->check_state_avail($state);
        if (!empty($check_state_avail)) {
           redirect('holidaypackage/state/1');
        } else {
            $data = array(
            'state_id' => '',
            'state_name' => $state,
            'country_id' => $country,
            'isActive'=>1                    
        );
          $addstate = $this->holidaypackage_model->add_holi_state($data);
           redirect('holidaypackage/state', 'refresh');
       }
    }
    public function edit_state($id, $error = '') {
        if ($error == 1) {
            $data['error'] = 'This State name already exists..! Please Enter other State Name';
        }
        $data['state_list'] = $this->holidaypackage_model->get_holi_state_list($id);
        $data['country_list'] = $this->holidaypackage_model->get_holi_country_list();
       $this->load->view('holiday_package/edit_state', $data);
    }
     public function update_state($id) {
            $country = $this->input->post('country');  
            $state = $this->input->post('state'); 
           $check_state_avail = $this->holidaypackage_model->check_state_avail($state);
        if (!empty($check_state_avail)) {
           redirect('holidaypackage/edit_state/'.$id.'/1');
        } else {
          $this->holidaypackage_model->update_holi_state($id,$state,$country);
          redirect('holidaypackage/state', 'refresh');
         }
    }
     public function delete_state($id) {
        $this->holidaypackage_model->delete_holi_state($id);
       redirect('holidaypackage/state');
    }
    //City
     public function city($error = '')
    {
       $data = array();
        if ($error == 1) {
            $data['error'] = 'This city name already exists..! Please Enter Other city Name';
        }
        $data['city_list'] = $this->holidaypackage_model->get_holi_city_list();
        $data['state_list'] = $this->holidaypackage_model->get_holi_state_list();
        // echo $this->db->last_query();
        // echo '<pre/>12';print_r($data['state_list']);
        $data['country_list'] = $this->holidaypackage_model->get_holi_country_list();
        $this->load->view('holiday_package/add_city', $data);
    }
     public function add_city()
    {
        $country = $this->input->post('country');
       $state = $this->input->post('state');
        $city = $this->input->post('city');
       $check_holi_city_avail = $this->holidaypackage_model->check_holi_city_avail($city);
        if (!empty($check_holi_city_avail)) {
           redirect('holidaypackage/city/1');
        } else {
          $addstate = $this->holidaypackage_model->add_holi_city($city,$state,$country);
           redirect('holidaypackage/city', 'refresh');
       }
    }
     public function edit_city($id, $error = '') {
        if ($error == 1) {
            $data['error'] = 'This City name already exists..! Please Enter other City Name';
        }
        $data['city_list'] = $this->holidaypackage_model->get_holi_city_list($id);
        $data['state_list'] = $this->holidaypackage_model->get_holi_state_list();
        $data['country_list'] = $this->holidaypackage_model->get_holi_country_list();
       $this->load->view('holiday_package/edit_city', $data);
    }
     public function update_city($id) {
           $country = $this->input->post('country');  
            $state = $this->input->post('state'); 
            $city = $this->input->post('city'); 
            $check_holi_city_avail = $this->holidaypackage_model->check_holi_city_avail($city);
        if (!empty($check_holi_city_avail)) {
           redirect('holidaypackage/edit_city/'.$id.'/1');
        } else {
           $this->holidaypackage_model->update_holi_city($id,$city,$state,$country);  
          redirect('holidaypackage/city', 'refresh');
         }
    }
     public function delete_city($id) {
        $this->holidaypackage_model->delete_holi_city($id);
       redirect('holidaypackage/city');
    }
    public function set_status_active($id,$active)
    {
       $this->holidaypackage_model->set_active_status_holi_city($id,$active);
       redirect('holidaypackage/city');
    }
    public function holistate_info($id)
    {
       $state_list = $this->holidaypackage_model->get_holi_state_list_by_country_id($id);
       ?>
        <select  id="holidaypackagestate" name="state" class="holidaypackage_state form-control" tabindex="-1" required>
                    <option value="">Select Your State</option>
                     <?php if(!empty($state_list)){ ?>
                    <optgroup label="State List">                                       
                        <?php                
                      for($i=0;$i<count($state_list);$i++) {?>
                      <option value="<?php echo $state_list[$i]->state_id; ?>"><?php echo $state_list[$i]->state_name; ?></option>
                    <?php }  ?>                    
                    </optgroup>   
                    <?php } else {?>   
                    <optgroup label="No State List found"> 
                    </optgroup> 
                    <?php } ?>            
                  </select>
       <?php
    }


     public function inspiration()
     {
      $id=$_POST['data_val'];
       $this->holidaypackage_model->update_inspiration($id); 
     }


    public function inspiration_country($id='')
    {
        if (empty($id)) {
          redirect('holidaypackage/continent', 'refresh');  
        } 
    $data['ins_country_list'] = $this->holidaypackage_model->get_inspiration_country_list($id);
      $this->load->view('holiday_package/add_inpirational_country', $data);
    }

      public function inspirationcountry($continentid,$id,$isActive)
     {     
       $this->holidaypackage_model->update_inspiration_country($id,$isActive);
       redirect('holidaypackage/inspiration_country/'.$continentid, 'refresh');  
     }

     public function edit_inspiration($id='')
     {
           if (empty($id)) {
          redirect('holidaypackage/continent', 'refresh');
        }
      $data['ins_continent_list'] = $this->holidaypackage_model->getcontinentbycountryid($id);
      $this->load->view('holiday_package/edit_continent_inspiration', $data);  
        
     }

}