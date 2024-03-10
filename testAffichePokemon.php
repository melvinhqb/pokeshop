<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // Specify the directory where your images are stored
    $imageDir = 'Photos/EV/MEW/';

    // Open the directory
    $dir = opendir($imageDir);

    // Loop through each file in the directory
    while (($file = readdir($dir)) !== false) {
        // Check if the file is an image (you can add more image formats if needed)
        if (preg_match('/.jpg$/', $file)) {
            // Display the image
            echo '<img src="' . $imageDir . $file . '" alt="' . $file . '" />';
        }
    }

    // Close the directory
    closedir($dir);
    ?>
</body>
</html>
