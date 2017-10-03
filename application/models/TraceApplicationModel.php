<?php


class TraceApplicationModel extends CI_Model
{
    public function __construct()    
    {
        $this->load->database(); 
    }

    public function FileTrackModel($fileId)
    {
        $query = $this->db->query("Exec MiscDb..File_Trace '$fileId'");
        $rowcount = $query->num_rows();
        if($rowcount > 0)
        {
            return $query->result_array();
        }
        else
        {
            return  -1;
        }

    }

}

?>
