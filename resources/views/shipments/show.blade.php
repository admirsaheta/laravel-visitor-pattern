<!DOCTYPE html>
<html>
<head>
    <title>Shipment Details</title>
</head>
<body>
    <h1>Shipment Details</h1>
    <p>Tracking Number: {{ $shipment->tracking_number }}</p>
    <p>Sender: {{ $shipment->sender }}</p>
    <p>Receiver: {{ $shipment->receiver }}</p>
    <p>Status: {{ $status }}</p>
</body>
</html>