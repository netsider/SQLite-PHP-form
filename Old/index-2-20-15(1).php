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
	$db = new PDO('sqlite:' . $database);;
	$db->exec("DELETE FROM $TABLE WHERE $WHERE");
	$db = NULL;
	}	
	

echo '<br/>';
echo 'Filter Input Post:';
echo filter_input(INPUT_POST, "one");
echo '<br/>';
if (isset($_POST)){ // If submit pressed
if (isset($_POST["delete"])){
// echo 'Delete Pressed!';
$delid = $_POST["delete"];
del_table("ID = $delid", "Russ", "russ.db");
}
if (isset($_POST['submit-add'])){
	$one = filter_input(INPUT_POST, "one");
	insert_into('Name', $one, "Russ", 'sqlite:russ.db');
}}
	$val = 'Red, 30';
	insert_into('Name, Age', $val, "Russ", 'sqlite:russ.db');

	function query_table($query, $TABLE, $database){
	$db = new PDO('sqlite:' . $database);
	$result = $db->query($query);
	return $result;
	$db = NULL;
	}
	

	
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

		echo "<table border=1>";
		echo "<tr><td>Id</td><td>Breed</td><td>Name</td><td>Age</td></tr>";

    foreach($results as $row)
    {
      echo '<tr><td>'.$row['Id'].'</td>';
      echo '<td>'.$row['Breed'].'</td>';
      echo '<td>'.$row['Name'].'</td>';
      echo '<td>'.$row['Age'].'</td>';
	  echo '<td><form method="post"><button type="submit" name="delete" value="' . $row['Id'] . '">Delete</button></form></td>';
	  echo '</tr>';
    }
    echo "</table>";
	
	var_export($_POST);

?>
</html>