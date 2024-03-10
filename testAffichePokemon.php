<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Style for the plus icon */
        .image-container {
            position: relative;
            display: inline-block;
            overflow: hidden;
            transition: transform 0.3s ease, margin 0.3s ease;
            margin: 20px;
            cursor: pointer;
            border-radius: 20px;
        }

        .image-container:hover {
            transform: scale(1.1) rotateX(var(--rotation-angle-x)) rotateY(var(--rotation-angle-y));
            margin: 10px;
            z-index: 1;
        }

        .image-container img {
            display: block;
            width: 100%;
            height: auto;
            border-radius: 20px;
        }

        .image-container:hover::after {
            content: '+';
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 5px;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <br><br><br>
    <?php
    // Specify the directory where your images are stored
    $imageDir = 'Photos/EV/MEW/';

    // Open the directory
    $dir = opendir($imageDir);

    // Initialize an empty array to store image filenames
    $imageFiles = [];

    // Loop through each file in the directory
    while (($file = readdir($dir)) !== false) {
        // Check if the file is an image (you can add more image formats if needed)
        if (preg_match('/.jpg$/', $file)) {
            // Store the image filename in the array
            $imageFiles[] = $file;
        }
    }

    // Close the directory
    closedir($dir);

    // Loop through the array of image filenames and display the images
    foreach ($imageFiles as $filename) {
        echo '<a href="cart.html">';
        echo '<div class="image-container" style="--rotation-angle-x: 0; --rotation-angle-y: 0;">';
        echo '<img src="' . $imageDir . $filename . '" alt="' . $filename . '" />';
        echo '</div>'; // Close the image-container div
        echo '</a>'; // Close the link
    }
    ?>

    <script>
        document.querySelectorAll('.image-container').forEach(function(container) {
            container.addEventListener('mousemove', function(event) {
                // Get the width and height of the image container
                var containerWidth = container.offsetWidth;
                var containerHeight = container.offsetHeight;
                // Calculate the rotation angles based on the cursor position
                var rotationAngleX = (event.clientY - container.getBoundingClientRect().top - (containerHeight / 2)) / containerHeight * 30;
                var rotationAngleY = (event.clientX - container.getBoundingClientRect().left - (containerWidth / 2)) / containerWidth * -30;
                // Set the custom properties to update the rotation angles
                container.style.setProperty('--rotation-angle-x', rotationAngleX + 'deg');
                container.style.setProperty('--rotation-angle-y', rotationAngleY + 'deg');
            });
        });

        document.querySelectorAll('.image-container').forEach(function(container) {
            container.addEventListener('click', function(event) {
                // Get the click position relative to the container
                var clickX = event.clientX - container.getBoundingClientRect().left;
                var clickY = event.clientY - container.getBoundingClientRect().top;
                // Check if the click is within the top left 80px * 80px square
                if (clickX <= 80 && clickY <= 80) {
                    // Redirect to details1.html if clicked on the top left
                    window.location.href = 'details1.html';
                } else {
                    // Redirect to cart.html if clicked anywhere else
                    window.location.href = 'cart.html';
                }
            });
        });
    </script>
</body>
</html>
