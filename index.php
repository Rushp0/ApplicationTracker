<!DOCTYPE html>
<html>
    
    <head>
        <title>Interview Tracker</title>
        <!-- CSS Files -->
        <link rel="stylesheet" type="text/css" href="./style/style.css">
        <!-- Icon Styling Sheet -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        
        <!-- JavaScript Files -->
        <script src="scripts/scripts.js"></script>
    </head>

    <body>
        <div id="top-banner">
            <p>Internship Application Tracker</p>
        </div>

        <!-- Application Summary -->
        <div id="application-summary">
            <div class="card" id="submitted-card" onclick="sortBy(1)">
                <p id="submitted-count"></p>
                <p>Submitted</p>
            </div>
            <div class="card" id="denied-card" onclick="sortBy(2)">
                <p id="denied-count"></p>
                <p>Denied</p>
            </div>
            <div class="card" id="viewed-card" onclick="sortBy(3)">
                <p id="viewed-card"></p>
                <p>Viewed</p>
            </div>
            <div class="card" id="accepted-card" onclick="sortBy(4)">
                <p id="accepted-count"></p>
                <p>Accepted</p>
            </div>
        </div>

        <!-- All Applications -->
        <div id="all-applications">
            <p id="all-application-title" onclick="sortBy(5)">All Applications</p>

            <!-- Search Icon -->
            <span class="material-symbols-outlined" style="position:absolute; left: 6%; top: 41%; cursor:pointer;" onclick="showHideSearchBar()">search</span>
            <!-- Search Bar -->
            <input type="text" id="search-bar" placeholder="Search Applications" onKeyUp="search()">
            
            <!-- Add Application Icon -->
            <span class="material-symbols-outlined" style="font-size:24px;position:absolute;left:93%;top:38%;cursor:pointer;" onclick="showAddApplicationModel()">add_circle</span>
                
            <!-- Table to Display All Application -->
            <table id="application-table"></table>
        </div>

        <!-- Modals -->

        <!-- Add Application Modal -->
        <div class="modal" id="add-application-modal">
            <p>Add Application</p>
            <form action="scripts/addApplication.php" method="post">
                <input type="text" id="add-company-name" placeholder="Company Holder" name="add-company-name">
                <select id="add-status-dropdown" name="add-status-dropdown">
                    <option value="Select Status">Select Status</option>
                    <option value="Submitted">Submitted</option>
                    <option value="Denied">Denied</option>
                    <option value="Viewed">Viewed</option>
                    <option value="Accepted">Accepted</option>
                </select>
                <input type="text" id="add-application-platform" placeholder="Application Platorm" name="add-application-platform">
                <input type="date" id="add-submission-date" name="add-submission-date">
                <input type="submit">
                <button type="button" name="cancel" class="cancel" onclick="closeAddApplicationModal()">Cancel</button>
            </form>
        </div>

        <!-- Edit Application Modal -->
        <div class="modal" id="edit-application-modal">
            <p id="text">Edit Application</p>
            <form action="scripts/editApplication.php" method="post">
                <input type="text" id="edit-company-name" placeholder="Company Holder" name="edit-company-name" readonly>
                <input type="hidden" name="application-key" id="application-key"> 
                <select id="edit-status-dropdown" name="edit-status-dropdown">
                    <option value="Select Status">Select Status</option>
                    <option value="Submitted">Submitted</option>
                    <option value="Denied">Denied</option>
                    <option value="Viewed">Viewed</option>
                    <option value="Accepted">Accepted</option>
                </select>
                <input type="text" id="edit-application-platform" placeholder="Application Platorm" name="edit-application-platform">
                <input type="date" id="edit-submission-date" name="edit-submission-date">
                <input type="submit">
                <button type="button" name="delete" class="delete" onclick="deleteApplication()">Delete Application</button>
                <button type="button" name="cancel" class="cancel" onclick="closeEditApplicationModal()">Cancel</button>
            </form>
        </div>

    </body>

</html>