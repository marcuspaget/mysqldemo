# mysqldemo



- run_q.php - presents form to submit request
- genericQuery_defaults.inc - just contains the default db and table for form filing  in run_q.php
--
- genericQuery.php is an example of calling the functions defined in mysql_qry.inc - this is the view and controller
	- pulls together all the requests and ensures correct etc before call the functions
	- pulls in genericQuery_defaults.inc 
	- pulls in mysql_qry.inc 
- mysql_qry.inc contains the main function to do the queries and dumps - this is the model
