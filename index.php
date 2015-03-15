<html>
Add Data To Table:<br/>
<form method="post">
<input type="text" name="one">
<input type="submit" value="Submit!" name="submit-add">
</form>
<br/>
Add Column To Table:
<form method="post">
<input type="text" name="one">
<input type="submit" value="Submit!" name="submit-addcol">
</form>
Delete Column From Table:
<form method="post">
<input type="text" name="one">
<input type="submit" value="Submit!" name="submit-delcol">
</form>
<?PHP
	function read_database($TABLE, $database){
	$db = new PDO('sqlite:' . $database);
	$result = $db->query("SELECT * FROM $TABLE");
	return $result;
	$db = NULL;
	}
	function query_table($query, $TABLE, $database){
	$db = new PDO('sqlite:' . $database);
	$result = $db->query($query);
	return $result;
	$db = NULL;
	}
	function insert_into($field, $value, $TABLE, $database){
	$db = new PDO($database);
	$query = 'INSERT INTO ' . $TABLE . '(' . $field. ') VALUES (' . $value . ');';
	// $query = 'INSERT INTO ' . $TABLE . '(' . $field. ') VALUES (' . '"' . $value . '"' . ');';
	$query = 'INSERT INTO ' . $TABLE . '(' . $field. ') VALUES (' . '"' . $value . '"' . ');';
	echo $query;
	// $query = '"INSERT INTO $TABLE ($field) VALUES ($value);"';
	$db->exec($query); // Value needs to be in parenthesis, but when it is, I can't insert $val (below).
	$db = NULL;
}
	function del_table($WHERE, $TABLE, $database){
	$db = new PDO('sqlite:' . $database);
	$db->exec("DELETE FROM $TABLE WHERE $WHERE");
	$db = NULL;
	}
	// $db = new PDO('sqlite:russ.db');
	// $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// $query = "SELECT * FROM Russ";
	// $result = $db->query($query);
	// $result->execute();
	// $result = $db->fetchAll();
	// $result = $result->fetchAll();
	// foreach ($result as $key => $value) {
	// echo 'Key: ' . $key . '<br/>';
	// echo 'Value: ' . $value[2] . '<br/>';
	// }
	// echo '<pre>';
	// print_r($result);
	// $db = NULL;
	// echo "</pre>";
	$db = new PDO('sqlite:russ.db');
	$results = read_database("Russ", 'russ.db');
	print_r($results);
echo '<br/>';
echo 'Filter Input Post:';
echo filter_input(INPUT_POST, "one");
echo '<br/>';
if (isset($_POST)){ // If submit pressed
if (isset($_POST["delete"])){
// echo 'Delete Pressed!';
echo 'Delete Button Pressed!';
$delid = $_POST["delete"];
del_table("ID = $delid", "Russ", "russ.db");
}
if (isset($_POST['submit-add'])){
	$one = filter_input(INPUT_POST, "one");
	insert_into('Name', $one, "Russ", 'sqlite:russ.db');
}}
	$val = 'Red, 30';
	insert_into('Name, Age', $val, "Russ", 'sqlite:russ.db');
	// function add_column($column, $type, $TABLE, $database){
	// $db = new PDO('sqlite:' . $database);;
	// $db->exec("ALTER TABLE $TABLE ADD COLUMN $column $type");
	// $db = NULL;
	// }
	// add_column("SessionID", "VARCHAR","Russ", 'russ.db');
	// function update_table($condition, $fieldvalue, $TABLE, $database){
	// $db = new PDO('sqlite:' . $database);
	// $db->exec("UPDATE $TABLE SET $fieldvalue WHERE $condition");
	// $db = NULL;
	// }
	// $fieldvalue = 'Breed = "Russell"';
	// $condition = "id = 4";
	// update_table($condition, $fieldvalue, "Russell", "russ.db");
	$database = 'russ.db';
		$TABLE = "Russ";
	   //$results = read_table("Russ", 'russ.db');
	   $results = query_table("SELECT * FROM $TABLE", "Russ", 'russ.db');
	   // query_table("SELECT * FROM $TABLE", "Russ", 'russ.db');
		$db = new PDO('sqlite:' . $database);
		// $db->exec("CREATE TABLE Russ (Id INTEGER PRIMARY KEY, Breed TEXT, Name TEXT, Age INTEGER)");    
		echo '<table border="1"><form method="post">';
		echo "<tr><td>Id</td><td>Breed</td><td>Name</td><td>Age</td></tr>";
    foreach($results as $row)
    {
      echo '<tr><td>'.$row['Id'].'</td>';
      echo '<td>'.$row['Breed'].'</td>';
      echo '<td>'.$row['Name'].'</td>';
      echo '<td>'.$row['Age'].'</td>';
	  //echo '<td><form method="post"><button type="submit" name="delete" value="' . $row['Id'] . '">Delete</button></form></td>';
	  echo '<td><input type="checkbox" name="deletebox[]" value="' . $row['Id'] . '"></td>';
	  echo '</tr>';
    }
    echo '';
	echo "</table>";
	var_export($_POST);
?>
<input type="submit" type="submit" name="delete" value="Delete">
</form>
</html>