<?php 
    require_once "config.php";
    require_once "config2.php";
    
    if(function_exists($_GET['function'])) {
        $_GET['function']();
    }   

    function register(){
        global $connect, $connect2;      

        $nomorHP        = $_POST['nomorHP'];
        $referral       = $_POST['referral'];
        $user_token     = $_POST['token'];

        $data = [];
        $get_all_data_register = $connect->query("SELECT * FROM mebers WHERE hphone ='".$nomorHP."'");    
        $get_rows = mysqli_num_rows($get_all_data_register);

        if($get_rows == null){
            //db dashboard tombo
            mysqli_query($connect, "INSERT INTO mebers(paket, hphone,sponsor) VALUES('USER', '$nomorHP','$referral')");

            //db tomboati
            mysqli_query($connect2, "INSERT INTO USER_REGISTER(NOMORHP,KODEREFERRAL) VALUES('$nomorHP','$referral')");
            
            mysqli_query($connect2, "UPDATE USER_REGISTER SET USERTOKEN=".$user_token." WHERE NOMORHP=".$nomorHP."");

            $get_data_register_by_phone = mysqli_query($connect, "SELECT * FROM mebers WHERE hphone ='".$nomorHP."'");
            $get_rows = mysqli_num_rows($get_data_register_by_phone);

            while($row=mysqli_fetch_object($get_data_register_by_phone)){
                $data[] =$row;
            }

            $response=array(
                'error'     => false,
                'message'   =>'Sukses Register',
                'data'      => $data
            );
        }else{
            $response=array(
                'error'     => true,
                'message'   =>'Gagal Register'
            );
        }
        
        header('Content-Type: application/json');
        echo json_encode($response);
    }   
?>