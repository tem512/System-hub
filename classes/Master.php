<?php

require_once('../config.php');
require_once '../pdf.php';

Class Master extends DBConnection {

    private $settings;

    public function __construct() {
        global $_settings;
        $this->settings = $_settings;
        parent::__construct();
    }

    public function __destruct() {
        parent::__destruct();
    }

    function capture_err() {
        if (!$this->conn->error)
            return false;
        else {
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
            return json_encode($resp);
            exit;
        }
    }

    function save_service() {
        $_POST['description'] = htmlentities($_POST['description']);
        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('id'))) {
                if (!is_numeric($v))
                    $v = $this->conn->real_escape_string($v);
                if (!empty($data))
                    $data .= ",";
                $data .= " `{$k}`='{$v}' ";
            }
        }
        if (empty($id)) {
            $sql = "INSERT INTO `service_list` set {$data} ";
        } else {
            $sql = "UPDATE `service_list` set {$data} where id = '{$id}' ";
        }
        $check = $this->conn->query("SELECT * FROM `service_list` where `name`='{$name}' " . ($id > 0 ? " and id != '{$id}'" : ""))->num_rows;
        if ($check > 0) {
            $resp['status'] = 'failed';
            $resp['msg'] = "Service Name Already Exists.";
        } else {
            $save = $this->conn->query($sql);
            if ($save) {
                $rid = !empty($id) ? $id : $this->conn->insert_id;
                $resp['status'] = 'success';
                if (empty($id))
                    $resp['msg'] = "Service details successfully added.";
                else
                    $resp['msg'] = "Service details has been updated successfully.";
            } else {
                $resp['status'] = 'failed';
                $resp['msg'] = "An error occured.";
                $resp['err'] = $this->conn->error . "[{$sql}]";
            }
        }
        if ($resp['status'] == 'success')
            $this->settings->set_flashdata('success', $resp['msg']);
        return json_encode($resp);
    }

    function delete_service() {
        extract($_POST);
        $del = $this->conn->query("DELETE FROM `service_list` where id = '{$id}'");
        if ($del) {
            $resp['status'] = 'success';
            $this->settings->set_flashdata('success', "Service has been deleted successfully.");
        } else {
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);
    }

    function save_babysitter() {
        if (empty($_POST['id'])) {
            $prefix = "BS-" . (date('Ym'));
            $code = sprintf("%'.04d", 1);
            while (true) {
                $check = $this->conn->query("SELECT * FROM babysitter_list where `code` = '{$prefix}{$code}' ")->num_rows;
                if ($check > 0) {
                    $code = sprintf("%'.04d", ceil($code) + 1);
                } else {
                    break;
                }
            }
            $_POST['code'] = "{$prefix}{$code}";
        }
        $_POST['fullname'] = "{$_POST['firstname']} {$_POST['middlename']} {$_POST['lastname']}";
        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (in_array($k, array('code', 'fullname', 'status'))) {
                if (!is_numeric($v))
                    $v = $this->conn->real_escape_string($v);
                if (!empty($data))
                    $data .= ",";
                $data .= " `{$k}`='{$v}' ";
            }
        }
        if (empty($id)) {
            $sql = "INSERT INTO `babysitter_list` set {$data} ";
        } else {
            $sql = "UPDATE `babysitter_list` set {$data} where id = '{$id}' ";
        }
        $check = $this->conn->query("SELECT * FROM `babysitter_details` where `meta_field`='email' and `meta_value`='{$email}' " . ($id > 0 ? " and babysitter_id != '{$id}'" : ""))->num_rows;
        if ($check > 0) {
            $resp['status'] = 'failed';
            $resp['msg'] = "Babysitter's Email Already Exists.";
        } else {
            $save = $this->conn->query($sql);
            if ($save) {
                $bsid = !empty($id) ? $id : $this->conn->insert_id;
                $resp['status'] = 'success';
                if (empty($id))
                    $resp['msg'] = "Babysitter details successfully added.";
                else
                    $resp['msg'] = "Babysitter details has been updated successfully.";
                $data = "";
                foreach ($_POST as $k => $v) {
                    if (!in_array($k, array('id', 'code', 'fullname', 'status'))) {
                        if (!is_numeric($v))
                            $v = $this->conn->real_escape_string($v);
                        if (!empty($data))
                            $data .= ",";
                        $data .= " ('{$bsid}', '{$k}', '{$v}')";
                    }
                }
                if (!empty($data)) {
                    $sql2 = "INSERT INTO `babysitter_details` (`babysitter_id`,`meta_field`,`meta_value`) VALUES {$data}";
                    $this->conn->query("DELETE FROM `babysitter_details` FROM where babysitter_id = '{$bsid}'");
                    $save_meta = $this->conn->query($sql2);
                    if ($save_meta) {
                        $resp['status'] = 'success';
                    } else {
                        $this->conn->query("DELETE FROM `babysitter_list` FROM where id = '{$bsid}'");
                        $resp['status'] = 'failed';
                        $resp['msg'] = "An error occurred while saving the data. Error: " . $this->conn->error;
                    }
                }
                if (isset($_FILES['img']) && $_FILES['img']['tmp_name'] != '') {
                    // $fname = 'uploads/babysitters/' . $bsid . '.png';
                    $fname = 'uploads/babysitters/babysitter-' . $bsid . '.png';
                    $dir_path = base_app . $fname;
                    $upload = $_FILES['img']['tmp_name'];
                    $type = mime_content_type($upload);
                    $allowed = array('image/png', 'image/jpeg');
                    if (!in_array($type, $allowed)) {
                        $resp['msg'] .= " But Image failed to upload due to invalid file type.";
                    } else {
                        $new_height = 200;
                        $new_width = 200;

                        list($width, $height) = getimagesize($upload);
                        $t_image = imagecreatetruecolor($new_width, $new_height);
                        imagealphablending($t_image, false);
                        imagesavealpha($t_image, true);
                        $gdImg = ($type == 'image/png') ? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
                        imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                        if ($gdImg) {
                            if (is_file($dir_path))
                                unlink($dir_path);
                            $uploaded_img = imagepng($t_image, $dir_path);
                            imagedestroy($gdImg);
                            imagedestroy($t_image);
                        } else {
                            $resp['msg'] .= " But Image failed to upload due to unkown reason.";
                        }
                    }
                    if (isset($uploaded_img)) {
                        $this->conn->query("UPDATE babysitter_list set `bs_image` = CONCAT('{$fname}','?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$id}' ");
                        if ($id == $this->settings->userdata('id')) {
                            $this->settings->set_userdata('bs_image', $fname);
                        }
                    }
                }
            } else {
                $resp['status'] = 'failed';
                $resp['msg'] = "An error occured.";
                $resp['err'] = $this->conn->error . "[{$sql}]";
            }
        }
        if ($resp['status'] == 'success')
            $this->settings->set_flashdata('success', $resp['msg']);
        return json_encode($resp);
    }

    function delete_babysitter() {
        extract($_POST);
        $del = $this->conn->query("DELETE FROM `babysitter_list` where id = '{$id}'");
        if ($del) {
            $resp['status'] = 'success';
            $this->settings->set_flashdata('success', "Babysitter has been deleted successfully.");
            if (is_file(base_app . "uploads/babysitters/{$id}.png")) {
                unlink(base_app . "uploads/babysitters/{$id}.png");
            }
        } else {
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);
    }

    function save_enrollment() {
        if (empty($_POST['id'])) {
            $alpha = range("A", "Z");
            shuffle($alpha);
            $prefix = (substr(implode("", $alpha), 0, 3)) . "-" . (date('Ym'));
            $code = sprintf("%'.04d", 1);
            while (true) {
                $check = $this->conn->query("SELECT * FROM enrollment_list where `code` = '{$prefix}{$code}' ")->num_rows;
                if ($check > 0) {
                    $code = sprintf("%'.04d", ceil($code) + 1);
                } else {
                    break;
                }
            }
            $_POST['code'] = "{$prefix}{$code}";
        }
        $_POST['child_fullname'] = "{$_POST['child_firstname']} {$_POST['child_middlename']} {$_POST['child_lastname']}";
        $_POST['parent_fullname'] = "{$_POST['parent_firstname']} {$_POST['parent_middlename']} {$_POST['parent_lastname']}";

        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (in_array($k, array('code', 'child_fullname', 'parent_fullname', 'status', 'astatus'))) {
                if (!is_numeric($v))
                    $v = $this->conn->real_escape_string($v);
                if (!empty($data))
                    $data .= ",";
                $data .= " `{$k}`='{$v}' ";
            }
        }
        if (isset($_POST['parent_id'])) {
            $parent_id = $_POST['parent_id'];
            if (!empty($data))
                $data .= ",";
            $data .= " `parent_id`='{$parent_id}'";
        }

        if (empty($id)) {
            $sql = "INSERT INTO `enrollment_list` set {$data} ";
        } else {
            $sql = "UPDATE `enrollment_list` set {$data} where id = '{$id}' ";
        }

        $save = $this->conn->query($sql);
        if ($save) {
            $eid = !empty($id) ? $id : $this->conn->insert_id;
            $resp['status'] = 'success';
            if (empty($id))
                $resp['msg'] = "Enrollment Details has successfully submitted. Your Enrollment Code is <b>{$code}</b>.";
            else
                $resp['msg'] = "Enrollment details has been updated successfully.";
            $data = "";
            foreach ($_POST as $k => $v) {
                if (!in_array($k, array('id', 'code', 'fullname', 'status'))) {
                    if (!is_numeric($v))
                        $v = $this->conn->real_escape_string($v);
                    if (!empty($data))
                        $data .= ",";
                    $data .= " ('{$eid}', '{$k}', '{$v}')";
                }
            }

            if (isset($_FILES['BCfile'])) {
                $file_name = $_FILES['BCfile']['name'];
                $file_tmp = $_FILES['BCfile']['tmp_name'];
                // $dir_path =base_app. $fname;
                move_uploaded_file($file_tmp, base_app . "uploads/" . $file_name);
                if (!empty($data))
                    $data .= ",";
                $data .= " ('{$eid}', 'BCfile', '{$file_name}')";
            }
            if (isset($_FILES['VCfile'])) {
                $file_name = $_FILES['VCfile']['name'];
                $file_tmp = $_FILES['VCfile']['tmp_name'];
                // $dir_path =base_app. $fname;
                move_uploaded_file($file_tmp, base_app . "uploads/" . $file_name);
                if (!empty($data))
                    $data .= ",";
                $data .= " ('{$eid}', 'VCfile', '{$file_name}')";
            }
            if (!empty($data)) {
                $sql2 = "INSERT INTO `enrollment_details` (`enrollment_id`,`meta_field`,`meta_value`) VALUES {$data}";
                $this->conn->query("DELETE FROM `enrollment_details` FROM where enrollment_id = '{$eid}'");
                $save_meta = $this->conn->query($sql2);
                if ($save_meta) {
                    $resp['status'] = 'success';
                } else {
                    $this->conn->query("DELETE FROM `enrollment_list` FROM where id = '{$eid}'");
                    $resp['status'] = 'failed';
                    $resp['msg'] = "An error occurred while saving the data. Error: " . $this->conn->error;
                }
            }
        } else {
            $resp['status'] = 'failed';
            $resp['msg'] = "An error occured.";
            $resp['err'] = $this->conn->error . "[{$sql}]";
        }
        if ($resp['status'] == 'success' && !empty($id))
            $this->settings->set_flashdata('success', $resp['msg']);
        if ($resp['status'] == 'success' && empty($id))
            $this->settings->set_flashdata('pop_msg', $resp['msg']);
        return json_encode($resp);
    }

    function delete_enrollment() {
        extract($_POST);
        $del = $this->conn->query("DELETE FROM `enrollment_list` where id = '{$id}'");
        if ($del) {
            $resp['status'] = 'success';
            $this->settings->set_flashdata('success', "Enrollment has been deleted successfully.");
        } else {
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);
    }

    function update_status() {
        extract($_POST);
        $update = $this->conn->query("UPDATE `Enrollment_list` set status  = '{$status}',astatus = '{$astatus}' where id = '{$id}'");
        if ($update) {
            $resp['status'] = 'success';
            $resp['msg'] = "Enrollment Status has successfully updated.";
        } else {
            $resp['status'] = 'failed';
            $resp['msg'] = "An error occurred. Error: " . $this->conn->error;
        }
        if ($resp['status'] == 'success')
            $this->settings->set_flashdata('success', $resp['msg']);
        return json_encode($resp);
    }

    function save_health() {
        extract($_POST);
        $sql = $this->conn->query("INSERT INTO `health_list`(caregiver_id,child_id,date_of_recorded,iliness,symptoms,temperature,weight_of_child,parent_id,description)
                VALUES ('{$caregiver_id}','{$child_fullname}','{$date}','{$iliness}','{$symptoms}','{$temperature}','{$weight}','{$parent_id}','{$description}')");
        if ($sql) {
            $resp['status'] = 'success';
            $this->settings->set_flashdata('success', "Health information has been save successfully.");
        } else {
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);
    }

    function uppdate_health() {
        extract($_POST);
        $update = $this->conn->query("UPDATE `health_list` SET `child_id` = '{$child_fullname}', `iliness` = '{$iliness}',
        `symptoms` = '{$symptoms}',`temperature` = '{$temperature}',`weight_of_child` = '{$weight}',`date_of_recorded` = '{$date}',`description`='{$description}' WHERE `health_id` = '{$health_id}'");
        if ($update) {
            $resp['status'] = 'success';
            $resp['msg'] = "health status has successfully updated.";
        } else {
            $resp['status'] = 'failed';
            $resp['msg'] = "An error occurred. Error: " . $this->conn->error;
        }
        if ($resp['status'] == 'success')
            $this->settings->set_flashdata('success', $resp['msg']);
        return json_encode($resp);
    }

    function save_assignment() {
        // Assuming $conn is your database connection object
        global $conn;

        // Extracting variables from POST data (not recommended due to security risks, consider using $_POST['variable'] instead)
        extract($_POST);

        // Check if the assignment already exists for the child
        $qry = $conn->query("SELECT * FROM `assignment_list` WHERE child_id = '{$child_fullname}'");
        $qry1 = $conn->query("SELECT * FROM `assignment_list` WHERE caregiver_id = '{$fullname}' and rooms_id !='{$rooms}'");

        if ($qry or $qry1) {
            if ($qry->num_rows > 0) {
                $resp['status'] = 'failed';
                $resp['msg'] = "Assignment already exists for this child.";
            } elseif ($qry1->num_rows > 0) {
                $resp['status'] = 'failed';
                $resp['msg'] = "One Cargiver canot assign in more than one room.";
            } else {
                // Insert the assignment into the database
                $sql = $conn->query("INSERT INTO `assignment_list` (child_id, caregiver_id,rooms_id) VALUES ('{$child_fullname}', '{$fullname}','{$rooms}')");

                if ($sql) {
                    $eid = !empty($id) ? $id : $conn->insert_id;
                    $resp['status'] = 'success';
                    $resp['msg'] = "Assignment has been successfully submitted.";
                } else {
                    $resp['status'] = 'failed';
                    $resp['msg'] = "An error occurred while saving the assignment.";
                    $resp['err'] = $conn->error;
                }
            }
        } else {
            $resp['status'] = 'failed';
            $resp['msg'] = "Query execution failed.";
        }

        // Set flash messages based on the status
        if ($resp['status'] == 'success' && !empty($id)) {
            // Assuming $this->settings->set_flashdata() sets flash data
            $this->settings->set_flashdata('success', $resp['msg']);
        }

        if ($resp['status'] == 'success' && empty($id)) {
            // Assuming $this->settings->set_flashdata() sets flash data
            $this->settings->set_flashdata('pop_msg', $resp['msg']);
        }

        // Return JSON response
        return json_encode($resp);
    }

    function delete_assignment() {
        extract($_POST);
        $del = $this->conn->query("DELETE FROM `assignment_list` where id = '{$id}'");
        if ($del) {
            $resp['status'] = 'success';
            $this->settings->set_flashdata('success', "assignment has been deleted successfully.");
        } else {
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);
    }

    function update_assignment() {
        extract($_POST);

        // Check if both $child_fullname and $fullname are set
        if (isset($child_fullname, $fullname)) {
            // Sanitize input to prevent SQL injection
            $child_fullname = $this->conn->real_escape_string($child_fullname);
            $fullname = $this->conn->real_escape_string($fullname);

            // Check if $id is set and numeric
            if (isset($id) && is_numeric($id)) {
                // Fetch records for the child
                $qry = $this->conn->query("SELECT * FROM `assignment_list` WHERE child_id = '{$child_fullname}'");

                // Fetch records for the caregiver
                $qry1 = $this->conn->query("SELECT * FROM `assignment_list` WHERE caregiver_id = '{$fullname}' AND rooms_id != '{$rooms}'");

                // Check if either query was successful
                if ($qry1) {
                    // Check if assignment already exists for this child
                    if ($qry1->num_rows > 0) {
                        $resp['status'] = 'failed';
                        $resp['msg'] = "A caregiver cannot be assigned to more than one room.";
                    } else {
                        // Update assignment
                        $update = $this->conn->query("UPDATE `assignment_list` SET `child_id` = '{$child_fullname}', `caregiver_id` = '{$fullname}' WHERE `id` = '{$id}'");

                        if ($update) {
                            $resp['status'] = 'success';
                            $resp['msg'] = "Assignment has been successfully updated.";
                        } else {
                            $resp['status'] = 'failed';
                            $resp['msg'] = "An error occurred. Error: " . $this->conn->error;
                        }
                    }
                } else {
                    $resp['status'] = 'failed';
                    $resp['msg'] = "An error occurred while fetching records.";
                }
            } else {
                $resp['status'] = 'failed';
                $resp['msg'] = "Invalid assignment ID.";
            }
        } else {
            $resp['status'] = 'failed';
            $resp['msg'] = "Invalid input data.";
        }

        if ($resp['status'] == 'success') {
            $this->settings->set_flashdata('success', $resp['msg']);
        }

        return json_encode($resp);
    }

    function save_rooms() {
        extract($_POST);
        $sql = $this->conn->query("INSERT INTO `rooms`(rooms_name)
                VALUES('{$rooms}')");
        if ($sql) {
            $resp['status'] = 'success';
            $this->settings->set_flashdata('success', "Room  has been save successfully.");
        } else {
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);
    }

    function update_rooms() {
        extract($_POST);
        $update = $this->conn->query("UPDATE `rooms` SET `rooms_name` = '{$rooms}' WHERE `id` = '{$id}'");
        if ($update) {
            $resp['status'] = 'success';
            $resp['msg'] = "Room has successfully updated.";
        } else {
            $resp['status'] = 'failed';
            $resp['msg'] = "An error occurred. Error: " . $this->conn->error;
        }
        if ($resp['status'] == 'success')
            $this->settings->set_flashdata('success', $resp['msg']);
        return json_encode($resp);
    }

    function health_report1() {
        if ($_GET["f"] == "health_report1") {
            $uid = $_GET["uid"];
            if (isset($_GET["from_date"], $_GET["to_date"])) {
                $pdf = new Pdf();
                $query = "
			SELECT date_of_recorded FROM health_list
			WHERE caregiver_id = $uid
			AND (date_of_recorded BETWEEN '" . $_GET["from_date"] . "' AND '" . $_GET["to_date"] . "')
			GROUP BY date_of_recorded
			ORDER BY date_of_recorded ASC
			";
                $statement = $this->conn->query($query);
                //$statement->execute();
                //$result = $statement->fetchAll();
                $output = '
				<style>
				@page { margin: 20px; }

				</style>
				<p>&nbsp;</p>
				<h3 align="center">Health Report</h3><br />';
                foreach ($statement as $row) {
                    $output .= '
				<table width="100%" border="0" cellpadding="5" cellspacing="0">
			        <tr>
			        	<td><b>Date - ' . $row["date_of_recorded"] . '</b></td>
			        </tr>
			        <tr>
			        	<td>
			        		<table width="100%" border="1" cellpadding="5" cellspacing="0">
			        			<tr>
			        				<td><b>Chaild  Name</b></td>
                                                                <td><b>Recorded By</b></td>
			        				<td><b>iliness</b></td>
			        				<td><b>symptoms</b></td>
			        				<td><b>temperature</b></td>
                                                                <td><b>weight_of_child</b></td>
			        			</tr>
				';
                    $sub_query = "
				SELECT * FROM health_list
			    INNER JOIN enrollment_list ON enrollment_list.id = health_list.child_id
                            INNER JOIN users ON users.id = health_list.caregiver_id
			     WHERE caregiver_id = $uid
				AND date_of_recorded = '" . $row["date_of_recorded"] . "'
				";

                    $statement = $this->conn->query($sub_query);
                    //$statement->execute();
                    //$sub_result = $statement->fetch_assoc();
                    foreach ($statement as $sub_row) {
                        $output .= '
					<tr>
						<td>' . $sub_row["child_fullname"] . '</td>
                                                <td>' . $sub_row["firstname"] . ' ' . $sub_row["lastname"] . '</td>
						<td>' . $sub_row["iliness"] . '</td>
						<td>' . $sub_row["symptoms"] . '</td>
						<td>' . $sub_row["temperature"] . '</td>
                                                <td>' . $sub_row["weight_of_child"] . '</td>
					</tr>
					';
                    }
                    $output .= '
					</table>
					</td>
					</tr>
				</table><br />
				';
                }
                $file_name = 'Attendance Report.pdf';
                $pdf->loadHtml($output);
                $pdf->render();
                $pdf->stream($file_name, array("Attachment" => false));
                exit(0);
            }
        }
    }

    function health_report2() {
        if (isset($_GET["uid"], $_GET["from_date"], $_GET["to_date"])) {
            $pdf = new Pdf();
            $query = "
			SELECT * FROM health_list
			INNER JOIN enrollment_list ON enrollment_list.id = health_list.child_id
			WHERE health_list.child_id = '" . $_GET["uid"] . "'
			";

            //$statement = $this->conn->query($query);
            $result = $this->conn->query($query);
            //$statement->execute();
            //$result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '
				<style>
				@page { margin: 20px; }

				</style>
				<p>&nbsp;</p>
				<h3 align="center">Health Report</h3><br /><br />
				<table width="100%" border="0" cellpadding="5" cellspacing="0">
			        <tr>
			            <td width="25%"><b>Chaild Name</b></td>
			            <td width="75%">' . $row["child_fullname"] . '</td>
			        </tr>
			        <tr>
			            <td width="25%"><b>Code</b></td>
			            <td width="75%">' . $row["code"] . '</td>
			        </tr>

			        <tr>
			        	<td colspan="2" height="5">
			        		<h3 align="center">Health Details</h3>
			        	</td>
			        </tr>
			        <tr>
			        	<td colspan="2">
			        		<table width="100%" border="1" cellpadding="5" cellspacing="0">
			        			<tr>
			        				<td><b>Recorded Date</b></td>
                                                                <td><b>Recorded By</b></td>
			        				<td><b>Iliness</b></td>
                                                                <td><b>Symptoms</b></td>
                                                                <td><b>Temperature</b></td>
                                                                <td><b>Weight of child</b></td>
			        			</tr>
				';
                $sub_query = "
				SELECT * FROM health_list
                                INNER JOIN users ON users.id = health_list.caregiver_id
				WHERE child_id = '" . $_GET["uid"] . "'
				AND (date_of_recorded BETWEEN '" . $_GET["from_date"] . "' AND '" . $_GET["to_date"] . "')
				ORDER BY date_of_recorded ASC
				";
                $statement = $this->conn->query($sub_query);
                //$statement = $connect->prepare($sub_query);
                //$statement->execute();
                //$sub_result = $statement->fetchAll();
                foreach ($statement as $sub_row) {
                    $output .= '
					<tr>
						<td>' . $sub_row["date_of_recorded"] . '</td>
                                                <td>' . $sub_row["firstname"] . ' ' . $sub_row["lastname"] . '</td>
						<td>' . $sub_row["iliness"] . '</td>
                                                <td>' . $sub_row["symptoms"] . '</td>
                                                <td>' . $sub_row["temperature"] . '</td>
                                                <td>' . $sub_row["weight_of_child"] . '</td>
					</tr>
					';
                }
                $output .= '
						</table>
					</td>
					</tr>
				</table>
				';
                $file_name = 'Chaild Report.pdf';
                $pdf->loadHtml($output);
                $pdf->render();
                $pdf->stream($file_name, array("Attachment" => false));
                exit(0);
            }
        }
    }

    function save_attendance() {
        $caregiver_id = $_POST["caregiver_id"];
        $parent_id = $_POST["parent_id"];
        $child_id = $_POST["child_id"];
        $attendance_date = '';
        $error_attendance_date = '';

        $error = 0;
        if (empty($_POST["attendance_date"])) {
            $error_attendance_date = 'Attendance Date is required';
            $error++;
        } else {
            $attendance_date = $_POST["attendance_date"];
        }

        if ($error > 0) {
            $output = array(
                'error' => true,
                'error_attendance_date' => $error_attendance_date
            );
        } else {

            $query = "
				SELECT attendance_date FROM tbl_attendance
				WHERE caregiver_id = '" . $caregiver_id . "'
				AND attendance_date = '" . $attendance_date . "' 				";
            $statement = $this->conn->query($query);

            if ($statement->num_rows > 0) {
                $output = array(
                    'error' => true,
                    'error_attendance_date' => 'Attendance Data Already Exists on this date'
                );
            } else {
                for ($count = 0; $count < count($child_id); $count++) {
                    $data = array(
                        ':child_id' => $child_id[$count],
                        ':attendance_status' => $_POST["attendance_status" . $child_id[$count]],
                        ':attendance_date' => $attendance_date,
                        ':caregiver_id' => $caregiver_id,
                        ':parent_id' => $parent_id[$count]
                    );

                    $query = "
    INSERT INTO tbl_attendance
    (child_id, attendance_status, attendance_date, caregiver_id,parent_id)
    VALUES (?, ?, ?, ?, ?)";

// Prepare the statement
                    $statement = $this->conn->prepare($query);

// Bind parameters
                    $statement->bind_param("ssssi", $data[':child_id'], $data[':attendance_status'], $data[':attendance_date'], $data[':caregiver_id'], $data[':parent_id']);

// Execute the statement
                    $statement->execute();

// Close the statement
                    $statement->close();
                }
                $output = array(
                    'success' => 'Data Added Successfully',
                );
            }
        }
        echo json_encode($output);
    }

    function uppdate_attendance() {
        extract($_POST);
        $update = $this->conn->query("UPDATE `tbl_attendance` SET `attendance_date` = '{$date}', `attendance_status` = '{$attendance_status}'
         WHERE `attendance_id` = '{$attendance_id}'");
        if ($update) {
            $resp['status'] = 'success';
            $resp['msg'] = "attendance status has successfully updated.";
        } else {
            $resp['status'] = 'failed';
            $resp['msg'] = "An error occurred. Error: " . $this->conn->error;
        }
        if ($resp['status'] == 'success')
            $this->settings->set_flashdata('success', $resp['msg']);
        return json_encode($resp);
    }

    function attendance_report1() {
        if ($_GET["f"] == "attendance_report1") {
            $uid = $_GET["uid"];
            if (isset($_GET["from_date"], $_GET["to_date"])) {
                $pdf = new Pdf();
                $query = "
			SELECT attendance_date FROM tbl_attendance
			WHERE caregiver_id = $uid
			AND (attendance_date BETWEEN '" . $_GET["from_date"] . "' AND '" . $_GET["to_date"] . "')
			GROUP BY attendance_date
			ORDER BY attendance_date ASC
			";
                $statement = $this->conn->query($query);
                //$statement->execute();
                //$result = $statement->fetchAll();
                $output = '
				<style>
				@page { margin: 20px; }

				</style>
				<p>&nbsp;</p>
				<h3 align="center">Attendance Report</h3><br />';
                foreach ($statement as $row) {
                    $output .= '
				<table width="100%" border="0" cellpadding="5" cellspacing="0">
			        <tr>
			        	<td><b>Date - ' . $row["attendance_date"] . '</b></td>
			        </tr>
			        <tr>
			        	<td>
			        		<table width="100%" border="1" cellpadding="5" cellspacing="0">
			        			<tr>
			        				<td><b>Chaild  Name</b></td>
                                                                <td><b>Recorded By</b></td>
			        				<td><b>attendance_status</b></td>
			        			</tr>
				';
                    $sub_query = "
				SELECT * FROM tbl_attendance
			    INNER JOIN enrollment_list ON enrollment_list.id = tbl_attendance.child_id
                            INNER JOIN users ON users.id = tbl_attendance.caregiver_id
			     WHERE caregiver_id = $uid
				AND attendance_date = '" . $row["attendance_date"] . "'
				";

                    $statement = $this->conn->query($sub_query);
                    //$statement->execute();
                    //$sub_result = $statement->fetch_assoc();
                    foreach ($statement as $sub_row) {
                        $output .= '
					<tr>
						<td>' . $sub_row["child_fullname"] . '</td>
                                                <td>' . $sub_row["firstname"] . ' ' . $sub_row["lastname"] . '</td>
						<td>' . $sub_row["attendance_status"] . '</td>

					</tr>
					';
                    }
                    $output .= '
					</table>
					</td>
					</tr>
				</table><br />
				';
                }
                $file_name = 'Attendance Report.pdf';
                $pdf->loadHtml($output);
                $pdf->render();
                $pdf->stream($file_name, array("Attachment" => false));
                exit(0);
            }
        }
    }

    function attendance_report2() {
        if (isset($_GET["uid"], $_GET["from_date"], $_GET["to_date"])) {
            $pdf = new Pdf();
            $query = "
			SELECT * FROM tbl_attendance
			INNER JOIN enrollment_list ON enrollment_list.id = tbl_attendance.child_id
			WHERE tbl_attendance.child_id = '" . $_GET["uid"] . "'
			";

            //$statement = $this->conn->query($query);
            $result = $this->conn->query($query);
            //$statement->execute();
            //$result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '
				<style>
				@page { margin: 20px; }

				</style>
				<p>&nbsp;</p>
				<h3 align="center">attendance Report</h3><br /><br />
				<table width="100%" border="0" cellpadding="5" cellspacing="0">
			        <tr>
			            <td width="25%"><b>Chaild Name</b></td>
			            <td width="75%">' . $row["child_fullname"] . '</td>
			        </tr>
			        <tr>
			            <td width="25%"><b>Code</b></td>
			            <td width="75%">' . $row["code"] . '</td>
			        </tr>

			        <tr>
			        	<td colspan="2" height="5">
			        		<h3 align="center">attendance Details</h3>
			        	</td>
			        </tr>
			        <tr>
			        	<td colspan="2">
			        		<table width="100%" border="1" cellpadding="5" cellspacing="0">
			        			<tr>
			        				<td><b>Recorded Date</b></td>
                                                                <td><b>Recorded By</b></td>
			        				<td><b>Attendance_status</b></td>
			        			</tr>
				';
                $sub_query = "
				SELECT * FROM tbl_attendance
                                INNER JOIN users ON users.id = tbl_attendance.caregiver_id
				WHERE child_id = '" . $_GET["uid"] . "'
				AND (attendance_date BETWEEN '" . $_GET["from_date"] . "' AND '" . $_GET["to_date"] . "')
				ORDER BY attendance_date ASC
				";
                $statement = $this->conn->query($sub_query);
                //$statement = $connect->prepare($sub_query);
                //$statement->execute();
                //$sub_result = $statement->fetchAll();
                foreach ($statement as $sub_row) {
                    $output .= '
					<tr>
						<td>' . $sub_row["attendance_date"] . '</td>
                                                <td>' . $sub_row["firstname"] . ' ' . $sub_row["lastname"] . '</td>
						<td>' . $sub_row["attendance_status"] . '</td>
					</tr>
					';
                }
                $output .= '
						</table>
					</td>
					</tr>
				</table>
				';
                $file_name = 'Chaild Report.pdf';
                $pdf->loadHtml($output);
                $pdf->render();
                $pdf->stream($file_name, array("Attachment" => false));
                exit(0);
            }
        }
    }

    function save_meal() {
        extract($_POST);
        global $conn;
        $sql_result = $conn->query("INSERT INTO `child_meals` (child_id, parent_id, meal_type,meal_date,food_items,description,meal_time)
                       VALUES('{$child_fullname}','{$parent_id}','{$meal_type}','{$meal_date}', '{$food_items}', '{$description}','{$time}')");
        // $sql = $conn->query("INSERT INTO `assignment_list` (child_id, caregiver_id,rooms_id) VALUES ('{$child_fullname}', '{$fullname}','{$rooms}')");

        if ($sql_result) {
            $resp['status'] = 'success';
            $resp['msg'] = "Meal has been save successfully..";
        } else {
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
        if ($resp['status'] == 'success')
            $this->settings->set_flashdata('success', $resp['msg']);
        return json_encode($resp);
    }

    function uppdate_meal() {
        extract($_POST);
        $update = $this->conn->query("UPDATE child_meals SET child_id = '{$child_fullname}', meal_date = '{$meal_date}',
        meal_type = '{$meal_type}',food_items = '{$food_items}',description = '{$description}',meal_time='{$time}' WHERE meal_id = '{$meal_id}'");
        if ($update) {
            $resp['status'] = 'success';
            $resp['msg'] = "Meal status has successfully updated.";
        } else {
            $resp['status'] = 'failed';
            $resp['msg'] = "An error occurred. Error: " . $this->conn->error;
        }
        if ($resp['status'] == 'success')
            $this->settings->set_flashdata('success', $resp['msg']);
        return json_encode($resp);
    }

    function uppdate_meal_note() {
        $note = $_GET['note'];
        $meal_id = $_GET['meal_id'];
        $update = $this->conn->query("UPDATE child_meals SET note = '{$note}'WHERE meal_id = '{$meal_id}'");
        if ($update) {
            $resp['status'] = 'success';
            $resp['msg'] = "Meal status has successfully updated.";
        } else {
            $resp['status'] = 'failed';
            $resp['msg'] = "An error occurred. Error: " . $this->conn->error;
        }
        if ($resp['status'] == 'success')
            $this->settings->set_flashdata('success', $resp['msg']);
        return json_encode($resp);
    }

    function delete_meal() {
        extract($_POST);
        $del = $this->conn->query("DELETE FROM child_meals where meal_id = '{$id}'");
        if ($del) {
            $resp['status'] = 'success';
            $this->settings->set_flashdata('success', "meal traking has been deleted successfully.");
        } else {
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);
    }

    function meal_report1() {
        if ($_GET["f"] == "meal_report1") {
            $uid = $_GET["uid"];
            if (isset($_GET["from_date"], $_GET["to_date"])) {
                $pdf = new Pdf();
                $query = "
			SELECT meal_date FROM child_meals
                        INNER JOIN enrollment_list ON child_meals.child_id = enrollment_list.id
                        INNER JOIN assignment_list ON assignment_list.child_id = enrollment_list.id
			WHERE assignment_list.caregiver_id = $uid
			AND (meal_date BETWEEN '" . $_GET["from_date"] . "' AND '" . $_GET["to_date"] . "')
			GROUP BY meal_date
			ORDER BY meal_date ASC
			";
                $statement = $this->conn->query($query);
                //$statement->execute();
                //$result = $statement->fetchAll();
                $output = '
				<style>
				@page { margin: 20px; }

				</style>
				<p>&nbsp;</p>
				<h3 align="center">Meal Report</h3><br />';
                foreach ($statement as $row) {
                    $output .= '
				<table width="100%" border="0" cellpadding="5" cellspacing="0">
			        <tr>
			        	<td><b>Date - ' . $row["meal_date"] . '</b></td>
			        </tr>
			        <tr>
			        	<td>
			        		<table width="100%" border="1" cellpadding="5" cellspacing="0">
			        			<tr>
			        				<td><b>Chaild  Name</b></td>
			        				<td><b>Meal type</b></td>
                                                                <td><b>Food item</b></td>
                                                                <td><b>Caregiver Note</b></td>
			        				<td><b>Description</b></td>
                                                                <td><b>Meal time</b></td>
			        			</tr>
			        			</tr>
				';
                    $sub_query = "
				SELECT * FROM child_meals
			   INNER JOIN enrollment_list ON child_meals.child_id = enrollment_list.id
                        INNER JOIN assignment_list ON assignment_list.child_id = enrollment_list.id
			     WHERE assignment_list.caregiver_id = $uid
			    AND meal_date = '" . $row["meal_date"] . "'
				";

                    $statement = $this->conn->query($sub_query);
                    //$statement->execute();
                    //$sub_result = $statement->fetch_assoc();
                    foreach ($statement as $sub_row) {
                        $output .= '
					<tr>
						<td>' . $sub_row["child_fullname"] . '</td>
						<td>' . $sub_row["meal_type"] . '</td>
                                                <td>' . $sub_row["food_items"] . '</td>
                                                <td>' . $sub_row["note"] . '</td>
                                                <td>' . $sub_row["description"] . '</td>
                                                <td>' . $sub_row["meal_time"] . '</td>

					</tr>
					';
                    }
                    $output .= '
					</table>
					</td>
					</tr>
				</table><br />
				';
                }
                $file_name = 'meal Report.pdf';
                $pdf->loadHtml($output);
                $pdf->render();
                $pdf->stream($file_name, array("Attachment" => false));
                exit(0);
            }
        }
    }

    function meal_report2() {
        if (isset($_GET["uid"], $_GET["from_date"], $_GET["to_date"])) {
            $pdf = new Pdf();
            $query = "
			SELECT * FROM child_meals
			INNER JOIN enrollment_list ON child_meals.child_id = enrollment_list.id
			WHERE child_id = '" . $_GET["uid"] . "'
			";

            //$statement = $this->conn->query($query);
            $result = $this->conn->query($query);
            //$statement->execute();
            //$result = $statement->fetchAll();
            $output = '';
            foreach ($result as $row) {
                $output .= '
				<style>
				@page { margin: 20px; }

				</style>
				<p>&nbsp;</p>
				<h3 align="center">Meal Report</h3><br /><br />
				<table width="100%" border="0" cellpadding="5" cellspacing="0">
			        <tr>
			            <td width="25%"><b>Chaild Name</b></td>
			            <td width="75%">' . $row["child_fullname"] . '</td>
			        </tr>
			        <tr>
			            <td width="25%"><b>Code</b></td>
			            <td width="75%">' . $row["code"] . '</td>
			        </tr>

			        <tr>
			        	<td colspan="2" height="5">
			        		<h3 align="center">Meal Details</h3>
			        	</td>
			        </tr>
			        <tr>
			        	<td colspan="2">
			        		<table width="100%" border="1" cellpadding="5" cellspacing="0">
			        			<tr>
			        				<td><b>Recorded Date</b></td>
                                                                <td><b>Chaild  Name</b></td>
			        				<td><b>Meal type</b></td>
                                                                <td><b>Food item</b></td>
                                                                <td><b>Meal time</b></td>
                                                                <td><b>Description</b></td>
                                                                <td><b>Caregiver Note</b></td>

			        			</tr>
				';
                $sub_query = "
				SELECT * FROM child_meals
                                INNER JOIN enrollment_list ON child_meals.child_id = enrollment_list.id
				WHERE child_id = '" . $_GET["uid"] . "'
				AND (meal_date BETWEEN '" . $_GET["from_date"] . "' AND '" . $_GET["to_date"] . "')
				ORDER BY meal_date ASC
				";
                $statement = $this->conn->query($sub_query);
                //$statement = $connect->prepare($sub_query);
                //$statement->execute();
                //$sub_result = $statement->fetchAll();
                foreach ($statement as $sub_row) {
                    $output .= '
					<tr>
                                                <td>' . $sub_row["meal_date"] . '</td>
						<td>' . $sub_row["child_fullname"] . '</td>
						<td>' . $sub_row["meal_type"] . '</td>
                                                <td>' . $sub_row["food_items"] . '</td>
                                                <td>' . $sub_row["meal_time"] . '</td>
                                                <td>' . $sub_row["description"] . '</td>
                                                <td>' . $sub_row["note"] . '</td>

					</tr>
					';
                }
                $output .= '
						</table>
					</td>
					</tr>
				</table>
				';
                $file_name = 'Chaild Report.pdf';
                $pdf->loadHtml($output);
                $pdf->render();
                $pdf->stream($file_name, array("Attachment" => false));
                exit(0);
            }
        }
    }
    function save_album(){
    extract($_POST);
    $data = "";
    foreach($_POST as $k=> $v){
      if($k != 'id'){
        if(!empty($data)) $data.=", ";
        $data.=" {$k} = '{$v}'";
      }
    }
    $check = $this->conn->query("SELECT * FROM album_list where name = '{$name}' ".(!empty($id) ? "and id != {$id}" : ''))->num_rows;
    $this->capture_err();
    if($check > 0){
      $resp['status'] = 'failed';
      $resp['msg'] = "Album Already Exists.";
    }else{
      if(empty($id)){
        $sql = "INSERT INTO album_list set $data";
        $save = $this->conn->query($sql);
      }else{
        $sql = "UPDATE album_list set $data where id = {$id}";
        $save = $this->conn->query($sql);
      }
      $this->capture_err();

      if($save){
        $resp['status'] = "success";
        $this->settings->set_flashdata('success'," Album Successfully Saved");
      }else{
        $resp['status'] = "failed";
        $resp['sql'] = $sql;
      }
    }
    return json_encode($resp);
  }

  function delete_album(){
    $sql = "UPDATE album_list set delete_f = 1 where id = '{$_POST['id']}' ";
    $delete = $this->conn->query($sql);
    $this->capture_err();
    if($delete){
      $resp['status'] = 'success';
      $img_arch = $this->conn->query("UPDATE images set delete_f = 1 where album_id = '{$_POST['id']}' ");
      $this->settings->set_flashdata('success'," Album Successfully Deleted. The data will be saved at archives temporarily");
    }else{
      $resp['status'] = "failed";
      $resp['sql'] = $sql;
    }
    return json_encode($resp);
  }
  function retrieve_album(){
    $sql = "UPDATE album_list set delete_f = 0 where id = '{$_POST['id']}' ";
    $retrieve = $this->conn->query($sql);
    $this->capture_err();
    if($retrieve){
      $sql = "UPDATE images set delete_f = 0 where album_id = '{$_POST['id']}' ";
      $retrieve_imgs = $this->conn->query($sql);
      if($retrieve_imgs){
        $this->settings->set_flashdata('success'," Album Successfully Retrieved.");
        $resp['status'] = 'success';
      }else{
        $resp['status'] = 'failed';
        $resp['msg'] = 'Album Successfully Retrieved but images are not';
        $resp['error'] = $this->conn->error;
        $resp['sql'] = $sql;
      }
    }else{
      $resp['status'] = "failed";
      $resp['sql'] = $sql;
    }
    return json_encode($resp);
  }
function save_image(){
    extract($_POST);
    if(isset($_FILES['images']['tmp_name']) && count($_FILES['images']['tmp_name'])>0){
      $data = "";
      if(!is_dir(base_app.'uploads/user_'.$user_id))
        mkdir(base_app.'uploads/user_'.$user_id);
      if(!is_dir(base_app.'uploads/user_'.$user_id.'/album_'.$album_id))
        mkdir(base_app.'uploads/user_'.$user_id.'/album_'.$album_id);
      $path = 'uploads/user_'.$user_id.'/album_'.$album_id.'/';
      for($i = 0; $i < count($_FILES['images']['tmp_name']); $i++){
        if(!empty($_FILES['images']['tmp_name'])){
          $oname = $_FILES['images']['name'][$i];
          $ext = pathinfo($oname, PATHINFO_EXTENSION);
          if(!is_file(base_app.$path.(strtotime(date('Y-m-d H:i'))).'.'.$ext))
            $nname = $path.(strtotime(date('Y-m-d H:i'))).'.'.$ext;
          else{
            $o = 0;
            while(true){
              $o++;
              $nname = $path.(strtotime(date('Y-m-d H:i'))).'_'.$o.'.'.$ext;
              if(!is_file(base_app.$path.(strtotime(date('Y-m-d H:i'))).'_'.$o.'.'.$ext))
                break;
            }
          }
          $move = move_uploaded_file($_FILES['images']['tmp_name'][$i],base_app.$nname);
          if($move){
            if(!empty($data)) $data .=",";
            $data .= "('{$album_id}','{$oname}','{$nname}','{$user_id}')";
          }
        }
      }
      if(!empty($data)){
        $sql = "INSERT INTO images (album_id,original_name,path_name,user_id) VALUES {$data}";
        $save = $this->conn->query($sql);
        if($data){
          $resp['status'] = 'success';
          $this->settings->set_flashdata('success',' Image/s successfully uploaded');
        }else{
          $resp['status'] = 'failded';
          $resp['error'] = $this->conn->error;
          $resp['sql'] = $sql;
        }
      }else{
        $resp['status'] = 'failed';
        $resp['msg'] = "Error Uploading image/s.";
      }

    }else{
      $resp['status'] = 'failed';
      $resp['msg'] = "Select atleast 1 image first.";
    }
    return json_encode($resp);
  }
  function rename_image(){
    extract($_POST);
    $nname = $original_name.$ext;
    $sql = "UPDATE images set original_name = '{$nname}' where id = '{$id}' ";
    $save = $this->conn->query($sql);
    if($save){
      $resp['status'] = 'success';
      $this->settings->set_flashdata('success',' Image successfully renamed');
    }else{
      $this->settings->set_flashdata('success',' Image successfully renamed');
      $resp['status'] = 'failed';
      $resp['msg'] = "Error Renaming image.";
      $resp['error'] = $this->conn->error;
      $resp['sql'] = $sql;
    }
    return json_encode($resp);
  }
  function delete_image(){
    $sql = "UPDATE images set delete_f = 1 where id = '{$_POST['id']}' ";
    $delete = $this->conn->query($sql);
    $this->capture_err();
    if($delete){
      $resp['status'] = 'success';
      $this->settings->set_flashdata('success'," Image Successfully Deleted. The data will be saved at archives temporarily");
    }else{
      $resp['status'] = "failed";
      $resp['error'] = $this->conn->error;
      $resp['sql'] = $sql;
    }
    return json_encode($resp);
  }
  function move_image(){
    extract($_POST);
    $fname  = strrev(explode("/",strrev($opath),-1)[0]);
    if(!is_dir(base_app.'uploads/user_'.$user_id))
      mkdir(base_app.'uploads/user_'.$user_id);
    if(!is_dir(base_app.'uploads/user_'.$user_id.'/album_'.$album_id))
      mkdir(base_app.'uploads/user_'.$user_id.'/album_'.$album_id);
    $npath = 'uploads/user_'.$user_id.'/album_'.$album_id.'/'.$fname;
    $move = rename(base_app.$opath,base_app.$npath);
    if($move){
      $sql = "UPDATE images set album_id = '{$album_id}', path_name = '{$npath}' where id = '{$_POST['id']}' ";
      $save = $this->conn->query($sql);
      if($save){
        $resp['status'] = 'success';
        $this->settings->set_flashdata('success'," Image Successfully Moved.");
      }else{
        $resp['status'] = "failed";
        $resp['error'] = $this->conn->error;
$resp['msg'] = "Error Moving image.";
        $resp['sql'] = $sql;
      }
    }
    else{
      $resp['status'] = "failed";
        $resp['msg'] = "Error Moving image.";
        $resp['msg'] = $sql;
    }
    return json_encode($resp);
  }
  function retrieve_image(){
    $sql = "UPDATE images set delete_f = 0 where id = '{$_POST['id']}' ";
    $retrieve = $this->conn->query($sql);
    $this->capture_err();
    if($retrieve){
      $sql = "UPDATE album_list set delete_f = 0 where id = '{$_POST['album_id']}' ";
      $retrieve_imgs = $this->conn->query($sql);
      if($retrieve_imgs){
        $this->settings->set_flashdata('success'," Image Successfully Retrieved.");
        $resp['status'] = 'success';
      }else{
        $resp['status'] = 'failed';
        $resp['msg'] = 'Image Successfully Retrieved but Retrieving album error';
        $resp['error'] = $this->conn->error;
        $resp['sql'] = $sql;
      }
    }else{
      $resp['status'] = "failed";
      $resp['sql'] = $sql;
    }
    return json_encode($resp);
  }
  function rename_album(){
    extract($_POST);
    $sql = "UPDATE album_list set name = '{$new_name}' where id = '{$id}' ";
    $save = $this->conn->query($sql);
    if($save){
      $resp['status'] = 'success';
      $this->settings->set_flashdata('success',' Album successfully renamed');
    }else{
      $this->settings->set_flashdata('success',' Album successfully renamed');
      $resp['status'] = 'failed';
      $resp['msg'] = "Error Renaming album.";
      $resp['error'] = $this->conn->error;
      $resp['sql'] = $sql;
    }
    return json_encode($resp);
  }
  
  function permanently_delete(){
    $images = $this->conn->query("SELECT * FROM images where user_id = '{$this->settings->userdata('id')}' and delete_f = 1 ");
    $albums = $this->conn->query("SELECT * FROM album_list where user_id = '{$this->settings->userdata('id')}' and delete_f = 1 ");
    while($irow = $images->fetch_assoc()){
      unlink(base_app.$irow['path_name']);
      $this->conn->query("DELETE FROM images where id = '{$irow['id']}'");
    }
    while($arow = $albums->fetch_assoc()){
      rmdir(base_app.'uploads/user_'.($this->settings->userdata('id')).'/album_'.$arow['id']);
      $this->conn->query("DELETE FROM album_list where id = '{$arow['id']}'");
    }
    $this->settings->set_flashdata('success'," All archived data successfully deleted.");
    $resp['status'] = 'success';
    return json_encode($resp);
  }
}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
    case 'save_service':
        echo $Master->save_service();
        break;
    case 'delete_service':
        echo $Master->delete_service();
        break;
    case 'save_babysitter':
        echo $Master->save_babysitter();
        break;
    case 'delete_babysitter':
        echo $Master->delete_babysitter();
        break;
    case 'save_enrollment':
        echo $Master->save_enrollment();
        break;
    case 'delete_enrollment':
        echo $Master->delete_enrollment();
        break;
    case 'update_status':
        echo $Master->update_status();
        break;
    case 'save_assignment':
        echo $Master->save_assignment();
        break;
    case 'delete_assignment':
        echo $Master->delete_assignment();
        break;
    case 'update_assignment':
        echo $Master->update_assignment();
        break;
    case 'save_health':
        echo $Master->save_health();
        break;
    case 'uppdate_health':
        echo $Master->uppdate_health();
        break;
    case 'save_rooms':
        echo $Master->save_rooms();
        break;
    case 'health_report1':
        echo $Master->health_report1();
        break;
    case 'health_report2':
        echo $Master->health_report2();
        break;
    case 'save_attendance':
        echo $Master->save_attendance();
        break;
    case 'uppdate_attendance':
        echo $Master->uppdate_attendance();
        break;
    case 'update_rooms':
        echo $Master->update_rooms();
        break;
    case 'save_meal':
        echo $Master->save_meal();
        break;
    case 'uppdate_meal':
        echo $Master->uppdate_meal();
        break;
    case 'delete_meal':
        echo $Master->delete_meal();
        break;
    case 'uppdate_meal_note':
        echo $Master->uppdate_meal_note();
        break;
    case 'attendance_report1':
        echo $Master->attendance_report1();
        break;
    case 'attendance_report2':
        echo $Master->attendance_report2();
        break;
    case 'meal_report1':
        echo $Master->meal_report1();
        break;
    case 'meal_report2':
        echo $Master->meal_report2();
        break;
    case 'save_album':
    echo $Master->save_album();
  break;
  case 'delete_album':
    echo $Master->delete_album();
  break;
  case 'retrieve_album':
    echo $Master->retrieve_album();
  break;
  case 'save_image':
    echo $Master->save_image();
  break;
  case 'rename_image':
    echo $Master->rename_image();
  break;
  case 'move_image':
    echo $Master->move_image();
  break;
  case 'delete_image':
    echo $Master->delete_image();
  break;
  
  case 'retrieve_image':
    echo $Master->retrieve_image();
  break;
  case 'permanently_delete':
    echo $Master->permanently_delete();
  break;
  case 'rename_album':
    echo $Master->rename_album();
  break;

    default:
        // echo $sysset->index();
        break;
}
