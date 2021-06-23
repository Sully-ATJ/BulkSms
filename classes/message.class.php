<?php

    Class Message extends Dbh{

        public function createMessageAdmin($alphanumeric, $listId , $message, $delivery_date, $delivery_time){
            
            $sql = "INSERT INTO messages(list_id, alphanumeric_id, sms_content, sms_delivery_date, sms_delivery_time, sms_status) VALUES (?,?,?,?,?,?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$listId, $alphanumeric, $message, $delivery_date, $delivery_time, "Cleared"]);

        }

        public function createMessage($alphanumeric, $listId , $message, $delivery_date, $delivery_time){
            
            $sql = "INSERT INTO messages(list_id, alphanumeric_id, sms_content, sms_delivery_date, sms_delivery_time, sms_status) VALUES (?,?,?,?,?,?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$listId, $alphanumeric, $message, $delivery_date, $delivery_time, "Pending"]);

        }

        public function createSpecialMessageAdmin($alphanumeric,$listId, $recipientId , $message, $delivery_date, $delivery_time){
            
            $sql = "INSERT INTO special_messages(list_id, recipient_id, alphanumeric_id, sms_content, sms_delivery_date, sms_delivery_time, sms_status) VALUES (?,?,?,?,?,?,?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$listId, $recipientId, $alphanumeric, $message, $delivery_date, $delivery_time, "Cleared"]);

        }

        public function createSpecialMessage($alphanumeric, $listId, $recipientId , $message, $delivery_date, $delivery_time){
            
            $sql = "INSERT INTO special_messages(list_id, recipient_id, alphanumeric_id, sms_content, sms_delivery_date, sms_delivery_time, sms_status) VALUES (?,?,?,?,?,?,?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$listId, $recipientId, $alphanumeric, $message, $delivery_date, $delivery_time, "Pending"]);

        }

        public function getMessagesToCancel(){

            $sql = "SELECT * FROM messages WHERE sms_status=? OR sms_status=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(["Cleared","Approved"]);


            while($row= $stmt->fetch()){
                echo "<div class='sms-info'>
                        <h4>Sms id:" .$row['sms_id']. "</h4>
                        <h6>Alphanumeric:".$row['alphanumeric_id']. "</h6>
                        <label>Bul Message</label>
                        <h6>Recipient Group:".$row['list_id']. "</h6>
                        <h6>Content:" .$row['sms_content']."</h6>
                        <h6>Delivery Date:" .$row['sms_delivery_date']."</h6>
                        <h6>Delivery Time:" .$row['sms_delivery_time']."</h6>
                        <h6>Status:" .$row['sms_status']."</h6>
                        <a class='Btn cancelBtn' href='includes/actionBtn/cancelMessage.inc.php?id=".$row['sms_id']."'>Cancel Message?</a>
                    </div>";
            } 
            
        }

        public function getMessagesToCancelClient($id){

            //join the messages and recipient tables on list_id  and sms_status = "Pending" or "Approved"
            $sql = "SELECT * FROM recipient_lists INNER JOIN messages ON ((recipient_lists.list_id = messages.list_id) AND (recipient_lists.company_id = ?) AND(sms_status=? OR sms_status=? OR sms_status=?));";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id,"Pending","Approved","Cleared"]);


            while($row= $stmt->fetch()){
                echo "<div class='sms-info'>
                        <h3>Sms id:" .$row['sms_id']. "</h3>
                        <label>Alphanumeric:".$row['alphanumeric_id']. "</label>
                        <label>Bulk Message</label>
                        <label>Recipient Group:".$row['list_id']. "</label>
                        <label>Content:" .$row['sms_content']."</label>
                        <label>Delivery Date:" .$row['sms_delivery_date']."</label>
                        <label>Delivery Time:" .$row['sms_delivery_time']."</label>
                        <label>Status:" .$row['sms_status']."</label>
                        <a class='Btn cancelBtn' href='includes/actionBtn/cancelMessage.inc.php?id=".$row['sms_id']."'>Cancel Message?</a>
                    </div>";
            }
            
            $sql = "SELECT * FROM recipient_lists INNER JOIN special_messages ON ((recipient_lists.list_id = special_messages.list_id) AND (recipient_lists.company_id = ?) AND(sms_status=? OR sms_status=? OR sms_status=?));";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id,"Pending","Approved","Cleared"]);


            while($row= $stmt->fetch()){
                echo "<div class='sms-info'>
                        <h3>Sms id:" .$row['sms_id']. "</h3>
                        <label>Alphanumeric:".$row['alphanumeric_id']. "</label>
                        <label>Special Message</label>
                        <label>Recipient Group:".$row['list_id']. "</label>
                        <label>Content:" .$row['sms_content']."</label>
                        <label>Delivery Date:" .$row['sms_delivery_date']."</label>
                        <label>Delivery Time:" .$row['sms_delivery_time']."</label>
                        <label>Status:" .$row['sms_status']."</label>
                        <a class='Btn cancelBtn' href='includes/actionBtn/cancelMessage.inc.php?id=".$row['sms_id']."'>Cancel Message?</a>
                    </div>";
            }
        }

        public function getMessagesToApproveClient($id){

            //join the messages and recipient tables on list_id  and sms_status = "Pending"
            $sql = "SELECT * FROM recipient_lists INNER JOIN messages ON ((recipient_lists.list_id = messages.list_id) AND (recipient_lists.company_id = ?) AND(sms_status=?));";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id,"Pending"]);


            while($row= $stmt->fetch()){
                echo "<div class='sms-info'>
                <h3>Sms id:" .$row['sms_id']. "</h3>
                <label>Alphanumeric:".$row['alphanumeric_id']. "</label>
                <label>Bulk Message</label>
                <label>Recipient Group:".$row['list_id']. "</label>
                <label>Content:" .$row['sms_content']."</label>
                <label>Delivery Date:" .$row['sms_delivery_date']."</label>
                <label>Delivery Time:" .$row['sms_delivery_time']."</label>
                <label>Status:" .$row['sms_status']."</label>
                <a class='Btn approveBtn' href='includes/actionBtn/approveMessage.inc.php?id=".$row['sms_id']."'>Clear Message?</a>
                <a class='Btn cancelBtn' href='includes/actionBtn/cancelMessage.inc.php?id=".$row['sms_id']."'>Cancel Message?</a>
            </div>";
            } 

            $sql = "SELECT * FROM recipient_lists INNER JOIN special_messages ON ((recipient_lists.list_id = special_messages.list_id) AND (recipient_lists.company_id = ?) AND(sms_status=?));";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id,"Pending"]);
            
            while($row= $stmt->fetch()){
                echo "<div class='sms-info'>
                <h3>Sms id:" .$row['sms_id']. "</h3>
                <label>Alphanumeric:".$row['alphanumeric_id']. "</label>
                <label>Special Message</label>
                <label>Recipient Group:".$row['list_id']. "</label>
                <label>Content:" .$row['sms_content']."</label>
                <label>Delivery Date:" .$row['sms_delivery_date']."</label>
                <label>Delivery Time:" .$row['sms_delivery_time']."</label>
                <label>Status:" .$row['sms_status']."</label>
                <a class='Btn approveBtn' href='includes/actionBtn/approveSpecialMessage.inc.php?id=".$row['sms_id']."'>Clear Message?</a>
                <a class='Btn cancelBtn' href='includes/actionBtn/cancelSpecialMessage.inc.php?id=".$row['sms_id']."'>Cancel Message?</a>
            </div>";
            } 
            
        }

        public function getMessagesToApprove(){

            $sql = "SELECT * FROM messages WHERE sms_status=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(["Cleared"]);


            while($row= $stmt->fetch()){
                echo "<div class='sms-info'>
                        <h3>Sms id:" .$row['sms_id']. "</h3>
                        <label>Alphanumeric:".$row['alphanumeric_id']. "</label>
                        <label>Bulk Message</label>
                        <label>Recipient Group:".$row['list_id']. "</label>
                        <label>Content:" .$row['sms_content']."</label>
                        <label>Delivery Date:" .$row['sms_delivery_date']."</label>
                        <label>Delivery Time:" .$row['sms_delivery_time']."</label>
                        <label>Status:" .$row['sms_status']."</label>
                        <a class='Btn approveBtn' href='includes/actionBtn/approveMessage.inc.php?id=".$row['sms_id']."'>Approve Message?</a>
                        <a class='Btn cancelBtn' href='includes/actionBtn/cancelMessage.inc.php?id=".$row['sms_id']."'>Cancel Message?</a>
                    </div>";
            }  

            $sql = "SELECT * FROM special_messages WHERE sms_status=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(["Cleared"]);


            while($row= $stmt->fetch()){
                echo "<div class='sms-info'>
                        <h3>Sms id:" .$row['sms_id']. "</h3>
                        <label>Alphanumeric:".$row['alphanumeric_id']. "</label>
                        <label>Special Message</label>
                        <label>Recipient Group:".$row['list_id']. "</label>
                        <label>Content:" .$row['sms_content']."</label>
                        <label>Delivery Date:" .$row['sms_delivery_date']."</label>
                        <label>Delivery Time:" .$row['sms_delivery_time']."</label>
                        <label>Status:" .$row['sms_status']."</label>
                        <a class='Btn approveBtn' href='includes/actionBtn/approveSpecialMessage.inc.php?id=".$row['sms_id']."'>Approve Message?</a>
                        <a class='Btn cancelBtn' href='includes/actionBtn/cancelSpecialMessage.inc.php?id=".$row['sms_id']."'>Cancel Message?</a>
                    </div>";
            }
        }


        public function deleteMessage($id){
            $sql = "DELETE FROM messages WHERE sms_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);
        }

        public function deleteSpecialMessage($id){
            $sql = "DELETE FROM special_messages WHERE sms_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);
        }

        public function approveMessage($id){
            $sql = "UPDATE messages SET sms_status=? WHERE sms_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(["Approved",$id]);
        }

        public function approveSpecialMessage($id){
            $sql = "UPDATE special_messages SET sms_status=? WHERE sms_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(["Approved",$id]);
        }

        public function clearMessage($id){
            $sql = "UPDATE messages SET sms_status=? WHERE sms_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(["Cleared",$id]);
        }

        public function clearSpecialMessage($id){
            $sql = "UPDATE special_messages SET sms_status=? WHERE sms_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(["Cleared",$id]);
        }
    }