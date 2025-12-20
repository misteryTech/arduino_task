<?php
// File to store data
$filename = "esp32_data.txt";

// Check if ESP32 sent a value via GET
if (isset($_GET['value'])) {
    $data = $_GET['value'];
    file_put_contents($filename, $data); // Save data to file
    echo "Data received: " . $data;
} else {
    // If no data sent, show last value
    if (file_exists($filename)) {
        echo "Last ESP32 value: " . file_get_contents($filename);
    } else {
        echo "No data received yet";
    }
}
?>
