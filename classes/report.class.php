<?php

    class Report extends Dbh{

        public function displayReports(){
            $sql = "SELECT * FROM reports";
            $stmt = $this->connect()->query($sql);
            while ($row = $stmt->fetch()) {
                echo "<div class='report container'>
                        <h4>Sms id:" .$row['sms_id']. "</h4>
                        <label>Type: Bulk Message</label>
                        <label>Sms delivery Status:".$row['report_sms_status']. "</label>
                        <label>Sms Delivery details:" .$row['report_details']."</label>
                    </div>";
            }
        }

        public function displaySpecialReports(){
            $sql = "SELECT * FROM special_reports";
            $stmt = $this->connect()->query($sql);
            while ($row = $stmt->fetch()) {
                echo "<div class='report container'>
                        <h4>Sms id:" .$row['sms_id']. "</h4>
                        <label>Type: Special Message</label>
                        <label>Sms delivery Status:".$row['report_sms_status']. "</label>
                        <label>Sms Delivery details:" .$row['report_details']."</label>
                    </div>";
            }
        }

    }