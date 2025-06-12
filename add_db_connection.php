<?php
// Function to recursively scan directory
function scanDirectory($dir) {
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        
        $path = $dir . '/' . $file;
        if (is_dir($path)) {
            scanDirectory($path);
        } else {
            // Only process PHP files
            if (pathinfo($path, PATHINFO_EXTENSION) === 'php') {
                addDatabaseConnection($path);
            }
        }
    }
}

// Function to add database connection to a file
function addDatabaseConnection($file) {
    $content = file_get_contents($file);
    
    // Check if the file already has the database connection
    if (strpos($content, "require_once 'config/database.php';") === false) {
        // Add database connection after the opening PHP tag or at the start of the file
        if (strpos($content, '<?php') !== false) {
            $content = str_replace('<?php', "<?php\nrequire_once 'config/database.php';", $content);
        } else {
            $content = "<?php\nrequire_once 'config/database.php';\n?>\n" . $content;
        }
        
        // Write back to file
        file_put_contents($file, $content);
        echo "Added database connection to: $file\n";
    } else {
        echo "Database connection already exists in: $file\n";
    }
}

// Start scanning from current directory
scanDirectory('.');

echo "All files have been updated successfully!\n";
?> 