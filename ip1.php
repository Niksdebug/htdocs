<?php
// Check if the form has been submitted using POST method and if 'ip_address' field is set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ip_address'])) {
    // Replace 'YOUR_API_KEY' with your actual IPinfo API key
    $apiKey = 'd9c23b2fd62bc1';

    // Create a cURL request to the IPinfo API to get IP details
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://ipinfo.io/{$_POST['ip_address']}?token={$apiKey}");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Decode the JSON response
    $ipDetails = json_decode($response, true);
}
?>


<!DOCTYPE html>

<html>

<head>
    <title>IP Address Tracking Tool</title>
    <link rel="stylesheet" href="style.css">    
</head>

<body>

    
    <h1>IP Address Tracking Tool</h1>
    <!-- IP tracking form -->
    <form method="post" autocomplete="on">
        <label for="ip_address">Enter IP Address:</label>
        <!-- The default value for the input field is set to the visitor's IP address using $_SERVER['REMOTE_ADDR'] -->
        <input type="text" id="ip_address" name="ip_address"  required>
        &nbsp;
        <button type="submit">Track IP</button>
    </form>

    <!-- If IP details are available, display them -->
    <?php if (isset($ipDetails)): ?>
        <h2>IP Details:</h2>
        <p>
            <strong>IP Address:</strong> <?php echo isset($ipDetails['ip']) ? $ipDetails['ip'] : 'N/A'; ?><br>
            <!-- Display hostname if available, otherwise show 'N/A' -->
            <strong>Hostname:</strong> <?php echo $ipDetails['hostname'] ?? 'N/A'; ?><br>
            <!-- Display city if available, otherwise show 'N/A' -->
            <strong>City:</strong> <?php echo $ipDetails['city'] ?? 'N/A'; ?><br>
            <!-- Display region if available, otherwise show 'N/A' -->
            <strong>Region:</strong> <?php echo $ipDetails['region'] ?? 'N/A'; ?><br>
            <!-- Display country if available, otherwise show 'N/A' -->
            <strong>Country:</strong> <?php echo $ipDetails['country'] ?? 'N/A'; ?><br>
            <!-- Display postal code if available, otherwise show 'N/A' -->
            <strong>Postal Code:</strong> <?php echo $ipDetails['postal'] ?? 'N/A'; ?><br>
            <!-- Display timezone if available, otherwise show 'N/A' -->
            <strong>Timezone:</strong> <?php echo $ipDetails['timezone'] ?? 'N/A'; ?><br>
            <!-- Display ISP if available, otherwise show 'N/A' -->
            <strong>ISP:</strong> <?php echo $ipDetails['org'] ?? 'N/A'; ?><br>
        </p>
    <?php endif; ?>
</body>

</html>
