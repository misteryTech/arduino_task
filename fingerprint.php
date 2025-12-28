<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fingerprint Verification</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        button { padding: 15px 30px; font-size: 18px; cursor: pointer; }
        #status { margin-top: 20px; font-size: 20px; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Fingerprint Verification</h1>
    <button onclick="triggerFingerprint()">Verify Fingerprint</button>
    <div id="status">Waiting for trigger...</div>

    <script>
        const ESP32_IP = "http://192.168.1.102"; // Replace with your ESP32 IP
        const userInfo = {
            2: "Hello! ID 2 matched — Welcome!"
        };

        function triggerFingerprint() {
            const statusDiv = document.getElementById("status");
            statusDiv.innerText = "Waiting for finger...";

            fetch(`${ESP32_IP}/trigger`)
                .then(response => response.json())
                .then(data => {
                    if (data.match) {
                        const msg = userInfo[data.finger_id] || `✅ Fingerprint MATCH! ID: ${data.finger_id}`;
                        statusDiv.innerText = msg;
                    } else {
                        statusDiv.innerText = "❌ No match found.";
                    }
                })
                .catch(err => {
                    console.error(err);
                    statusDiv.innerText = "❌ Error connecting to ESP32.";
                });
        }
    </script>
</body>
</html>
