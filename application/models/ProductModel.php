<?php

class ProductModel extends CI_Model
{

    public function getProduct()
    {
    
        $this->db->select("*,FORMAT(created_date,'yyyy-MM-dd') AS date");
        
        $res = $this->db->get('products')->result_array();

        return $res;
       
    }

    public function deleteProduct($id, $type)
    {
    
        $data = array('is_deleted' => $type);
        
        $this->db->where('id', $id);
        $this->db->update('products', $data);

        return $this->db->last_query();;
       
    }

    public function editProductData($id)
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('id', $id);
        $query = $this->db->get()->row_array();
    
        return $query;
       
    }

    public function productAddEdit($post,$id)
    {

      
        if($id !=0){
            $this->db->where('id', $id);
            $this->db->update('products', $post); 
            

        }
        else{
            $this->db->insert('products',$post);
           
        }
        
        return $this->db->last_query();;
       
    }

    
    
}
