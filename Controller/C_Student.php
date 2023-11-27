<?php
    include_once("../Model/M_Student.php");
    class Ctrl_Student {
        public function invoke() {
            if(isset($_GET['stid'])) {
                $modelStudent = new Model_Student();
                $studentDetail = $modelStudent->getStudentDetail($_GET['stid']);
                include_once("../View/StudentDetail.htm");
            }
            else if(isset($_POST['submit'])){
                $ID = $_REQUEST['txtID'];
                $Name = $_REQUEST['txtName'];
                $Age = $_REQUEST['txtAge'];
                $University = $_REQUEST['txtUni'];
                $modelStudent = new Model_Student();
                $modelStudent->insertStudent($ID, $Name, $Age, $University);
                header("Location: C_Student.php");
            }
            else if(isset($_POST['update'])) {
                $ID = $_REQUEST['txtID'];
                $Name = $_REQUEST['txtName'];
                $Age = $_REQUEST['txtAge'];
                $University = $_REQUEST['txtUni'];
                $modelStudent = new Model_Student();
                $modelStudent->updateStudent($ID, $Name, $Age, $University);
                header("Location: C_Student.php?updateStudent");
            }
            else if(isset($_GET['up'])) {
                $modelStudent = new Model_Student();
                $studentDetail = $modelStudent->getStudentDetail($_GET['up']);
                include_once("../View/UpdateStudent.htm");
            }
            else if(isset($_GET['del'])) {
                $modelStudent = new Model_Student();
                $modelStudent->deleteStudent($_GET['del']);
            }
            else if(isset($_POST['find'])) {
                $Infor = $_REQUEST['txtInfor'];
                $ID = @($_REQUEST['fields']);
                $Age = @($_REQUEST['fields']);
                $Name = @($_REQUEST['fields']);
                $University = @($_REQUEST['fields']);
                $modelStudent = new Model_Student();
                $studentList = $modelStudent->findStudent($Infor, $ID, $Age, $Name, $University);
                include_once("../View/ResultFind.htm");
            }
            else if (isset($_GET['func1'])) {
                include_once("../View/InsertStudent.htm");
            }
            else if(isset($_GET['func2'])) {
                $modelStudent = new Model_Student();
                $studentList = $modelStudent->getAllStudent();
                include_once("../View/StudentListUpdate.htm");
            }
            else if(isset($_GET['func3'])) {
                $modelStudent = new Model_Student();
                $studentList = $modelStudent->getAllStudent();
                include_once("../View/DeleteStudent.htm");
            }
            else if(isset($_GET['func4'])) {
                include_once("../View/FindStudent.htm");
            } 
            else {
                $modelStudent = new Model_Student();
                $studentList = $modelStudent->getAllStudent();
                include_once("../View/StudentList.htm");
            }
        }
    };
    $C_Student = new Ctrl_Student();
    $C_Student->invoke();
   
   
    
?>