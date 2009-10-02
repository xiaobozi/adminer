<?php
function dump_table($table) {
	echo "\xef\xbb\xbf"; // UTF-8 byte order mark
}

function dump_data($table, $style, $select = "") {
	global $connection;
	$result = $connection->query(($select ? $select : "SELECT * FROM " . idf_escape($table)), 1); // 1 - MYSQLI_USE_RESULT
	if ($result) {
		while ($row = $result->fetch_assoc()) {
			dump_csv($row);
		}
	}
}

function dump_headers($identifier) {
	$filename = (strlen($identifier) ? friendly_url($identifier) : "dump");
	$ext = "csv";
	header("Content-Type: text/csv; charset=utf-8");
	header("Content-Disposition: attachment; filename=$filename.$ext");
	session_write_close();
	return $ext;
}
