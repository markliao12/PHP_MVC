<?php

/**
 * Main Model trait
 */
trait Model
{
	use Database;

	protected $limit 		= 10;
	protected $offset 		= 0;
	protected $order_type 	= "desc";
	protected $order_column = "id";
	public $errors 		= [];

	public function findAll()
	{

		$query = "select * from $this->table order by $this->order_column $this->order_type limit $this->limit offset $this->offset";

		return $this->query($query);
	}

	public function findAlltime()
	{

		$query = "select u_fname,u_lname,r_state,r_time,r_note from records as r inner join users as u on r.u_id=u.u_id order by r_id DESC ";

		return $this->query($query);
	}

	public function findAllemp()
	{

		$query = "select * from users where u_status=2 order by u_id ASC ";

		return $this->query($query);
	}

	public function where($data, $data_not = [])
	{
		$keys = array_keys($data);
		$keys_not = array_keys($data_not);
		$query = "select * from $this->table where ";

		foreach ($keys as $key) {
			$query .= $key . " = :" . $key . " && ";
		}

		foreach ($keys_not as $key) {
			$query .= $key . " != :" . $key . " && ";
		}

		$query = trim($query, " && ");

		$query .= " order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
		$data = array_merge($data, $data_not);

		return $this->query($query, $data);
	}

	public function first($data, $data_not = [])
	{
		$keys = array_keys($data);
		$keys_not = array_keys($data_not);
		$query = "select * from $this->table where ";

		foreach ($keys as $key) {
			$query .= $key . " = :" . $key . " && ";
		}

		foreach ($keys_not as $key) {
			$query .= $key . " != :" . $key . " && ";
		}

		$query = trim($query, " && ");

		$query .= " limit $this->limit offset $this->offset";
		$data = array_merge($data, $data_not);

		$result = $this->query($query, $data);
		if ($result)
			return $result[0];

		return false;
	}

	public function insert($data)
	{

		/** remove unwanted data **/
		if (!empty($this->allowedColumns)) {
			foreach ($data as $key => $value) {

				if (!in_array($key, $this->allowedColumns)) {
					unset($data[$key]);
				}
			}
		}

		$keys = array_keys($data);

		$query = "insert into $this->table (" . implode(",", $keys) . ") values (:" . implode(",:", $keys) . ")";
		$this->query($query, $data);

		return false;
	}

	public function update($id, $data, $id_column = 'id')
	{

		/** remove unwanted data **/
		if (!empty($this->allowedColumns)) {
			foreach ($data as $key => $value) {

				if (!in_array($key, $this->allowedColumns)) {
					unset($data[$key]);
				}
			}
		}

		$keys = array_keys($data);
		$query = "update $this->table set ";

		foreach ($keys as $key) {
			$query .= $key . " = :" . $key . ", ";
		}

		$query = trim($query, ", ");

		$query .= " where $id_column = :$id_column ";

		$data[$id_column] = $id;

		$this->query($query, $data);
		return false;
	}

	public function delete($id, $id_column = 'id')
	{

		$data[$id_column] = $id;
		$query = "delete from $this->table where $id_column = :$id_column ";
		$this->query($query, $data);

		return false;
	}

	public function usrdelete($id, $id_column = 'u_id')
	{

		$data[$id_column] = $id;
		$query = "delete from $this->table where $id_column = :$id_column ";
		$this->query($query, $data);

		return false;
	}

	public function recordsdelete($id, $id_column = 'r_id')
	{

		$data[$id_column] = $id;
		$query = "delete from $this->table where $id_column = :$id_column ";
		$this->query($query, $data);

		return false;
	}

	public function locationdelete($id, $id_column = 'w_id')
	{

		$data[$id_column] = $id;
		$query = "delete from $this->table where $id_column = :$id_column ";
		$this->query($query, $data);

		return false;
	}

	public function sontime($a, $b, $u_id)
	{
		$query = "SELECT * FROM records WHERE r_time > '" . $a . "' AND r_time < '" . $b . "' AND rsn_cd=1 AND u_id = $u_id ";

		return $this->query($query);
	}

