<?php

    Class Smslist extends Dbh{

        //remember to update to add the company id from sessions
        public function createList($listName, $companyId){

            $sql = "INSERT INTO recipient_lists(company_id, list_name) VALUES (?,?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$companyId, $listName]);

            
        }

        public function addToList($listId, $fname, $lname, $phoneNo, $email, $address, $dob){

            $sql = "INSERT INTO recipients(list_id, recipient_first_name, recipient_last_name, recipient_phone_no, recipient_email, recipient_address, recipient_dob, recipient_status) VALUES (?,?,?,?,?,?,?,?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$listId, $fname, $lname, $phoneNo, $email, $address, $dob, "valid"]);
            
        }

        public function getAllLists($id){

            $sql = "SELECT * from recipient_lists WHERE company_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);
            while ($row = $stmt->fetch()) {
                echo "<option value=". $row['list_id'].">
                        " .$row['list_name']. "        
                    </option>";
            }
        }

        public function getAllBlockRequests(){
            $sql = "SELECT block_list.block_list_id, recipients.recipient_id, block_list.alphanumeric, recipients.recipient_first_name,recipients.recipient_last_name, recipients.recipient_status 
            from block_list 
            INNER JOIN recipients ON ((block_list.phone_no = recipients.recipient_phone_no) AND (block_list.request_status = ?))
            INNER JOIN company_alphanumerics ON block_list.alphanumeric = company_alphanumerics.alphanumeric
            INNER JOIN recipient_lists ON recipients.list_id = recipient_lists.list_id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(["Pending"]);

            while($row= $stmt->fetch()){
                echo "<div class='block-req'>
                    <label>Block Request</label>
                    <label>Alphanumeric:".$row['alphanumeric']. "</label>
                    <label>Requester Name:".$row['recipient_first_name']. " " .$row['recipient_last_name']."</label>
                    <label>Requesting to not receives messages from this alphanumeric anymore</label>
                    <a class='Btn cancelBtn' href='includes/actionBtn/blockRequest.inc.php?id=".$row['recipient_id']."&bid=".$row['block_list_id']."'>Approve Request?</a>
                    </div>";
            } 

        }

        public function blockAlphanumeric($id, $bid){
            $sql = "UPDATE block_list SET request_status=? WHERE block_list_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(["Resolved",$bid]);

            $sql = "UPDATE recipients SET recipient_status=? WHERE recipient_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(["Blocked",$id]);
        }
    }