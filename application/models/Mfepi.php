<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mfepi extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
    public function check_existing_centre($centreid){
         $sql='select count(*) as exist from Centre where CentreID='.$centreid;
         $query=$this->db->query($sql);
         return $query->row_array(); 
    }
    public function set_existing_data($xml){
       $centredata =array();
       $officedata =array();
       $centrephotos =array();
       foreach ($xml as $Centre => $CentreArray) {
                    foreach ($CentreArray as $key => $CDataArray) {
                        $check_existing_centre=$this->check_existing_centre($CDataArray['CentreID']);
                        if(!$check_existing_centre['exist']){
                                    $centredata[]= $CDataArray;
                                    foreach ($CDataArray['OfficeTypes'] as $key => $OfficeTypesArray) {
                                    $OfficeTypesArray['CentreID']=@$CDataArray['CentreID'];
                                    $officedata[]=   $OfficeTypesArray;
                                    }
                                    foreach ($CDataArray['Photos']['Photo'] as $key => $PhotoArray) {
                                                $PhotoArray['CentreID']=@$CDataArray['CentreID'];
                                                $centrephotos[]= $PhotoArray;
                                    }
                        }
        
        
                    }
       }
       $status=1;
       $this->db->insert_batch('Centre', $centredata); 
       $this->db->insert_batch('OfficeTypes', $officedata); 
       $this->db->insert_batch('Photos', $centrephotos); 
       $error = $this->db->_error_message();
        if(!empty($error)) {
           $status=0;
        }
        return $status;
    }
     public function set_new_data($xml){
       $centredata =array();
       $officedata =array();
       $centrephotos =array();
       $this->db->truncate('Centre');
       $this->db->truncate('OfficeTypes');
       $this->db->truncate('Photos');
       foreach ($xml as $Centre => $CentreArray) {
                    foreach ($CentreArray as $key => $CDataArray) {
                                    $centredata[]= $CDataArray;
                                    foreach ($CDataArray['OfficeTypes'] as $key => $OfficeTypesArray) {
                                    $OfficeTypesArray['CentreID']=@$CDataArray['CentreID'];
                                    $officedata[]=   $OfficeTypesArray;
                                    }
                                    foreach ($CDataArray['Photos']['Photo'] as $key => $PhotoArray) {
                                                $PhotoArray['CentreID']=@$CDataArray['CentreID'];
                                                $centrephotos[]= $PhotoArray;
                                    }
                      
        
        
                    }
       }
       $this->db->insert_batch('Centre', $centredata); 
       $this->db->insert_batch('OfficeTypes', $officedata); 
       $this->db->insert_batch('Photos', $centrephotos);
       $error = $this->db->_error_message();
        if(!empty($error)) {
           $status=0;
        }
        return $status; 
    }
}