	public function weektimeall($a, $b)
	{
		$query = "select r.u_id,u_fname,u_lname,r_state,r_time,r_ip from records as r inner join users as u on r.u_id=u.u_id WHERE r_time >= '" . $a . "' AND r_time <= '" . $b . "' order by r_time DESC";

		return $this->query($query);
	}

	public function weektimelocation($a, $b, $locations)
	{
		$query = "select r.u_id,u_fname,u_lname,r_state,r_time,r_ip from records as r inner join users as u on r.u_id=u.u_id WHERE r_time >= '" . $a . "' AND r_time <= '" . $b . "' and r_ip = ".$locations." order by r_time DESC";

		return $this->query($query);
	}

	public function weektimeallbyrsncd($a)
	{
		$query = "select r.u_id,u_fname,u_lname,r_state,r_time from records as r inner join users as u on r.u_id=u.u_id WHERE rsn_cd = $a order by r_time DESC";

		return $this->query($query);
	}

	public function alluserid()
	{
		$query = "select u_id from users where u_status=2 order by u_id ASC";

		return $this->query($query);
	}


	public function weektime($a, $b, $u_id)
	{
		$query = "select r_id,u_fname,u_lname,r_state,r_time,w_address from records as r inner join users as u on r.u_id=u.u_id inner join work_location as w on r_ip=w_id WHERE r_time >= '" . $a . "' AND r_time <= '" . $b . "' AND r.u_id = $u_id order by r_id DESC";

		return $this->query($query);
	}

	public function weektimebylocation($a, $b, $u_id, $r_ip)
	{
		$query = "select r_id,u_fname,u_lname,r_state,r_time,w_address from records as r inner join users as u on r.u_id=u.u_id inner join work_location as w on r_ip=w_id WHERE r_time >= '" . $a . "' AND r_time <= '" . $b . "' AND r.u_id = $u_id AND r_ip = $r_ip order by r_id DESC";

		return $this->query($query);
	}

	public function getinfobyid($a, $u_id)
	{
		$query = "select r_id,u_fname,u_lname,r_state,r_time,w_address from records as r inner join users as u on r.u_id=u.u_id inner join work_location as w on r_ip=w_id WHERE r_time LIKE '" . $a . "%' AND r.u_id = $u_id order by r_id DESC";

		return $this->query($query);
	}

	public function lastdaytime($a, $u_id)
	{
		$query = "SELECT * FROM records WHERE rsn_cd = $a AND u_id = $u_id order by r_time DESC limit 1";

		return $this->query($query);
	}

	public function firstdaytime($a, $u_id)
	{
		$query = "SELECT * FROM records WHERE rsn_cd = $a AND u_id = $u_id order by r_time ASC limit 1";

		return $this->query($query);
	}

	public function alllastdaytime($a)
	{
		$query = "SELECT * FROM records WHERE rsn_cd = $a order by r_time DESC limit 1";

		return $this->query($query);
	}

	public function allfirstdaytime($a)
	{
		$query = "SELECT * FROM records WHERE rsn_cd = $a order by r_time ASC limit 1";

		return $this->query($query);
	}

	
	public function checktime($a, $b, $u_id)
	{
		$query = "SELECT * FROM records WHERE r_time > '" . $a . "' AND r_time < '" . $b . "' AND rsn_cd=1 AND u_id = $u_id order by r_time DESC limit 1";

		return $this->query($query);
	}

	public function insertrecord($data)
	{

		/** remove unwanted data **/
		if (!empty($this->allowedColumns)) {
			foreach ($data as $key => $value) {

				if (!in_array($key, $this->allowedColumns)) {
					unset($data[$key]);
				}
			}
		}

		$keys = array_keys($data);

		$query = "insert into $this->table (" . implode(",", $keys) . ") values (:" . implode(",:", $keys) . ")";
		$this->query($query, $data);

		return false;
	}

