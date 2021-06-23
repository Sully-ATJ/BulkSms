<?php
    include 'includes/class-autoload.inc.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    

    <link rel="stylesheet" href="Css/platformadmin.css">
    <script src="Js/platformadmin.js" type="text/javascript"></script>

    <title>Platform Admin</title>
</head>
<body>
    <div class="navBar">
        <a href="index.php">LOGO</a>
            <?php

                if(isset($_SESSION["userId"])){
                    
                    $cid = $_SESSION["companyId"];
                    echo "<div class='dropdown'>
                        <button class='dropbtn'>".$_SESSION["fname"]. " ".$_SESSION["lname"]."
                            <i class='fa fa-caret-down'></i>
                        </button>
                        <div class='dropdown-content'>
                            <a href='includes/logout.inc.php'> Log out</a>
                        </div>
                    </div>";
                }
            ?>
    </div>
    <div class="page-content">

        <ul id="tabs" class="tabs">
            <li><a id="approveMsg" class="tab-link" >Approve Message</a></li>
            <hr>
            <li><a id="topCredit" class="tab-link" >Credit Top-Up</a></li>
            <li><a id="createCompany" class="tab-link" >Company</a></li>
            <hr>
            <li><a id="createCAU" class="tab-link" >Create Client Admin User</a></li>
            <hr>
            <li><a id="manageBlocked" class="tab-link">Manage Blocked List</a></li>
            <hr>
            <li><a id="setting" class="tab-link">Settings</a></li>
        </ul>

        <!--Tab contents-->
        <div class="tabcontent">
            <div id="approveMsgC" class="tab-content">
                <?php
                    $msg = new Message();
                    $msg->getMessagesToApprove();
                ?>
            </div>

            <div id="topCreditC" class="tab-content">
                <h4>Credit Top UP</h4>
                <form action="includes/add/addCreditPA.inc.php" method="post">
                    <div class="form-group">
                        <label for="company-id">Select Company:</label>
                        <select name="company-id" id="" required>
                            <option value="">>---Select---<</option>
                            <?php
                                $company = new Company();
                                $company->getAllCompanies();
                            ?>
                        </select>
                    </div>
                    <div class="radio-options">
                        <input  type="radio" name="credit" id="credit-1" value="500" checked>
                        <label class="credit-label" for="credit-1">
                            <span data-hover="500TL">500Sms<br><hr>500TL</span>
                        </label>
                        <input  type="radio" name="credit" id="credit-2" value="950">
                        <label class="credit-label" for="credit-2">
                            <span data-hover="1000TL">1000Sms<br><hr>950TL</span>
                        </label>
                        <input  type="radio" name="credit" id="credit-3" value="1400">
                        <label class="credit-label" for="credit-3">
                            <span data-hover="1500TL">1500Sms<br><hr>1400TL</span>
                        </label>
                        <input  type="radio" name="credit" id="credit-4" value="1850">
                        <label class="credit-label" for="credit-4">
                            <span data-hover="1850TL">2000Sms<br><hr>1850TL</span>
                        </label>
                        <input  type="radio" name="credit" id="credit-5" value="2300">
                        <label class="credit-label" for="credit-5">
                            <span data-hover="1850TL">2500Sms<br><hr>2300TL</span>
                        </label>
                        <input  type="radio" name="credit" id="credit-6" value="2750">
                        <label class="credit-label" for="credit-6">
                            <span data-hover="1850TL">3000Sms<br><hr>2750TL</span>
                        </label>
                        <input  type="radio" name="credit" id="credit-7" value="3250">
                        <label class="credit-label" for="credit-7">
                            <span data-hover="1850TL">3500Sms<br><hr>3250TL</span>
                        </label>
                        <input  type="radio" name="credit" id="credit-8" value="3700">
                        <label class="credit-label" for="credit-8">
                            <span data-hover="1850TL">4000Sms<br><hr>3700TL</span>
                        </label>
                    </div>
                    <button type="submit" name="add-credit" class="Btn submitBtn">Submit</button>
                </form>
            </div>

            <div id="createCompanyC" class="tab-content">
                <form action="includes/add/addAlphanumeric.inc.php" method="post">
                    <h4>Add Alphanumeric to Company</h4>
                    <div class="form-group">
                        <label for="company-id">Select Company:</label>
                        <select name="company-id" id="" required>
                            <option value="">>---Select---<</option>
                            <?php
                                $company = new Company();
                                $company->getAllCompanies();
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alphanumeric">Company Alphanumeric: </label>
                        <input type="text" class="form-input" name="alphanumeric" placeholder="ABCCO" required>
                        <small id="help" class="form-text text-muted">Enter the Company's Alphanumeric *11 characters MAX!*</small>
                    </div>
                    <button type="submit" name="add-alphanumeric" class="Btn submitBtn">Submit</button>
                </form>
                <form action="includes/create/company.inc.php" method="post">
                    <h4>Create Company</h4>
                    <div class="form-group">
                        <label for="company-title">Company title: </label>
                        <input type="text" class="form-input" name="company-title" placeholder="ABC LIMITED" required>
                        <small id="help" class="form-text text-muted">Enter the company name/title</small>
                    </div>
                    <div class="form-group">
                        <label for="company-email">Company Email: </label>
                        <input type="text" class="form-input" name="company-email" placeholder="info@abc.com" required>
                        <small id="help" class="form-text text-muted">Enter the company email</small>
                    </div>
                    <div class="form-group">
                        <label for="contact-name">Contact Person: </label>
                        <input type="text" class="form-input" name="contact-name" placeholder="John Smith" required>
                        <small id="help" class="form-text text-muted">Enter the full name of the contact person at the company</small>
                    </div>
                    <div class="form-group">
                        <label for="company-phoneNo">Company Phone Number: </label>
                        <input type="text" class="form-input" name="company-phoneNo" placeholder="0344 667 7898" required>
                        <small id="help" class="form-text text-muted">Enter the phone number of the company</small>
                    </div>
                    <div class="form-group">
                        <label for="address">Enter Company's Address: </label>
                        <textarea name="address" cols="40" rows="5" required></textarea>
                        <small id="help" class="form-text text-muted">Enter the Company address</small>
                    </div>
                    <div class="form-group">
                        <label for="credit">Company Credit </label>
                        <input type="number" class="form-input" name="credit" min="0" required>
                        <small id="help" class="form-text text-muted">Enter the starting credit for the company</small>
                    </div>
                    <div class="form-group">
                        <label for="alphanumeric">Company Alphanumeric: </label>
                        <input type="text" class="form-input" name="alphanumeric" placeholder="ABCCO" required>
                        <small id="help" class="form-text text-muted">Enter the Company's Alphanumeric *11 characters MAX!*</small>
                    </div>
                    <button type="submit" name="create-company" class="Btn submitBtn">Submit</button>
                </form>
            </div>

            <div id="createCAUC" class="tab-content">
                <form action="includes/create/createClientAdmin.inc.php" method="post">
                    <h4>Create Client Admin</h4>
                    <div class="form-group">
                        <label for="company-id">Select Company:</label>
                        <select name="company-id" id="" required>
                            <option value="">>---Select---<</option>
                            <?php
                                $listObj = new Company();
                                $listObj->getAllCompanies();
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id">Enter ID: </label>
                        <input type="text" class="form-input" name="id" placeholder="36727889" required>
                        <small id="help" class="form-text text-muted">Enter the users id</small>
                    </div>
                    <div class="form-group">
                        <label for="fname">Enter First name: </label>
                        <input type="text" class="form-input" name="fname" placeholder="John" required>
                        <small id="help" class="form-text text-muted">Enter the first name</small>
                    </div>
                    <div class="form-group">
                        <label for="lname">Enter Last name: </label>
                        <input type="text" class="form-input"  name="lname" placeholder="Smith" required>
                        <small id="help" class="form-text text-muted">Enter the last name</small>
                    </div>
                    <div class="form-group">
                        <label for="username">Enter Username: </label>
                        <input type="text" class="form-input" name="username" placeholder="jsmith" required>
                        <small id="help" class="form-text text-muted">Enter the username</small>
                    </div>
                    <div class="form-group">
                        <label for="email">Enter Email: </label>
                        <input type="text" class="form-input" name="email" placeholder="" required>
                        <small id="help" class="form-text text-muted">Enter the email</small>
                    </div>
                    <div class="form-group">
                        <label for="address">Enter Address: </label>
                        <textarea name="address" cols="40" rows="5" required></textarea>
                        <small id="help" class="form-text text-muted">Enter the address</small>
                    </div>
                    <button type="submit" name="create-admin" class="Btn submitBtn">Submit</button>
                </form>
            </div>

            <div id="manageBlockedC" class="tab-content">
                <?php
                    $req = new Smslist();
                    $req->getAllBlockRequests();
                ?>
            </div>

            <div id="settingC" class="tab-content">
                <form action="includes/update/changePassword.inc.php" method="post">
                    <h4>Change Password</h4>
                    <?php
                        echo '<input type="hidden" name="id" value="'.$_SESSION['userId'].'">';
                    ?>
                    <div class="form-group">
                        <label for="new-pwd">Enter New Password: </label>
                        <input type="password" class="form-input" name="new-pwd" required>
                    </div>
                    <div class="form-group">
                        <label for="rep-pwd">Repeat New Password: </label>
                        <input type="password" class="form-input" name="rep-pwd" required>
                    </div>
                    <button type="submit" name="change-pwd" class="Btn submitBtn">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>