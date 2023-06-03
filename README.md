<h1>
<p>Andrew Ghaly
Steven Burroughs
CPSC 431-02 
Mdunite - Connecting Doctors with Suppliers</p>
</h1>
<h2>
<p>Website Description:</p>
<ul>
  <li>The user can register an account as either a doctor or a supplier</li>
  <li>Allows doctors and medical suppliers to advertise their practices to one another</li>
  <li>Doctors can search suppliers by their supplied material and suppliers can search doctors by their specialty</li>
  <li>Provides doctors and medical suppliers with the ability to message one another to learn more about the other person or book an appointment at a selected time</li>
  <li>Booked appointments can be accepted, declined or in-progress</li>
</ul>
</h2>
<h3>
<p>Project Specifications &amp; Requirements</p>
<ul>
<li><p>Landing Page</p>
<ul>
<li>Create Database Upon Viewing Page</li>
<li>Create Database Tables Upon Viewing Page</li>
<li>Added Navbar</li>
<li>Connected to Registration Page</li>
</ul>
</li>
<li><p>Login Page</p>
<ul>
<li>Checks for Email &amp; Password Credentials</li>
<li>Connects to the Registration Page</li>
<li>Display an error message if credentials don’t work</li>
</ul>
</li>
<li><p>Register Page</p>
<ul>
<li>Has a Dynamic User Type Field</li>
<li>Connects to Database to Register Users</li>
<li>Handles Errors</li>
</ul>
</li>
<li><p>Dashboard for Doctors</p>
<ul>
<li>Button for viewing edit profile</li>
<li>Button for filtering suppliers</li>
<li>Button for conversation list</li>
</ul>
</li>
<li><p>Dashboard for Suppliers</p>
<ul>
<li>Button for viewing edit profile</li>
<li>Button for filtering doctors</li>
<li>Button for conversation list</li>
</ul>
</li>
<li><p>Filter Page for Doctors</p>
<ul>
<li>Search by name</li>
<li>Search by zipcode</li>
<li>Search by supplier provision<ul>
<li>Can filter multiple provisions at once</li>
</ul>
</li>
</ul>
</li>
<li><p>Filter Page for Suppliers</p>
<ul>
<li>Search by name</li>
<li>Search by zipcode</li>
<li>Search by doctor speciality<ul>
<li>Can filter multiple specialties at once</li>
</ul>
</li>
</ul>
</li>
<li><p>Appointments Booking</p>
<ul>
<li>Date</li>
<li>Time</li>
<li>Notes</li>
</ul>
</li>
<li><p>Appointments View</p>
<ul>
<li>Outgoing<ul>
<li>Accepted Status</li>
<li>Rejected Status</li>
<li>Pending Status</li>
</ul>
</li>
<li>Incoming<ul>
<li>Accepted Status</li>
<li>Rejected Status</li>
<li>Approve Button</li>
<li>Deny Button</li>
</ul>
</li>
</ul>
</li>
<li><p>Conversation List</p>
<ul>
<li>Lookup specific user emails to start messaging</li>
<li>Keep user message history </li>
<li>Remove any specific user conversation</li>
</ul>
</li>
<li><p>Message Page</p>
<ul>
<li>Two way communication in real time between two users</li>
<li>Allow messages to be displayed as “read” or “unread”</li>
</ul>
</li>
<li><p>SQL Database</p>
<ul>
<li>Users<ul>
<li>Doctors</li>
<li>Suppliers</li>
</ul>
</li>
<li>Messages</li>
<li>Appointments</li>
</ul>
</li>
</ul>
</h3>
<hr>
<p>User Stories &amp; Test Cases</p>
<p>Step 1) Setup: Download and start XAMPP. If you don't have XAMPP installed, download it here: <a href="https://www.apachefriends.org/download.html">https://www.apachefriends.org/download.html</a></p>
<p>Step 2) Landing Page: Open up a browser and navigate to <a href="http://localhost/Andrew_Steven_Final_Project/code/landing.php">http://localhost/Andrew_Steven_Final_Project/code/landing.php</a></p>
![Figure 1: landing.php page](path/to/figure1.png)
<p>Elaboration:</p>
<p>When the landing.php page is viewed according to Figure 1, the php will automatically establish the “Andrew_Steven_DB” database, create all tables and add default data to the tables. If this page is viewed multiple times there won’t be any error generated and the database won’t change. One of the users created by default is Sarah Lee, which is the user that we will be logging in as later.</p>
<p>Functionality:</p>
<pre><code>
When the “Join MD Unite Now” button is clicked, the user will be redirected to the register.html page. If the “Login” navbar button is clicked, the user will be redirected to the login.html page.
</code></pre>
<p>Step 3) Registration Page: Either click the “Join MD Unite Now” navbar button on the landing.php page or simply navigate to <a href="http://localhost/Andrew_Steven_Final_Project/code/register.html">http://localhost/Andrew_Steven_Final_Project/code/register.html</a></p>
![Figure 2a: register.html page for type Doctor](path/to/figure2a.png)
![Figure 2b: register.html page for type supplier](path/to/figure2b.png)
<p>Elaboration:</p>
<pre><code>    All of the fields will have a red outline that indicates the field isn’t correctly filled in. Once all fields are accurately filled in, these descriptors will turn blue. When a field is clicked the descriptor is raised up, which leaves room for the user to type in information. If the user sets the “Contactable?” field to “Yes”, then the user will be searchable when other users visit the filtering page. If this value is set to “No”, then the user will not be searchable when other users visit the filtering page. If the user sets the “User Type” field to “Doctor”, then the page will look like Figure 2a. If the “User Type” field is set to “Supplier”, then the page will look like Figure 2b. The page will automatically retrieve a list of all specialties/provisions from all currently registered users and display them as a dropdown under that corresponding field for options to choose from.
</code></pre>
<p>Functionality:</p>
<pre><code>
Once all fields are filled out, the user may click the “Submit” button, which will submit the form to the database. The password field will be hashed and the hashed version of the password will be stored in the database.
If the account couldn’t be created, the registration form will clear all inputs and the user will remain on the same page. If the account was created successfully, the user will be redirected to the login.html page.
The user may click the “Home” navbar button, which will redirect the user back to the landing.php page or the user may click the “Login” navbar button to be redirected to the login.html page.
</code></pre>
<p>Step 4) Login Page: Once an account is created or the “Login” navbar button is pressed on one of the pages or the user navigates to <a href="http://localhost/Andrew_Steven_Final_Project/code/login.html">http://localhost/Andrew_Steven_Final_Project/code/login.html</a></p>
![Figure 3a: login.html page](path/to/figure3a.png)
![Figure 3b: login_error.html page](path/to/figure3b.png)
<p>Elaboration:</p>
<pre><code>
The user is initially directed to the login.html page (Figure 3a). Once the user types in an email and password and clicks “Login” the database will hash the password and compare it to the hashed password in the database.
If the credentials don’t exist in the database, the input fields will clear and the user will see an error (Figure 3b). Otherwise, the user will be redirected to the dashboard_supplier.php if they’re a registered supplier or the dashboard_doctor.php page if they’re a registered doctor.
</code></pre>
<p>Functionality:</p>
<pre><code>
If the user clicks the “Signup” button, the user will be redirected to the register.html page or if the user clicks the “Home” navbar button the user will be redirected to the landing.php page.
</code></pre>
<p>Note:</p>
<pre><code>
All default users in the database have a password value of password. In this case, the following pages will be showing data for the user Sarah Lee with login information email: sarahlee@yahoo.com and password: password.
</code></pre>
<p>Step 5) Dashboard Pages: Login with a valid email/password on the login.html page (this page cannot be accessed unless a user is logged in).</p>
![Figure 4a: dashboard_doctor.php](path/to/figure4a.png) (logged in “<a href="mailto:&#115;&#97;&#114;&#x61;&#104;&#x6c;&#x65;&#101;&#x40;&#x79;&#x61;&#104;&#x6f;&#111;&#x2e;&#x63;&#x6f;&#x6d;">&#115;&#97;&#114;&#x61;&#104;&#x6c;&#x65;&#101;&#x40;&#x79;&#x61;&#104;&#x6f;&#111;&#x2e;&#x63;&#x6f;&#x6d;</a>” with “password”)</p>
![Figure 4b: dashboard_supplier.php](path/to/figure4b.png) (logged in “<a href="mailto:&#x6b;&#105;&#x6d;&#x6b;&#105;&#x6d;&#64;&#x67;&#109;&#97;&#105;&#108;&#x2e;&#99;&#x6f;&#x6d;">&#x6b;&#105;&#x6d;&#x6b;&#105;&#x6d;&#64;&#x67;&#109;&#97;&#105;&#108;&#x2e;&#99;&#x6f;&#x6d;</a>” with “password”)</p>
<p>Elaboration:</p>
<pre><code>
If the user is a doctor, then the dashboard page will look like Figure 4a after the user logs in. If the user is a supplier, then the dashboard page will look like Figure 4b.
The only difference between these pages is that the doctor dashboard has a “Find Suppliers” button for searching for suppliers, whereas the supplier dashboard has a “Find Doctors” button for searching for doctors.
If the “Edit Profile” button is pressed, the user will be redirected to the edit_profile.html file.
If the “Find Doctors”/”Find Suppliers” button is pressed, the user will be redirected to filter_doctors.html or the filter_suppliers.html page respectively.
If the user clicks the “Messaging” page, the user will be redirected to the conversations.html page.
</code></pre>
<p>Functionality:</p>
<pre><code>
If the user clicks the “Home” navbar button or the “Logout” navbar button then the user will be sent to the landing.php page or the logout.php page.
The logout page will automatically terminate the php session and redirect the user to the login.html page.
</code></pre>
<p>Step 6) Find Doctors/Find Suppliers Page: Click on the “Find Doctors” or “Find Suppliers” button from the dashboard page.</p>
![Figure 5a: filter_suppliers.php](path/to/figure5a.png) (logged in “<a href="mailto:&#x73;&#x61;&#x72;&#x61;&#104;&#108;&#x65;&#101;&#64;&#121;&#x61;&#x68;&#111;&#x6f;&#x2e;&#x63;&#x6f;&#x6d;">&#x73;&#x61;&#x72;&#x61;&#104;&#108;&#x65;&#101;&#64;&#121;&#x61;&#x68;&#111;&#x6f;&#x2e;&#x63;&#x6f;&#x6d;</a>” with “password”)</p>
![Figure 5b: filter_doctors.php](path/to/figure5b.png) (logged in “<a href="mailto:&#x6b;&#105;&#109;&#107;&#105;&#109;&#64;&#x67;&#x6d;&#x61;&#x69;&#108;&#46;&#x63;&#x6f;&#x6d;">&#x6b;&#105;&#109;&#107;&#105;&#109;&#64;&#x67;&#x6d;&#x61;&#x69;&#108;&#46;&#x63;&#x6f;&#x6d;</a>” with “password”)</p>
<p>Elaboration:</p>
<pre><code>
The user may fill in the fields for “Name”, “Zipcode” and “Specialty”/”Provision”. Every field that’s inputted will be a constraint on the query that’s made in the back end.
Simply clicking the “Submit” button will search for all users of that category (depending on which user type is being filtered). Once the form is submitted, the results will appear under “Results”.
The resulting user information that’s returned will have a hyperlink attached to the “Name” field which leads to the profile.html page to view that user’s information.
The page will automatically retrieve a list of all specialties/provisions from all currently registered users and display them as a dropdown under that corresponding field for options to choose from when filtering the users.
</code></pre>
<p>Functionality:</p>
<pre><code>
Clicking the “My Profile” navbar button leads to the edit_profile.html file and clicking the “Logout” navbar button leads to the logout.php file.
</code></pre>
<p>Step 7) Profile Page: Once a user’s information is returned from the filtering page, click on the user’s name.</p>
![Figure 6: profile.html page](path/to/figure6.png) (after clicking on “John Smith” on filter_suppliers.html page)</p>
<p>Elaboration:</p>
<pre><code>
This page shows extra user information about a particular user returned from the filtering page. There’s a “userID” parameter in the URL that’s provided so that the page knows the user information to load.
If the user clicks the “Messages” button the user is redirected to the conversations.html page. If the user clicks the “Appointments” button the user is redirected to the appointment.html file.
</code></pre>
<p>Functionality:</p>
<pre><code>
If the user clicks the ”My Profile” navbar button the user is redirected to the edit_profile.html page. If the user clicks the “Logout” navbar button the user is redirected to the logout.php file.
</code></pre>
<p>Step 8) Appointments Booking: Click the “Appointments” button on the profile.html page.</p>
![Figure 7: appointment.html](path/to/figure7.png)
<p>Elaboration:</p>
<pre><code>
There’s a “userID” parameter in the URL that’s provided so that the page knows which user the appointment is being created with.
The user can click the button on the right side of the “Date” field to select a date and the same can be done for the “Time” field.
The “Additional Details” field can be filled in with information about the appointment and then when the “Submit” button is clicked the appointment is created in the database, the user is notified that the appointment was created and the user will be redirected to the appointmentView.html page.
</code></pre>
<p>Functionality:</p>
<pre><code>
If the user clicks the “My Profile” page, the user will be redirected to the edit_profile.html page. If the user clicks the “Logout” navbar button the user will be redirected to the logout.php file.
</code></pre>
<p>Step 9) Edit Profile Page: The user can click the “Edit Profile” button on the dashboard page or click “My Profile” in the navbar of one of the various pages.</p>
![Figure 8: edit_profile.html](path/to/figure8.png) (logged in “<a href="mailto:&#x73;&#97;&#114;&#97;&#104;&#108;&#101;&#101;&#x40;&#121;&#97;&#x68;&#111;&#111;&#46;&#99;&#111;&#109;">&#x73;&#97;&#114;&#97;&#104;&#108;&#101;&#101;&#x40;&#121;&#97;&#x68;&#111;&#111;&#46;&#99;&#111;&#109;</a>” with “password”)</p>
<p>Elaboration:</p>
<pre><code>
Upon viewing the page, the current user’s information will be loaded from the php session. The three editable fields are “Full Name”, “Zipcode” and “Contactable”.
When the user changes one or more of these fields and clicks “Make Changes”, the page will automatically send the updated data to the database to modify that user’s information and the user will remain on the same page after the modification takes place.
</code></pre>
<p>Functionality:</p>
<pre><code>
If the user clicks the “Messages” button the user will be redirected to the conversations.html page. If the user clicks the “Appointments” button the user will be redirected to the appointmentView.html page.
If the user clicks the “Dashboard” navbar button the user will be redirected to the corresponding dashboard page. If the user clicks the “Logout” button the user will be redirected to the logout.php file.
</code></pre>
<p>Step 10) Appointments View Page: Click the “Appointments” button on the edit_profile.html page or fill out and submit an appointment on the appointment.html page.</p>
![Figure 9: appointmentView.html](path/to/figure9.png) (logged in “<a href="mailto:&#115;&#97;&#x72;&#x61;&#104;&#108;&#101;&#101;&#x40;&#x79;&#x61;&#x68;&#111;&#111;&#x2e;&#99;&#x6f;&#109;">&#115;&#97;&#x72;&#x61;&#104;&#108;&#101;&#101;&#x40;&#x79;&#x61;&#x68;&#111;&#111;&#x2e;&#99;&#x6f;&#109;</a>” with “password”)</p>
<p>Elaboration:</p>
<pre><code>

For incoming appointments, the “Full name”, “From Email”, “Zipcode” and “Datetime” are retrieved from the appointment data in the database.
For outgoing appointments this is the same except the “From Email” becomes “To Email”. The status of the appointment is determined as follows:

Incoming appointments:

- If the received appointment is pending (i.e. when the current user hasn’t accepted/denied the request), then there will be an “Accept” and “Deny” button next to the appointment.
- If the current user has clicked the “Accept” button, then a green checkmark will appear next to the appointment. If the current user has clicked the “Deny” button, then a red X will appear next to the appointment.

Outgoing appointments:

- Everything here is the same as it was for incoming appointments, except if the outgoing appointment is pending (waiting for the other user to respond to the appointment request) then a yellow minus symbol will appear next to the appointment.
</code></pre>
<p>Functionality:</p>
<pre><code>
If the user clicks the “My Profile” navbar button, the user is redirected to the edit_profile.html page. If the user clicks the “Logout” navbar button, the user is redirected to the logout.php file.
</code></pre>
<p>Step 11) Conversation List: Click on the “Appointments” button on the edit_profile.html page or the profile.html page. Another way to access this page is by clicking the “Messaging” button on the dashboard page.</p>
![Figure 10: conversations.html](path/to/figure10.png)
<p>Elaboration:</p>
<pre><code>
This page allows the user to create a new conversation with another user via email. If an email is inputted into the email lookup field and searched, the email will be moved to a list on the right-hand side of the page.
If the user clicks the “View” page, the user is redirected to the messaging.html page. If the user clicks the “Remove” button, that entire conversation (all messages sent between the two users) will be deleted between the two users.
If the page is ever refreshed, all conversations will be loaded from the database. The email of the other user is loaded if and only if there exists at least one message between the two users.
If a user is added to the list but a message isn’t sent to that user, then refreshing the screen will cause that user to vanish from the list since a conversation wasn’t started between the two people.
If one user starts a conversation with another user, that other user will see the email of the user who sent the message to them and can view/delete that conversation.
</code></pre>
<p>Functionality:</p>
<pre><code>
If the user clicks the “My Profile” navbar button, the user is redirected to the edit_profile.html page. If the user clicks the “Logout” navbar button the user is redirected to the logout.php file.
</code></pre>
<p>Step 12) Message Page: Click the “View” button for an existing email in the list on the conversations.html page.</p>
![Figure 11: messaging.html](path/to/figure_11.png) (logged in “<a href="mailto:&#115;&#97;&#114;&#97;&#x68;&#x6c;&#101;&#x65;&#x40;&#x79;&#97;&#104;&#111;&#111;&#x2e;&#99;&#111;&#x6d;">&#115;&#97;&#114;&#97;&#x68;&#x6c;&#101;&#x65;&#x40;&#x79;&#97;&#104;&#111;&#111;&#x2e;&#99;&#111;&#x6d;</a>” with “password” and viewing the messages of the user “<a href="mailto:&#106;&#111;&#x68;&#x6e;&#115;&#109;&#105;&#x74;&#104;&#x40;&#x67;&#109;&#97;&#105;&#108;&#x2e;&#99;&#111;&#109;">&#106;&#111;&#x68;&#x6e;&#115;&#109;&#105;&#x74;&#104;&#x40;&#x67;&#109;&#97;&#105;&#108;&#x2e;&#99;&#111;&#109;</a>”)</p>
<p>Elaboration:</p>
<pre><code>
When a message is typed in and the send button is clicked, a message is sent to the other user.
Once the message is sent, it will simultaneously update the database and the user interface, however the user will have to refresh their screen if they want to get updated messages from the other user since the only time the user interface updates is when the page is reloaded or when the current user sends another user a message.
Each message is either “read” or “unread” depending on if the other user has viewed the message yet. Every message that’s initially sent will be displayed as “unread”, but once the other user refreshes his page the message will change to “read”. 
</code></pre>
<p>Functionality:</p>
<pre><code>
If the user clicks the “My Profile” navbar button, the user is redirected to the edit_profile.html page. If the user clicks the “Logout” navbar button the user is redirected to the logout.php file.
</code></pre>
