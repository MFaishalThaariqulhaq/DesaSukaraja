<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Get DB connection via container
$db = $app->make('db');
try {
  $col = $db->select("SHOW COLUMNS FROM pengaduans LIKE 'email'");
  if (!count($col)) {
    echo "Column 'email' not found in 'pengaduans' table\n";
    exit(1);
  }
  $row = (array)$col[0];
  echo "Field: " . ($row['Field'] ?? $row['field'] ?? 'email') . "\n";
  echo "Type: " . ($row['Type'] ?? $row['type'] ?? '') . "\n";
  echo "Null: " . ($row['Null'] ?? $row['null'] ?? '') . "\n";

  $isNullable = (strtoupper($row['Null'] ?? $row['null'] ?? '') === 'YES');
  if ($isNullable) {
    echo "Already nullable. No change needed.\n";
    exit(0);
  }

  echo "Not nullable — attempting to ALTER TABLE to make it NULLABLE...\n";
  $db->statement("ALTER TABLE `pengaduans` MODIFY `email` VARCHAR(255) NULL;");
  echo "ALTER executed. Re-checking...\n";
  $col2 = $db->select("SHOW COLUMNS FROM pengaduans LIKE 'email'");
  $row2 = (array)$col2[0];
  echo "Null after change: " . ($row2['Null'] ?? $row2['null'] ?? '') . "\n";
  echo "Done.\n";
} catch (Exception $e) {
  echo "Error: " . $e->getMessage() . "\n";
  exit(1);
}
