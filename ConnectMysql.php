<?php
$a = 5;
class ConnectMysql
{

    protected function connectDb()
    {
        $connect = mysqli_connect(HOST, USER, PASSWORD, DB_NAME);
        return $connect;
    }
}
class A{

}