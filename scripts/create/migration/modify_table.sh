#!/bin/bash

migration_directory="./database/migrations/"

# Check if a path was provided as an argument
if [ -z "$1" ]; then
  echo "Please provide the full path or filename."
  exit 1
fi

# Get the full file path or filename provided by the user
full_path="${migration_directory}${1}.php"

# Extract the directory and filename from the provided path
directory=$(dirname "$full_path")
filename=$(basename "$full_path" .php)

# Get the current date and time in the format YYYYMMDDHHMMSS (without dashes or underscores)
datetime=$(date +"%Y%m%d%H%M%S")

# If no directory is provided (i.e., directory is "."), default to the current directory
if [ "$directory" = "." ]; then
  directory=$(pwd)  # Use the current working directory
fi

# Construct the new filename by prepending the date and time to the original filename
new_filename="${datetime}_modify_${filename}_table.php"

# Create the file with the new filename in the specified or current directory
cat <<EOL > "$directory/$new_filename"
<?php

require_once "util/database/DbMigration.php";

\$migration = new DbMigration('$filename');

// Rename A Column
// \$migration->renameColumn('old_name', 'new_name', 'type');

// Modify column's type and/or its constraints
// \$migration->modifyColumn('column_name','type', ...other_constraints);

// Delete a column
// \$migration->dropColumn('column_name');

// Drop the primary key
// \$migration->dropPrimaryKey();

// Drop a foreign key
// \$migration->dropForeignKey('column_name');

// Add a column
// \$migration->addColumn('column_name','type', ...other_constraints);

echo \$migration->modify();
EOL

# Output a message to confirm file creation
printf "\nMigration file '$directory/$new_filename' has been created."
