<?php
require_once "app/models/User.php";
// require_once ('vendor/autoload.php');
require 'tcpdf/tcpdf.php';

class UserController{
    public static function index() {

        $users = User::getAllUsers();
        $create_permission = (
            isset($_SESSION["request_user"])  &&
            UserRole::getRole($_SESSION["request_user"]["role_id"])["name"]=="admin"
        );
        require_once "app/views/users/index.php";
    }

    public static function show() {
        $user_id = $_GET['id'];
        $user = User::getUser($user_id);

        if ($user) {
            require_once "app/views/users/show.php";
        } else {
            $_SESSION['error'] = "User not found";
            require_once "app/views/404_page.php";
        }

    }
    static function data_validation() {
        $errors = [];
        $len_name = strlen($_POST['last_name']);
        if ($len_name < 1 || $len_name > 32) {
            $errors['last_name_error'] = 'Last name must be between 1 and 32 characters';  
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email_error'] = 'Invalid email';
        }
        if (isset($_POST['password']) && strlen($_POST['password']) < 8) {
            $errors['password_error'] = 'Password must be at least 8 characters';
        }
        if (isset($_POST['role_id']) && !UserRole::getRole($_POST['role_id'])) {
            $errors['role_error'] = 'Invalid role';
        }

        return $errors;
    }

    public static function edit() {
        $user_id = $_GET['id'] ? $_GET['id'] : $_POST['id'];

        $role = UserRole::getRole($_SESSION["request_user"]["role_id"]);
        if ($role["name"] != "admin" && $user_id != $_SESSION["request_user"]["id"]){
                $_SESSION["error"]= "Invalid permissions";
                require_once "app/views/404_page.php";
                return;
            }

        $user = User::getUser($user_id);

        if (!$user) {
            $_SESSION['error'] = "User not found";
            require_once "app/views/404_page.php";
            return;
        }

        if (isset($_POST['id'])) {
            $_SESSION["edit_user"] = [];
            // Data validation
            $errors = self::data_validation();
            if (count($errors) > 0) {
                $_SESSION["edit_user"] = $errors;
                header("Location: edit?id=".$_POST['id']);
                return;
            }

            User::editUser(
                $user_id, 
                htmlentities($_POST['first_name']), 
                htmlentities($_POST['last_name']), 
                htmlentities($_POST['email'])
            );

            $_SESSION['success'] = 'Record updated';
            header("Location: edit?id=".$_POST['id']);
            return;
        }
        else {
            require_once "app/views/users/edit.php";
        }
    }

    public static function delete() {
        $role = UserRole::getRole($_SESSION["request_user"]["role_id"]);
        if ($role["name"] != "admin"){
            $_SESSION["error"]= "Invalid permissions";
            require_once "app/views/404_page.php";
            return;
        }

        $user_id = $_GET["id"];

        User::deleteUser($user_id);

        header("Location: index");
        return;
    }

    public static function create() {
        if (!isset($_SESSION["request_user"])){
            header("Location: /casa_productie_muzica");
        }

        $role = UserRole::getRole($_SESSION["request_user"]["role_id"]);
        if ($role["name"] != "admin"){
            $_SESSION["error"]= "Invalid permissions";
            require_once "app/views/404_page.php";
            return;
        }

        if (isset($_POST["is_post"])){
            // POST => create user
            $_SESSION["create_user"]["user"] = $_POST;

            $errors = self::data_validation();
            if (count($errors)){
                $_SESSION["create_user"]["errors"] = $errors;
                header("Location: create");
                return;
            }
           $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);

            User::createUser(
                htmlentities($_POST["first_name"]), 
                htmlentities($_POST["last_name"]),
                htmlentities($_POST["email"]), 
                $pass,
                htmlentities($_POST["role_id"])
            );
            header("Location: index");
        }
        // GET => show form
        if (!isset($_SESSION["create_user"]["user"])){
            $_SESSION["create_user"]["user"] = [
                "first_name" => "",
                "last_name" => "",
                "email" => ""
            ];
        }
        $roles  = UserRole::getAllRoles();
        require_once "app/views/users/create.php";
    }

    public function filterUserData(&$str) {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }

    public static function excel_export(){
        $file_name = "users_data.xls";
        header("Content-Disposition: attachment; filename=\"$file_name\"");
        header("Content-Type: application/vnd.ms-excel");
        $fields=array('ID','FIRST NAME','LAST NAME','EMAIL','ROLE ID');
        $excel=implode("\t",array_values($fields))."\n";
        $users=User::getAllUsers();
        foreach($users as $user){
            $line=array($user['id'],$user['first_name'],$user['last_name'],$user['email'],$user['role_id']);
            // array_walk($line,'filterUserData');
            $excel .= implode("\t", array_values($line)). "\n";
        }

        echo $excel;
        exit();
    }
    public static function word_export(){
        $file_name = "users_data.doc";
        header("Content-Disposition: attachment; filename=\"$file_name\"");
        header("Content-Type: application/vnd.ms-word");
        $fields=array('ID','FIRST NAME','LAST NAME','EMAIL','ROLE ID');
        $doc=implode("\t",array_values($fields))."\n";
        $users=User::getAllUsers();
        foreach($users as $user){
            $line=array($user['id'],$user['first_name'],$user['last_name'],$user['email'],$user['role_id']);
            // array_walk($line,'filterUserData');
            $doc .= implode("\t", array_values($line)). "\n";
        }

        echo $doc;
        exit();
    }
    public static function pdf_export(){
        $pdf = new TCPDF();
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 12);
        $html = '<h1 style="text-align: center;">User Data</h1>';
        $html .= '<table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>';
        $users=User::getAllUsers();
        foreach($users as $user){
            $html .= '<tr>
            <td>' . $user['first_name'] . '</td>
            <td>' . $user['last_name'] . '</td>
            <td>' . $user['email'] . '</td>
            <td> Show | Edit | Delete</td>
            </tr>';
        }
        $html .= '</table>';
        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('users.pdf', 'D');
        exit;
    }

}
?>