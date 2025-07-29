<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visit Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn-container {
            text-align: center;
        }
        .btn {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #218838;
        }
        .success-message {
            text-align: center;
            color: #28a745;
            font-weight: bold;
            display: none;
            margin-top: 20px;
        }
        #qrCode {
            display: none;
            text-align: center;
            margin-top: 20px;
        }
        #fillingMessage {
            display: none;
            text-align: center;
            color: #007bff;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Confirm Your Visit</h1>

        <div id="fillingMessage">⏳ Filling up your details and processing payment...</div>

            <form id="visitForm" action="save_booking.php" method="POST">
            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" name="fullName" required>
            
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" required>
            
            <label for="address">Address:</label>
            <textarea id="address" name="address" rows="4" required></textarea>
            
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required>
            
            <label for="travelDate">Preferred Travel Date:</label>
            <input type="date" id="travelDate" name="travelDate" required>

            <label for="returnDate">Return Date:</label>
            <input type="date" id="returnDate" name="returnDate" required>
            
            <label for="adults">Number of Adults:</label>
            <input type="number" id="adults" name="adults" min="0" required>

            <label for="children">Number of Children:</label>
            <input type="number" id="children" name="children" min="0" required>

            <label for="paymentMethod">Payment Method:</label>
            <select id="paymentMethod" name="paymentMethod" required>
                <option value="">-- Select Payment Method --</option>
                <option value="Paytm">Paytm</option>
                <option value="GPay">GPay</option>
            </select>

            <div class="btn-container">
<button type="submit" class="btn">Confirm Booking</button>
            </div>
        </form>

        <div id="qrCode">
            <p>Scan the QR Code to complete payment:</p>
            <img src="qr.png" alt="QR Code" width="200">
        </div>

        <div class="success-message" id="successMessage">
            🎉 Your visit has been successfully confirmed! We look forward to welcoming you to Wander Vista! 🏞️
        </div>

        <div id="totalAmount" style="text-align: center; margin-top: 20px; font-weight: bold; font-size: 18px;"></div>
    </div>

    <script>
        function calculateTotal() {
            const adults = parseInt(document.getElementById('adults').value) || 0;
            const children = parseInt(document.getElementById('children').value) || 0;
            const travelDate = new Date(document.getElementById('travelDate').value);
            const returnDate = new Date(document.getElementById('returnDate').value);
            const paymentMethod = document.getElementById('paymentMethod').value;

            if (!paymentMethod) {
                alert("Please select a payment method.");
                return;
            }

            const adultPrice = 1000;
            const childPrice = 800;
            const partyPrice = 500;

            const days = (returnDate - travelDate) / (1000 * 60 * 60 * 24);
            if (days < 0) {
                alert("Return date must be after travel date.");
                return;
            }

            const dailyCharge = days * 500;
            const total = (adults * adultPrice) + (children * childPrice) + partyPrice + dailyCharge;

            if (adults + children > 0) {
                document.getElementById('fillingMessage').style.display = 'block';
                setTimeout(() => {
                    document.getElementById('visitForm').style.display = 'none';
                    document.getElementById('qrCode').style.display = 'block';
                    document.getElementById('successMessage').style.display = 'block';
                    document.getElementById('totalAmount').innerText = `Total Amount: ₹${total} (₹1000 per adult, ₹800 per child, ₹500 for the party, and ₹500 per day for ${days} days)`;
                    document.getElementById('fillingMessage').style.display = 'none';
                }, 1500);
            } else {
                alert('Please add at least one guest!');
            }
        }
    </script>
</body>
</html>