	public function userbyid($u_id)
	{
		$query = "SELECT * FROM users WHERE u_id = $u_id ";

		return $this->query($query);
	}

	public function oneuserbyid($u_id)
	{
		$query = "SELECT * FROM users WHERE u_id = $u_id ";

		$res = $this->query($query);
		return $res[0];
	}

	public function findAllstatus()
	{

		$query = "select * from e_status order by s_id ASC ";

		return $this->query($query);
	}

	public function emailexcis($a)
	{
		$query = "SELECT * FROM users WHERE email = '" . $a . "'";

		return $this->query($query);
	}

	public function addressexcis($a)
	{
		$query = "SELECT * FROM work_location WHERE w_address = '" . $a . "'";

		return $this->query($query);
	}

	public function findAllemployees()
	{

		$query = "select u_id,u_fname,u_lname,email,tel,s_name,u_reg_pay,u_pay,u_base_hrs,create_dt from users as u inner join e_status as e on u.u_status=e.s_id where u.u_status>1 order by u_id ASC ";

		return $this->query($query);
	}

	public function updateuser($id, $data, $id_column = 'u_id')
	{

		/** remove unwanted data **/
		if (!empty($this->allowedColumns)) {
			foreach ($data as $key => $value) {

				if (!in_array($key, $this->allowedColumns)) {
					unset($data[$key]);
				}
			}
		}

		$keys = array_keys($data);
		$query = "update $this->table set ";

		foreach ($keys as $key) {
			$query .= $key . " = :" . $key . ", ";
		}

		$query = trim($query, ", ");

		$query .= " where $id_column = :$id_column ";

		$data[$id_column] = $id;

		$this->query($query, $data);
		return false;
	}

	public function updatetime($id, $data, $id_column = 'r_id')
	{

		/** remove unwanted data **/
		if (!empty($this->allowedColumns)) {
			foreach ($data as $key => $value) {

				if (!in_array($key, $this->allowedColumns)) {
					unset($data[$key]);
				}
			}
		}

		$keys = array_keys($data);
		$query = "update $this->table set ";

		foreach ($keys as $key) {
			$query .= $key . " = :" . $key . ", ";
		}

		$query = trim($query, ", ");

		$query .= " where $id_column = :$id_column ";

		$data[$id_column] = $id;

		$this->query($query, $data);
		return false;
	}

	public function updatelocation($id, $data, $id_column = 'w_id')
	{

		/** remove unwanted data **/
		if (!empty($this->allowedColumns)) {
			foreach ($data as $key => $value) {

				if (!in_array($key, $this->allowedColumns)) {
					unset($data[$key]);
				}
			}
		}

		$keys = array_keys($data);
		$query = "update $this->table set ";

		foreach ($keys as $key) {
			$query .= $key . " = :" . $key . ", ";
		}

		$query = trim($query, ", ");

		$query .= " where $id_column = :$id_column ";

		$data[$id_column] = $id;

		$this->query($query, $data);
		return false;
	}

	public function findlocationstatus()
	{

		$query = "select * from w_status order by ws_id ASC ";

		return $this->query($query);
	}

	public function findalllocations()
	{

		$query = "select w_id,w_address,ws_name,w_create_dt from work_location as w inner join w_status as s on w.w_status=s.ws_id order by w_id ASC ";

		return $this->query($query);
	}

	public function locationlist()
	{

		$query = "select * from work_location where w_status=1 order by w_id ASC ";

		return $this->query($query);
	}

	public function findlocation($w_id)
	{

		$query = "select * from work_location where w_id=" . $w_id;

		return $this->query($query);
	}

	public function insertquery($data)
	{

		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "mydb";

		if (!empty($this->allowedColumns)) {
			foreach ($data as $key => $value) {

				if (!in_array($key, $this->allowedColumns)) {
					unset($data[$key]);
				}
			}
		}

		$keys = array_keys($data);
		$values = array_values($data);

		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO history (" . implode(",", $keys) . ") values (" . implode(",", $values) . ")";
			// use exec() because no results are returned
			$conn->exec($sql);
			return $conn->lastInsertId();
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}

