<?php

if (isset($_GET['file'])) {
    $file = basename($_GET['file']); // Extract file name and sanitize
    $file_path = "C:/wamp64/www/ess_dms/uploads/" . $file;

    // Debugging: Output the file path and check if the file exists
    error_log("Requested file: $file");
    error_log("File path: $file_path");

    if (file_exists($file_path)) {
        error_log("File exists: $file_path");
    } else {
        error_log("File does not exist: $file_path");
    }

    if (file_exists($file_path) && is_readable($file_path)) {
        // Determine Content-Type based on file extension
        $file_info = pathinfo($file_path);
        $extension = strtolower($file_info['extension']);
        error_log("File extension: $extension");

        switch ($extension) {
            case 'pdf':
                $content_type = 'application/pdf';
                break;
            case 'doc':
            case 'docx':
                $content_type = 'application/msword';
                break;
            case 'png':
                $content_type = 'image/png';
                break;
            case 'jpg':
            case 'jpeg':
                $content_type = 'image/jpeg';
                break;
            // Add more cases for additional file types if needed
            default:
                $content_type = 'application/octet-stream';
        }

        error_log("Content-Type: $content_type");

        header("Content-Type: $content_type");
        header("Content-Disposition: inline; filename=\"$file\"");
        readfile($file_path);
        exit; // Stop execution after file is displayed
    } else {
        header("HTTP/1.0 404 Not Found");
        error_log("Error 404: File Not Found: $file_path");
        echo "<h1>Error 404: File Not Found: <br /><em>$file</em></h1>";
    }
} else {
    header("HTTP/1.0 400 Bad Request");
    echo "<h1>Error 400: Bad Request</h1>";
}
?>
