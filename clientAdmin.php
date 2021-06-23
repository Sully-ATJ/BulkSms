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

    <link rel="stylesheet" type="text/css" href="Css/clientadmin.css">
    <script src="Js/clientadmin.js" type="text/javascript"></script>
    <title>Client Platform</title>
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
                            <a>Company ID:". $cid ."</a>
                            <a href='includes/logout.inc.php'> Log out</a>
                        </div>
                    </div>";
                    $credit = new Company();
                    $credit->getCompanyCredit($_SESSION["companyId"]);
                }
            ?>
    </div>
    <div class="page-content">
        <!-- left side tab menu-->
        
        <ul id="tabs" class="tabs">
            
            <li><a class="tab-link" id="message" >Create Message</a></li>
            <li><a class="tab-link" id="msgCancel" >Cancel Message</a></li>
            <hr>

            
            <li><a class="tab-link" id="creditTopUp" >Credit Top Up</a></li>
            <hr>
            
            <li><a class="tab-link" id="addSubUser">Sub-Users</a></li>
            <li><a class="tab-link" id="approveMsg" >Approve Users Message</a></li>
            <hr>
            
            <li><a class="tab-link" id="list" >Recipient Lists</a></li>
            <hr>
            
            <li><a class="tab-link"  id="report" >Read Reports</a></li>
            <hr>
            <li><a class="tab-link" id="setting">Settings</a></li> 
        </ul>
        
        <!--Tab contents-->
        <div class="tabcontent">

            <!-- ---------------Create message tab--------------- -->
            <div id="messageC" class="tab-page">
                <form action="includes/create/message.inc.php" method="POST">
                    <h5>Create Bulk Message</h5>
                    <div class="form-group">
                        <label for="alphanumeric">Select Alphanumeric: </label>
                        <select name="alphanumeric" id="" required>
                            <option value="">>---Select---<</option>
                            <?php
                                $company = new Company();
                                $company->getCompanyAlphanumerics($_SESSION["companyId"]);
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="list-name">Select Recipient List:</label>
                        <select name="list-Id" id="" required>
                            <option value="">>---Select---<</option>
                            <?php
                                $listObj = new Smslist();
                                $listObj->getAllLists($_SESSION["companyId"]);
                            ?>
                        </select>
                        
                    </div>
                    <div class="form-group">
                        <label for="message">SMS Content</label>
                        <textarea name="message" id="message" cols="40" rows="5" required></textarea>
                        <small id="help" class="form-text text-muted">This is the SMS content.</small>
                    </div>
                    <div class="form-group">
                        <label for="delivery_date">Delivery Date</label>
                        <input type="date" class="form-input"  name="delivery_date" required>
                        <small id="help" class="form-text text-muted">Format: DD-MM-YYYY</small>
                    </div>
                    <div class="form-group">
                        <label for="delivery_time">Delivery time</label>
                        <input type="time" class="form-input"  name="delivery_time" required>
                        <small id="help" class="form-text text-muted">Format: HH:MM</small>
                    </div>
                    <button type="submit" name="create-message" class="Btn submitBtn">Submit</button>
                </form>
                <form action="includes/create/specialMessages.inc.php" method="post">
                    <h5>Create Special message</h5>
                    <div class="form-group">
                        <label for="alphanumeric">Select Alphanumeric: </label>
                        <select name="alphanumeric" id="" required>
                            <option value="">>---Select---<</option>
                            <?php
                                $company = new Company();
                                $company->getCompanyAlphanumerics($_SESSION["companyId"]);
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="list-Id">Select Recipient List:</label>
                        <select name="list-Id" id="" required>
                            <option value="">>---Select---<</option>
                            <?php
                                $listObj = new Smslist();
                                $listObj->getAllLists($_SESSION["companyId"]);
                            ?>
                        </select>
                        
                    </div>
                    <div class="form-group">
                        <label for="message">SMS Content</label>
                        <textarea name="message" id="message" cols="40" rows="5" required></textarea>
                        <small id="help" class="form-text text-muted">This is the SMS content.</small>
                    </div>
                    <button type="submit" name="create-special-message" class="Btn submitBtn">Submit</button>
                </form>
            </div>

            <!-- ---------------Cancel message tab--------------- -->
            <div id="msgCancelC" class="tab-page">
                <?php
                    //add session information so it displays only this companies messages
                    $msg = new Message();
                    $msg->getMessagesToCancelClient($_SESSION["companyId"]);

                ?>
            </div>

            <!-- ----------------Credit Top up Tab--------------- -->
            <div id="creditTopUpC"  class="tab-page">
                <h4>Credit Top UP</h4>
                <form action="includes/add/addCreditCA.inc.php" method="post">
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

            <!-- ----------------Sub-Users tab---------------- -->
            <div id="addSubUserC"  class="tab-page">
                <form action="includes/update/updateUserAlphanumeric.inc.php" method="post">
                    <h4>Reassign User Alphanumeric</h4>
                    <div class="form-group">
                        <label for="user-id">Select Sub User:</label>
                        <select name="user-id" id="" required>
                            <option value="">>---Select---<</option>
                            <?php
                                $listObj = new Users();
                                $listObj->getAllSubUsers($_SESSION["companyId"]);
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="alphanumeric">Select Alphanumeric: </label>
                        <select name="alphanumeric" id="" required>
                            <option value="">>---Select---<</option>
                            <?php
                                $company = new Company();
                                $company->getCompanyAlphanumerics($_SESSION["companyId"]);
                            ?>
                        </select>
                    </div>
                    <button type="submit" name="sub-user-alpha" class="Btn submitBtn">Submit</button>
                </form>
                <form action="includes/create/createSubUsers.inc.php" method="post">
                    <h4>Create Sub-User</h4>
                    <div class="form-group">
                        <label for="id">Enter ID: </label>
                        <input type="text" class="form-input" name="id" placeholder="6738221" required>
                        <small id="help" class="form-text text-muted">Enter the users id</small>
                    </div>
                    <div class="form-group">
                        <label for="alphanumeric">Assign Alphanumeric to User: </label>
                        <select name="alphanumeric" id="" required>
                            <option value="">>---Select---<</option>
                            <?php
                                $company = new Company();
                                $company->getCompanyAlphanumerics($_SESSION["companyId"]);
                            ?>
                        </select>
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

            <!-- ----------------Approve Messages---------------- -->
            <div id="approveMsgC" class="tab-page">
                <?php
                    $msg = new Message();
                    $msg->getMessagesToApproveClient($_SESSION["companyId"]);
                ?>
            </div>

            <!-- ---------------Create List tab--------------- -->
            <div id="listC"  class="tab-page">
                <form action="includes/create/createList.inc.php" method="post">
                    <h4>Create New List</h4>
                    <div class="form-group">
                        <label for="list-name">Enter List name: </label>
                        <input type="text" class="form-input" name="list-name" placeholder="Group1" required>
                        <small id="help" class="form-text text-muted">This is the name of the list</small>
                    </div>
                    
                    <button type="submit" name="create-list" class="Btn submitBtn">Submit</button>
                </form>
                <form action="includes/update/updateList.inc.php" method="post">
                    <h4>Add To List</h4>
                    <div class="form-group">
                        <label for="list-id">Select Recipient List:</label>
                        <select name="list-id" id="" required>
                            <option value="">>---Select---<</option>
                            <?php
                                $listObj = new Smslist();
                                $listObj->getAllLists($_SESSION["companyId"]);
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fname">Customer's First name: </label>
                        <input type="text" class="form-input" name="fname" placeholder="John" required>
                        <small id="help" class="form-text text-muted">Enter the first name</small>
                    </div>
                    <div class="form-group">
                        <label for="lname">Customer's Last name: </label>
                        <input type="text" class="form-input"  name="lname" placeholder="Smith" required>
                        <small id="help" class="form-text text-muted">Enter the last name</small>
                    </div>
                    <div class="form-group">
                        <label for="phone-no">Enter Customer's number:</label>
                        <input type="text" class="form-input" name="phone-no" placeholder="0533 456 8322" required>
                        <small id="help" class="form-text text-muted">Enter the phone number</small>
                    </div>
                    <div class="form-group">
                        <label for="email">Enter Customer's Email: </label>
                        <input type="email" class="form-input" name="email" placeholder="" required>
                        <small id="help" class="form-text text-muted">Enter the email</small>
                    </div>
                    <div class="form-group">
                        <label for="address">Enter Customer's Address: </label>
                        <textarea name="address" cols="40" rows="5" required></textarea>
                        <small id="help" class="form-text text-muted">Enter the address:</small>
                    </div>
                    <div class="form-group">
                        <label for="date-of-birth">Date Of Birth:</label>
                        <input type="date" class="form-input"  name="date-of-birth" required>
                        <small id="help" class="form-text text-muted">Format: DD-MM-YYYY</small>
                    </div>
                    <button type="submit" name="add-Tolist" class="Btn submitBtn">Submit</button>
                </form>
            </div>

            <!-- ---------------Reports tab--------------- -->
            <div id="reportC"  class="tab-page">
                <h4>Reports</h4>
                <?php
                    $reports = new Report();
                    $reports->displayReports();
                    $reports->displaySpecialReports();
                ?>
                
            </div>

            <!-- ---------------Settings tab--------------- -->
            <div id="settingC" class="tab-page">
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