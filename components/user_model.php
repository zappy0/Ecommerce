<?php
require 'C:/xampp/htdocs/Ecommerce-website/components/connect.php';
// include '../components/connect.php';
// include '../components/admin_header.php';


// class user_model{
//     private $conn;

//     function __construct($conn) {
//         $this->conn = $conn;
//     }

    
//     function getTotalPendings($admin_id){
    
//         if ($admin_id) {
//             $total_pendings = 0;
//             $select_pendings = $this->conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
//             $select_pendings->execute(['pending']);
//             if($select_pendings->rowCount() > 0){
//             while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
//                 $total_pendings += $fetch_pendings['total_price'];
//                 }
//             }
    
//             return $total_pendings;
//         }
//         else{
    
//             return -1;
    
//         }
//     }

    

    
// }

function checkAdmin($admin_id){
    global $conn;
    $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
    $select_admin->execute([$admin_id]);
    if($select_admin->rowCount() > 0){
        return 1;
    }

    return 0;
}

function getTotalPendings($admin_id){
    
    $isadmin = checkAdmin($admin_id);
    
    if ($isadmin) {
        $total_pendings = 0;
        global $conn;
        $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
        $select_pendings->execute(['pending']);
        if($select_pendings->rowCount() > 0){
        while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
            $total_pendings += $fetch_pendings['total_price'];
            }
        }

        return $total_pendings;
    }
    else{

        return -1;

    }
}


function getTotalCompletes($admin_id){
    
    $isadmin = checkAdmin($admin_id);
    if ($isadmin) {
        $total_completes = 0;
        global $conn;
        $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
        $select_completes->execute(['completed']);
        if($select_completes->rowCount() > 0){
           while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
              $total_completes += $fetch_completes['total_price'];
           }
        }

        return $total_completes;
    }
    else{

        return -1;

    }
}

function getNumberOrders($admin_id){
    
    $isadmin = checkAdmin($admin_id);
    if ($isadmin) {
        global $conn;
        $select_orders = $conn->prepare("SELECT * FROM `orders`");
        $select_orders->execute();
        $number_of_orders = $select_orders->rowCount();

        return $number_of_orders;
    }
    else{

        return -1;

    }
}

function getProductsAdded($admin_id){
    
    $isadmin = checkAdmin($admin_id);
    if ($isadmin) {
        global $conn;
        $select_products = $conn->prepare("SELECT * FROM `products`");
        $select_products->execute();
        $number_of_products = $select_products->rowCount();

        return $number_of_products;
    }
    else{

        return -1;

    }
}


function getNumUsers($admin_id){
    
    $isadmin = checkAdmin($admin_id);
    if ($isadmin) {
        global $conn;
        $select_users = $conn->prepare("SELECT * FROM `users`");
        $select_users->execute();
        $number_of_users = $select_users->rowCount();

        return $number_of_users;
    }
    else{

        return -1;

    }
}


function getAdminUsers($admin_id){
    
    $isadmin = checkAdmin($admin_id);
    if ($isadmin) {
        global $conn;
        $select_admins = $conn->prepare("SELECT * FROM `admins`");
        $select_admins->execute();
        $number_of_admins = $select_admins->rowCount();

        return $number_of_admins;
    }
    else{

        return -1;

    }
}


function getNumMessages($admin_id){
    
    $isadmin = checkAdmin($admin_id);
    if ($isadmin) {
        global $conn;
        $select_messages = $conn->prepare("SELECT * FROM `messages`");
        $select_messages->execute();
        $number_of_messages = $select_messages->rowCount();
        return $number_of_messages;
    }
    else{

        return -1;

    }
}


function updateAdminProfile($admin_id){
    
    $isadmin = checkAdmin($admin_id);
    $isDone = 0;
    if ($isadmin) {
        global $conn;
        global $message;
        if(isset($_POST['submit'])){

            $name = $_POST['name'];
            $name = filter_var($name, FILTER_SANITIZE_STRING);
         
            $update_profile_name = $conn->prepare("UPDATE `admins` SET name = ? WHERE id = ?");
            $update_profile_name->execute([$name, $admin_id]);
         
            $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
            $prev_pass = $_POST['prev_pass'];
            // print $prev_pass;
            $old_pass = sha1($_POST['old_pass']);
            $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
            // print $old_pass;

            $new_pass = sha1($_POST['new_pass']);
            $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
            // print $new_pass;

            $confirm_pass = sha1($_POST['confirm_pass']);
            $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);
            // print $confirm_pass;

            if($old_pass == $empty_pass){
               $message[] = 'please enter old password!';
            }elseif($old_pass != $prev_pass){
               $message[] = 'old password not matched!';
            }elseif($new_pass != $confirm_pass){
               $message[] = 'confirm password not matched!';
            }else{
               if($new_pass != $empty_pass){
                  $update_admin_pass = $conn->prepare("UPDATE `admins` SET password = ? WHERE id = ?");
                  $update_admin_pass->execute([$confirm_pass, $admin_id]);
                  $message[] = 'password updated successfully!';
                  $isDone=1;
               }else{
                  $message[] = 'please enter a new password!';
               }
            }
        }

    }

    return $isDone;
}

?>