<?php 
class Configs {

    private $data = array();

   public function __construct(){        
        $this->CI =& get_instance();
   }

    public function get($key) {

   if ($key) {

      $value = $this->get_config($key);

      if ($value) {

         return $value;

      } else {

         return false;

      }

      } else {

         return false;

      }

        return (isset($this->data[$key]) ? $this->data[$key] : null);
    }

    public function set($key, $value) {
        return $this->set_key($key, $value);
    }

    public function has($key) {
        return isset($this->data[$key]);
    }

    function get_config($key) {
      if ($key) {

      $data = $this->CI->db->get_where('setting', array('group' => 'config', 'key' => $key))->result_array();

      if (!empty($data)) {

      return $data[0]['value'];

      } else {

      return false;

      }

      } else {

         return false;

      }
   }

   function set_key($key, $value) {

      $checkExitKey = $this->CI->db->get_where('setting', array('group' => 'config', 'key' => $key))->result_array();

      if (!empty($checkExitKey)) {

         return $this->CI->db->update('setting', array('value'=>$value), array('group' => 'config', 'key' => $key));  

      }  else {

         $data = array(
            'website_id' => 0,
            'group' => 'config',
            'key' => $key,
            'value' => $value
         );

         return $this->CI->db->insert('setting', $data);
      }
    }


}

?>