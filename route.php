<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../model/acct.dbh.php';
require_once 'autoloader.php';

// GET
/****************************
        VERIFY TOKEN
****************************/
// verify account
if (isset($_GET['token'])) {
    $object = new Accounts($DB_conn);
    $object->verifyToken($_GET['token'], $_GET['email']);
}

/****************************
          LOGOUT
****************************/
if (isset($_POST['logout'])) {
    $object = new Accounts($DB_conn);
    $object->logout($_SESSION['userName']);
    exit();
}

// POST
switch ($_POST['submitType']) {
  /****************************
            REGISTER
  ****************************/
  case 'register':
  // validate csrf
    if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['formMsg']="Something went wrong, please close the browser then try again.";
        header('location:../index.php');
        exit();
    }

    $object = new Accounts($DB_conn);
    // setters
    if (empty($_POST['userName']) || empty($_POST['userEmail']) || empty($_POST['userPwd']) || empty($_POST['reUserPwd'])) {
        $_SESSION['formMsg']="All inputs are required";
        header('location:../index.php');
        exit();

    } elseif (!preg_match("/^[a-zA-Z ]*$/", $_POST['userName'])) {
        $_SESSION['formMsg']="Invalid Username";
        header('location:../index.php');
        exit();

    } elseif (strlen($_POST['userName']) > 55) {
        $_SESSION['formMsg']="Invalid Username Length";
        header('location:../index.php');
        exit();
    }
    $object->setUserName($_POST['userName']);

    // validate email
    if (!filter_var($_POST['userEmail'], FILTER_VALIDATE_EMAIL) || !preg_match('/^[a-zA-Z0-9@.]*$/', $_POST['userEmail'])) {
        $_SESSION['formMsg']="Invalid Email";
        header('location:../index.php');
        exit();

    } elseif (strlen($_POST['userEmail']) > 55) {
        $_SESSION['formMsg']="Invalid Email Length";
        header('location:../index.php');
        exit();
    }
        $object->setEmail($_POST['userEmail']);

    // check if password and re-password match
    if (!preg_match('/^[a-zA-Z0-9@.]*$/', $_POST['userPwd'])) {
        $_SESSION['formMsg']="Invalid Password";
        header('location:../index.php');
        exit();

    } elseif (strlen($_POST['userPwd']) > 55) {
        $_SESSION['formMsg']="Invalid Password Length";
        header('location:../index.php');
        exit();

    } elseif (!preg_match('/^[a-zA-Z0-9@.]*$/', $_POST['reUserPwd'])) {
        $_SESSION['formMsg']="Invalid Confirm Password";
        header('location:../index.php');
        exit();

    } elseif ($_POST['userPwd'] != $_POST['reUserPwd']) {
        $_SESSION['formMsg']="Password did`nt match";
        header('location:../index.php');
        exit();

    } elseif ($_POST['userPwd'] == $_POST['reUserPwd']) {
        $object->setPassword($_POST['userPwd']);
        $object->verifyAcct();
        $object->registerAcct();

    } else {
        $_SESSION['formMsg']="Something went wrong, please try again";
        header('location:../index.php');
        exit();
    }

    break;

    /****************************
              LOGIN
    ****************************/
  case 'login':
  // validate csrf
  if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
      $_SESSION['formMsg']="Something went wrong, please close the browser then try again.";
      header('location:../index.php');
      exit();
  }

  if (empty($_POST['userName']) || empty($_POST['userPwd'])) {
      $_SESSION['formMsg']="All inputs are required";
      header('location:../index.php');
      exit();
  }

  $object = new Accounts($DB_conn);
  $object->login($_POST['userName'], $_POST['userPwd']);
    break;

    /****************************
            FORGOT PASSWORD
    ****************************/
    case 'forgot':
    //validate csrf
      if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
          $_SESSION['formMsg']="Something went wrong, please close the browser then try again.";
          header('location:../index.php');
          exit();
      }
      $object = new Accounts($DB_conn);

      if (!filter_var($_POST['userEmail'], FILTER_VALIDATE_EMAIL) || !preg_match('/^[a-zA-Z0-9@.]*$/', $_POST['userEmail'])) {
          $_SESSION['formMsg']="Invalid User Email";
          header('location:../index.php');
          exit();
      }
        $object->checkEmail($_POST['userEmail']);
      break;

      /****************************
              CHANGE PASSWORD
      ****************************/
      case 'update':
      //validate csrf
        if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $_SESSION['formMsg']="Something went wrong, please close the browser then try again.";
            header('location:../index.php');
            exit();
        }

        if (empty($_POST['oldUserPwd']) || empty($_POST['userPwd']) || empty($_POST['reUserPwd'])) {
            $_SESSION['formMsg']="All inputs are required.";
            header('location:../index.php');
            exit();
        }
        $object = new Accounts($DB_conn);
        $object->setPassword($_POST['oldUserPwd']);
        $object->verifyPwd($_POST['userName']);

        if (!preg_match('/^[a-zA-Z0-9@.]*$/', $_POST['userPwd'])) {
            $_SESSION['formMsg']="Invalid Password.";
            header('location:../index.php');
            exit();

        } elseif (!preg_match('/^[a-zA-Z0-9@.]*$/', $_POST['reUserPwd'])) {
            $_SESSION['formMsg']="Invalid Confirm Password.";
            header('location:../index.php');
            exit();
        } elseif ($_POST['userPwd'] != $_POST['reUserPwd']) {
            $_SESSION['formMsg']="Password did`nt match.";
            header('location:../index.php');
            exit();

        } elseif ($_POST['userPwd'] == $_POST['reUserPwd']) {
            $object->setPassword($_POST['userPwd']);
            $object->updatePassword($_POST['userName']);

        } else {
            $_SESSION['formMsg']="Something went wrong, please try again";
            header('location:../index.php');
            exit();
        }
        break;

        /****************************
                DELETE ACCOUNT
        ****************************/
        case 'delete':
        //validate csrf
        $object = new Accounts($DB_conn);
        if (empty($_POST['csrf_token']) || ($_POST['csrf_token'] !== $_SESSION['csrf_token'])) {
          $_SESSION['formMsg']="Something went wrong, please close the browser then try again.";
            header('location:../index.php');
            exit();

        } elseif (empty($_POST['userName'])) {
            $_SESSION['formMsg']="Something went wrong, please logout and try again.";
            header('location:../index.php');
            exit();

        } elseif ($_POST['userName'] !== $_SESSION['userName']) {
            $_SESSION['formMsg']="Something went wrong, please logout and try again.";
            header('location:../index.php');
            exit();
        }
        $object->delete($_POST['userName']);
        break;

      default:
      header('location:../404.html');
        break;
}
