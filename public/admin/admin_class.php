<?php
session_start();
ini_set('display_errors', 1);

class Action {
    private $db;

    public function __construct() {
        ob_start();
        include 'db_connect.php';
        $this->db = $conn;
    }

    function __destruct() {
        $this->db->close();
        ob_end_flush();
    }

    function login(){
        extract($_POST);
        $qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".$password."' ");
        if($qry->num_rows > 0){
            foreach ($qry->fetch_array() as $key => $value) {
                if($key != 'password' && !is_numeric($key))
                    $_SESSION['login_'.$key] = $value;
            }
            return 1;
        }else{
            return 3;
        }
    }

    function login2(){
        extract($_POST);
        $qry = $this->db->query("SELECT * FROM users where username = '".$email."' and password = '".md5($password)."' ");
        if($qry->num_rows > 0){
            foreach ($qry->fetch_array() as $key => $value) {
                if($key != 'password' && !is_numeric($key))
                    $_SESSION['login_'.$key] = $value;
            }
            return 1;
        }else{
            return 3;
        }
    }

    function logout(){
        session_destroy();
        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$key]);
        }
        header("location:login.php");
    }

    function logout2(){
        session_destroy();
        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$key]);
        }
        header("location:../index.php");
    }

    function signup(){
        extract($_POST);
        $data = " name = '$name' ";
        $data .= ", contact = '$contact' ";
        $data .= ", address = '$address' ";
        $data .= ", username = '$email' ";
        $data .= ", password = '".md5($password)."' ";
        $data .= ", type = 3";
        $chk = $this->db->query("SELECT * FROM users where username = '$email' ")->num_rows;
        if($chk > 0){
            return 2;
            exit;
        }
        $save = $this->db->query("INSERT INTO users set ".$data);
        if($save){
            $qry = $this->db->query("SELECT * FROM users where username = '".$email."' and password = '".md5($password)."' ");
            if($qry->num_rows > 0){
                foreach ($qry->fetch_array() as $key => $value) {
                    if($key != 'password' && !is_numeric($key))
                        $_SESSION['login_'.$key] = $value;
                }
            }
            return 1;
        }
    }

    function save_settings(){
        extract($_POST);
        $data = " name = '".str_replace("'","&#x2019;",$name)."' ";
        $data .= ", email = '$email' ";
        $data .= ", contact = '$contact' ";
        $data .= ", about_content = '".htmlentities(str_replace("'","&#x2019;",$about))."' ";
        if($_FILES['img']['tmp_name'] != ''){
            $fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
            $move = move_uploaded_file($_FILES['img']['tmp_name'],'../assets/img/'. $fname);
            $data .= ", cover_img = '$fname' ";
        }
        $chk = $this->db->query("SELECT * FROM system_settings");
        if($chk->num_rows > 0){
            $save = $this->db->query("UPDATE system_settings set ".$data);
        }else{
            $save = $this->db->query("INSERT INTO system_settings set ".$data);
        }
        if($save){
            $query = $this->db->query("SELECT * FROM system_settings limit 1")->fetch_array();
            foreach ($query as $key => $value) {
                if(!is_numeric($key))
                    $_SESSION['setting_'.$key] = $value;
            }
            return 1;
        }
    }

    function save_loan_type(){
        extract($_POST);
        $data = " type_name = '$type_name' ";
        $data .= " , description = '$description' ";
        if(empty($id)){
            $save = $this->db->query("INSERT INTO loan_types set ".$data);
        }else{
            $save = $this->db->query("UPDATE loan_types set ".$data." where id=".$id);
        }
        if($save)
            return 1;
    }

    function delete_loan_type(){
        extract($_POST);
        $delete = $this->db->query("DELETE FROM loan_types where id = ".$id);
        if($delete)
            return 1;
    }

    function save_plan(){
        extract($_POST);
        $data = " months = '$months' ";
        $data .= ", interest_percentage = '$interest_percentage' ";
        $data .= ", penalty_rate = '$penalty_rate' ";

        if(empty($id)){
            $save = $this->db->query("INSERT INTO loan_plan set ".$data);
        }else{
            $save = $this->db->query("UPDATE loan_plan set ".$data." where id=".$id);
        }
        if($save)
            return 1;
    }

    function delete_plan(){
        extract($_POST);
        $delete = $this->db->query("DELETE FROM loan_plan where id = ".$id);
        if($delete)
            return 1;
    }

    function save_borrower(){
        extract($_POST);
        $data = " lastname = '$lastname' ";
        $data .= ", firstname = '$firstname' ";
        $data .= ", middlename = '$middlename' ";
        $data .= ", address = '$address' ";
        $data .= ", contact_no = '$contact_no' ";
        $data .= ", email = '$email' ";
        $data .= ", tax_id = '$tax_id' ";

        if(empty($id)){
            $save = $this->db->query("INSERT INTO borrowers set ".$data);
        }else{
            $save = $this->db->query("UPDATE borrowers set ".$data." where id=".$id);
        }
        if($save)
            return 1;
    }

    function delete_borrower(){
        extract($_POST);
        $delete = $this->db->query("DELETE FROM borrowers where id = ".$id);
        if($delete)
            return 1;
    }

    function save_loan(){
        extract($_POST);
        $data = " borrower_id = $borrower_id ";
        $data .= " , loan_type_id = '$loan_type_id' ";
        $data .= " , plan_id = '$plan_id' ";
        $data .= " , amount = '$amount' ";
        $data .= " , purpose = '$purpose' ";
        if(isset($status)){
            $data .= " , status = '$status' ";
            if($status == 2){
                $plan = $this->db->query("SELECT * FROM loan_plan where id = $plan_id ")->fetch_array();
                for($i= 1; $i <= $plan['months'];$i++){
                    $date = date("Y-m-d",strtotime(date("Y-m-d")." +".$i." months"));
                    $chk = $this->db->query("SELECT * FROM loan_schedules where loan_id = $id and date(date_due) ='$date'  ");
                    if($chk->num_rows > 0){
                        $ls_id = $chk->fetch_array()['id'];
                        $this->db->query("UPDATE loan_schedules set loan_id = $id, date_due ='$date' where id = $ls_id ");
                    }else{
                        $this->db->query("INSERT INTO loan_schedules set loan_id = $id, date_due ='$date' ");
                        $ls_id = $this->db->insert_id;
                    }
                    $sid[] = $ls_id;
                }
                $sid = implode(",",$sid);
                $this->db->query("DELETE FROM loan_schedules where loan_id = $id and id not in ($sid) ");
                $data .= " , date_released = '".date("Y-m-d H:i")."' ";
            }else{
                $chk = $this->db->query("SELECT * FROM loan_schedules where loan_id = $id")->num_rows;
                if($chk > 0){
                    $this->db->query("DELETE FROM loan_schedules where loan_id = $id ");
                }
            }
        }
        if(empty($id)){
            $ref_no = mt_rand(1,99999999);
            $i= 1;
            while($i== 1){
                $check = $this->db->query("SELECT * FROM loan_list where ref_no ='$ref_no' ")->num_rows;
                if($check > 0){
                    $ref_no = mt_rand(1,99999999);
                }else{
                    $i = 0;
                }
            }
            $data .= " , ref_no = '$ref_no' ";
        }
        if(empty($id))
            $save = $this->db->query("INSERT INTO loan_list set ".$data);
        else
            $save = $this->db->query("UPDATE loan_list set ".$data." where id=".$id);
        if($save)
            return 1;
    }

    function delete_loan(){
        extract($_POST);
        $delete = $this->db->query("DELETE FROM loan_list where id = ".$id);
        if($delete)
            return 1;
    }

    function save_payment(){
        extract($_POST);
        $data = " loan_id = $loan_id ";
        $data .= " , payee = '$payee' ";
        $data .= " , amount = '$amount' ";
        $data .= " , penalty_amount = '$penalty_amount' ";
        $data .= " , overdue = '$overdue' ";
        if(empty($id)){
            $save = $this->db->query("INSERT INTO payments set ".$data);
        }else{
            $save = $this->db->query("UPDATE payments set ".$data." where id = ".$id);
        }
        if($save)
            return 1;
    }

    function delete_payment(){
        extract($_POST);
        $delete = $this->db->query("DELETE FROM payments where id = ".$id);
        if($delete)
            return 1;
    }

    public function delete_user($id){
        $query = "DELETE FROM users WHERE id = '$id'";
        if ($this->db->query($query) === TRUE) {
            return 1;
        } else {
            return 0;
        }
    }

    public function edit_user($id) {
        $query = "SELECT * FROM users WHERE id = '$id'";
        $result = $this->db->query($query);
        if ($result) {
            $user_data = $result->fetch_assoc();
            return json_encode($user_data);
        } else {
            return json_encode(array("error" => "Failed to retrieve user data"));
        }
    }

    function save_user() {
        extract($_POST);
        $data = array(
            "name" => $name,
            "username" => $username,
            "password" => $password,
            
        );
        if (empty($id)) {
            // Insert new user
            $fields = implode(", ", array_keys($data));
            $values = "'" . implode("', '", array_values($data)) . "'";
            $query = "INSERT INTO users ($fields) VALUES ($values)";
        } else {
            // Update existing user
            $set_values = [];
            foreach ($data as $key => $value) {
                $set_values[] = "$key = '$value'";
            }
            $query = "UPDATE users SET " . implode(", ", $set_values) . " WHERE id = $id";
        }
        $result = $this->db->query($query);
        if ($result) {
            // Redirect user to a specific page
            header("Location: index.php?page=users");
            exit();
        } else {
            // Handle error if the save operation fails
            // You can add error handling code here if needed
        }
    }
}
?>
