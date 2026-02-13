<?php
// Force Clear Cache and Redirect
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

// Clear opcache if available
if (function_exists('opcache_reset')) {
    opcache_reset();
}

echo "<!DOCTYPE html>
<html>
<head>
    <meta http-equiv='Cache-Control' content='no-cache, no-store, must-revalidate'>
    <meta http-equiv='Pragma' content='no-cache'>
    <meta http-equiv='Expires' content='0'>
    <script>
        // Clear cache dan redirect
        setTimeout(function() {
            window.location.href = 'landing.php?nocache=' + new Date().getTime();
        }, 1000);
    </script>
</head>
<body>
    <h2>🔄 Clearing cache...</h2>
    <p>Redirecting in 1 second...</p>
</body>
</html>";
?>
