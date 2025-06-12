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
                updateHrefs($path);
            }
        }
    }
}

// Function to update hrefs in a file
function updateHrefs($file) {
    $content = file_get_contents($file);
    
    // Update href attributes that point to .html files
    $content = preg_replace('/href="([^"]+)\.html"/', 'href="$1.php"', $content);
    
    // Write back to file
    file_put_contents($file, $content);
    echo "Updated hrefs in: $file\n";
}

// Start scanning from current directory
scanDirectory('.');

echo "All hrefs have been updated successfully!\n";
?> 