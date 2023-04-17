<!-- This functionality is primarily for the "Available Dates/Times"
     portion of the "Edit Profile" page -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Select Date</title>
    <style>
      /* CSS code here */
      body {
        font-family: Arial, sans-serif;
        background-color: #FFA726;
      }
      
      .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 50px;
      }
      
      label {
        font-size: 16px;
        margin-bottom: 10px;
      }
      
      input[type="date"] {
        font-size: 16px;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
        margin-bottom: 20px;
      }
      
      .button {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 8px;
      }
      
      .button:hover {
        background-color: #3e8e41;
      }
      
      h1 {
        color: #800020;
        text-align: center;
        margin-top: 50px;
      }
    </style>
  </head>
  <body>
    <h1>Select Date</h1>
    <div class="container">
      <form>
        <label for="date">Select a date:</label>
        <input type="date" id="date" name="date">
        <button type="button" class="button" onclick="confirmDate()">Confirm</button>
      </form>
    </div>
    <script>
      function confirmDate() {
        const selectedDate = document.getElementById("date").value;
        alert(`You selected ${selectedDate}`);
      }
    </script>
  </body>
</html>
