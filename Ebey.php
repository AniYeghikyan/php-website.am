<?php


class Ebay extends ConnectMysql implements Shop, Car
{


    public function CreateShop($data = [])
    {

        if (empty($data)) {
            $html = "<form method='post' action='admin_panel.php'>
                     <input name='shop_name'>
                     <input type='submit' value='create' name='create_shop'>
                     

</form>";
            return $html;
        } else {
            $name= !empty($data['name'])?$data['name']:"not set";
            $desc= !empty($data['description'])?$data['description']:"not set";

            return true;
        }

    }

    public function updateSop()
    {
        // TODO: Implement updateSop() method.
    }

    public function getShopData()
    {
        // TODO: Implement getShopData() method.
    }

    public function Create()
    {
        // TODO: Implement Create() method.
    }

    public function getdata()
    {
        //TODO :
    }
}