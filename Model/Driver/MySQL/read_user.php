<?php
	class UserReader
	{
	   var $username;
   	var $pwd;
    	var $database;
    	var $tablename;
    	var $connection;
		function InitDB($host,$uname,$pwd,$database,$tablename)
   	{
      	$this->db_host  = $host;
			$this->username = $uname;
        	$this->pwd  = $pwd;
        	$this->database  = $database;
        	$this->tablename = $tablename;
    	}
		
		function Ensuretable()
    	{
      	$result = mysql_query("SHOW COLUMNS FROM $this->tablename");   
        	if(!$result || mysql_num_rows($result) <= 0)
        	{
            return $this->CreateTable();
        	}
        	return true;
    	}
    
    	function CreateTable()
    	{
      	$qry = "Create Table $this->tablename (".
                "id_user INT NOT NULL AUTO_INCREMENT ,".
                "name VARCHAR( 128 ) NOT NULL ,".
                "email VARCHAR( 64 ) NOT NULL ,".
                "phone_number VARCHAR( 16 ) NOT NULL ,".
                "username VARCHAR( 16 ) NOT NULL ,".
                "password VARCHAR( 32 ) NOT NULL ,".
                "confirmcode VARCHAR(32) ,".
                "PRIMARY KEY ( id_user )".
                ")";
                
        	if(!mysql_query($qry,$this->connection))
        	{
         	$this->HandleDBError("Error creating the table \nquery was\n $qry");
            return false;
        	}
        	return true;
    	}

      public function saveToDB($formvars)
      {    
        	$insert_query = 'insert into '.$this->tablename.'(
                name,
                email,
                username,
                password,
                confirmcode
                )
                values
                (
                "' . $this->SanitizeForSQL($formvars['name']) . '",
                "' . $this->SanitizeForSQL($formvars['email']) . '",
                "' . $this->SanitizeForSQL($formvars['username']) . '",
                "' . md5($formvars['password']) . '",
                "' . $confirmcode . '"
                )';      
        	if(!mysql_query( $insert_query ,$this->connection))
        	{
            throw new Exception("Error inserting data to the table\nquery:$insert_query");
      	}        
        	return true;
		}
		
		function HandleDBError($err)
		{
      	throw new Exception($err."\r\n mysqlerror:".mysql_error());
		}
		
	}	
?>