	public function findalldatebyrsncd($u_id, $rsn_cd)
	{

		$query = "select r_id from records where rsn_cd = " . $rsn_cd . " and u_id = " . $u_id;

		return $this->query($query);
	}

	public function findalldatebyrsndate($a,$b,$u_id)
	{

		$query = "select r_id from records where r_time > '" . $a . "' AND r_time < '" . $b . "' AND rsn_cd = 1 AND u_id = " . $u_id;

		return $this->query($query);
	}

	public function updaterecordrsncd($rsn_cd)
	{

		$query = "update records set rsn_cd = 2 where rsn_cd = " . $rsn_cd;

		$this->query($query);

		return false;
	}

	public function updaterecordbydate($a,$b)
	{

		$query = "update records set rsn_cd = 2 where r_time > '" . $a . "' AND r_time < '" . $b . "' " ;

		$this->query($query);

		return false;
	}

	public function recordsrsncd()
	{

		$query = "select rsn_cd from records where rsn_cd = 1 ";

		return $this->query($query);
	}

	public function recordsrsncdbyid($a)
	{

		$query = "select rsn_cd from records where rsn_cd = 1 AND u_id = $a ";

		return $this->query($query);
	}

	public function getversion()
	{

		$query = "select version from history order by h_id DESC limit 1 ";

		return $this->query($query);
	}

	public function lasttwoweek($ver)
	{
		$query = "select h.u_id,u_fname,u_lname,reg_hrs,bonus_hrs,tot_hrs,reg_pay,bonus_pay,tot_pay,version from history as h inner join users as u on h.u_id=u.u_id where version = " . $ver;
		return $this->query($query);
	}

	public function locationbydate($a, $b, $u_id)
	{
		$query = "select r_id,u_fname,u_lname,r_state,r_time,r_ip,w_address from records as r inner join users as u on r.u_id=u.u_id inner join work_location as w on r_ip=w_id WHERE r_time >= '" . $a . "' AND r_time <= '" . $b . "' AND r.u_id = $u_id order by r_id DESC limit 1 ";

		return $this->query($query);
	}

	public function allhistorypay()
	{
		$query = "select * from history order by version DESC ";

		return $this->query($query);
	}

	public function historypaybyversion($a)
	{
		$query = "select * from history WHERE version = " . $a;

		return $this->query($query);
	}

	public function getfirstdaytime($a)
	{
		$query = "SELECT * FROM records as r inner join relation_history as rh on r.r_id=rh.r_id inner join history as h on rh.h_id=h.h_id WHERE version = $a order by r_time ASC limit 1";

		return $this->query($query);
	}

	public function getlastdaytime($a)
	{
		$query = "SELECT * FROM records as r inner join relation_history as rh on r.r_id=rh.r_id inner join history as h on rh.h_id=h.h_id WHERE version = $a order by r_time DESC limit 1";

		return $this->query($query);
	}

	public function getpaysub($a)
	{
		$query = "SELECT * FROM history as h inner join users as u on h.u_id=u.u_id WHERE version = $a order by u_fname,u_lname ASC ";

		return $this->query($query);
	}

	public function getpaybyid($a,$b)
	{
		$query = "SELECT * FROM history as h inner join users as u on h.u_id=u.u_id WHERE version = $a and h.u_id = $b order by u_fname,u_lname ASC ";

		return $this->query($query);
	}

	public function weektimebyversion($a, $u_id)
	{
		$query = "select r.r_id,u.u_fname,u.u_lname,r.r_state,r.r_time,w.w_address from records as r inner join users as u on r.u_id=u.u_id inner join work_location as w on r_ip=w_id inner join relation_history as rh on r.r_id=rh.r_id inner join history as h on rh.h_id=h.h_id WHERE h.version = $a AND r.u_id = $u_id order by r.r_id DESC";

		return $this->query($query);
	}

	public function findtime($r_id)
	{

		$query = "select * from records where r_id=" . $r_id;

		return $this->query($query);
	}
}
