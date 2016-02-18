<?php

class TestModel extends Model
{
    function test()
    {
        $query = $this->db->q('SELECT * FROM categories');
        $result = $this->db->fassoc($query);
        
        var_dump($result);
    }
}
    
?>