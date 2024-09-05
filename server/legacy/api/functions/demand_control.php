<?php
function missingValues($data, $requiredKeys)
{
  $missingKeys = array_diff($requiredKeys, array_keys($data));

  if (!empty($missingKeys)) {
    return [true, $missingKeys];
  } else {
    return [false];
  }
}
include "/xampp/htdocs/api/functions/get_demand.php";
include "/xampp/htdocs/api/functions/create/create_demand.php";
include "/xampp/htdocs/api/functions/update_demand.php";
include "/xampp/htdocs/api/functions/delete_demand.php";