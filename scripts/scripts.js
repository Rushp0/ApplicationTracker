currentKey = null;

window.onload = function(){
    displayAllApplication();
    displayViewedSummary();
    displaySubmittedSummary();
    displayDeniedSummary();
    displayAcceptedSummary();
}

// Display Applications Table
function displayAllApplication(){
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("application-table").innerHTML = this.responseText;
        }
    }
    xhttp.open("GET", "./scripts/displayAllApplications.php", true);
    xhttp.send();
}

// Display Summaries Functions
function displayViewedSummary(){
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("viewed-card").innerHTML = this.responseText;
        }
    }
    xhttp.open("GET", "./scripts/displaySummary/displayViewedSummary.php", true);
    xhttp.send();
}
function displaySubmittedSummary(){
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("submitted-card").innerHTML = this.responseText;
        }
    }
    xhttp.open("GET", "./scripts/displaySummary/displaySubmittedSummary.php", true);
    xhttp.send();
}
function displayDeniedSummary(){
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("denied-card").innerHTML = this.responseText;
        }
    }
    xhttp.open("GET", "./scripts/displaySummary/displayDeniedSummary.php", true);
    xhttp.send();
}
function displayAcceptedSummary(){
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("accepted-card").innerHTML = this.responseText;
        }
    }
    xhttp.open("GET", "./scripts/displaySummary/displayAcceptedSummary.php", true);
    xhttp.send();
}

// Add Application Modal Functions
function showAddApplicationModel(){
    var modal = document.getElementById("add-application-modal");
    modal.style.visibility="visible";
}
function closeAddApplicationModal(){
    var modal = document.getElementById("add-application-modal");
    modal.style.visibility="hidden";
}

// Edit Application Modal Functions
function closeEditApplicationModal(){
    var modal = document.getElementById("edit-application-modal");
    modal.style.visibility="hidden";
    currentKey = null;
}
function edit(key){
    currentKey = key;
    var modal = document.getElementById("edit-application-modal");
    modal.style.visibility = "visible";
    
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            const results = JSON.parse(this.responseText);
            document.getElementById("edit-company-name").value = results["company"];
            document.getElementById("edit-status-dropdown").value = results["status"];
            document.getElementById("edit-application-platform").value = results["platform"];
            document.getElementById("edit-submission-date").value = results["date"]
            document.getElementById("application-key").value = results["application key"];
        }
    }
    xhttp.open("GET", "./scripts/displayEditData.php?q="+key, true);
    xhttp.send();
}
function deleteApplication(){
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            // do nothing
        }
    }
    xhttp.open("GET", "./scripts/deleteApplication.php?q="+currentKey, true);
    xhttp.send();
    closeEditApplicationModal();
    location.reload();
    currentKey = -1;
}

// Search bar display
function showHideSearchBar(){
    var searchBar = document.getElementById("search-bar");
    var searchBarVisible = false;
    if(searchBar.style.visibility == "hidden" || searchBar.style.visibility == ""){
        // make search bar visible
        searchBar.style.visibility = "visible";
        searchBarVisible = true;
    }else{
        // make search bar hidden
        searchBar.style.visibility = "hidden";
        // clear search bar
        searchBar.value = "";
        search();
    }
}

// Filtering
function sortBy(filter){

    switch(filter){
        case 1:
            filter = "submitted";
            break;
        case 2:
            filter = "denied";
            break;
        case 3:
            filter = "viewed";
            break;
        case 4:
            filter = "accepted";
            break;
        case 5:
            filter = "all";
    }

    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("application-table").innerHTML = this.responseText;
        }
    }
    xhttp.open("GET", "./scripts/filter.php?q="+filter);
    xhttp.send();
    // location.reload();

}

// Searching
function search(){
    var searchText = document.getElementById("search-bar").value;
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                document.getElementById("application-table").innerHTML = this.responseText;
            }
        }
        xhttp.open("GET", "./scripts/search.php?q="+searchText, true);
        xhttp.send();
}