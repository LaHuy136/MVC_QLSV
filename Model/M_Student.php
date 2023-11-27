<?php
    include_once("E_Student.php");
    class Model_Student {
        public function __construct() {}
    
    // Hiển thị danh sách sv
        public function getAllStudent() {
            $link = mysqli_connect("localhost", "root", "") or die('Could not connet MYSQL');
            mysqli_select_db($link,"DULIEU88");
            $sql = "SELECT * FROM sinhvien";
            $rs = mysqli_query($link, $sql);
            $i = 0;
            while($row = mysqli_fetch_assoc($rs)) {
                $id = $row['ID'];
                $name = $row['Name'];
                $age = $row['Age'];
                $university = $row['University'];
                while($i != $id) $i++;
                $students[$i++] = new Entity_Student($id, $name, $age, $university);
            }
            return $students;
        }

    // Hiển thị thông tin chi tiết sv thông qua stid
        public function getStudentDetail($stid) { 
            $allStudent = $this->getAllStudent();
            return $allStudent[$stid];
        }

    // Xử lí chèn sv
        public function insertStudent($ID, $Name, $Age, $University) {
            $link = mysqli_connect("localhost", "root", "") or die('Could not connet MYSQL');
            mysqli_select_db($link,"DULIEU88");
            $checkID = "SELECT ID FROM sinhvien WHERE ID = '$ID'";
            $result = mysqli_query($link, $checkID);
        
            // kiểm tra mã sv đã tồn tại hay chưa
            if (mysqli_num_rows($result) > 0) {
                header("Location: C_Student.php?insertStudent");
            }else {
                $sql = "INSERT INTO sinhvien(ID, Name, Age, University) VALUES ('$ID','$Name','$Age','$University')";
                $rs = mysqli_query($link, $sql);
            }
        }

    // Xử lí cập nhật sv
        public function updateStudent($ID, $Name, $Age, $University) {
            $link = mysqli_connect("localhost", "root", "") or die('Could not connet MYSQL');
            mysqli_select_db($link,"DULIEU88");
            $sql = "UPDATE sinhvien SET Name ='$Name', Age ='$Age', University ='$University' WHERE ID = '$ID'";
            $rs = mysqli_query($link, $sql);
        }
    
    // Xử lí xóa sv
        public function deleteStudent($ID) {
            $link = mysqli_connect("localhost", "root", "") or die('Could not connect to MySQL');
            mysqli_select_db($link, "DULIEU88");
            $sql = "DELETE FROM sinhvien WHERE ID = '$ID'";
            $rs = mysqli_query($link, $sql);
            header("Location: C_Student.php?func3");
        }

    // Xử lí tìm kiếm sv
        public function findStudent($Infor, $ID, $Age, $Name, $University) {
            $link = mysqli_connect("localhost", "root", "") or die('Could not connect to MySQL');
            mysqli_select_db($link, "DULIEU88");
            $sql = "SELECT * FROM sinhvien WHERE ";
                // ID và Name khác rỗng 
            if($ID != null) {
                $sql .= " $ID LIKE '%$Infor%' ";
                if($Name != null) $sql .= " OR ";
            }
            // Name và Age khác rỗng
            if($Name != null) {
                $sql .= " $Name LIKE '%$Infor%' ";
                if($Age != null) $sql .= " OR ";
            }
                // Age và Uni khác rỗng
            if($Age != null) {
                $sql .= " $Age LIKE '%$Infor%' ";
                if($University != null) $sql .= " OR ";
            }
            if($University != null) {
                $sql .= " $University LIKE '%$Infor%'";
            }
            $rs = mysqli_query($link, $sql);
            if (mysqli_num_rows($rs) === 0) {
                header("Location: ../View/FindStudent.htm"); 
            } else {
                $i = 0;
                while($row = mysqli_fetch_array($rs)) {
                    $id = $row['ID'];
                    $name = $row['Name'];
                    $age = $row['Age'];
                    $university = $row['University'];
                    while($i != $id) $i++;
                    $students[$i++] = new Entity_Student($id, $name, $age, $university);
                }
                return $students;
            }
        }
    }
?>