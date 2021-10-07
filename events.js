//Hides and reveals columns, so that users can hide events they are not interested in.
function hideCategory(category){

    hideMe = document.getElementById(category);
	//If event column is already hidden, display the elcolumn using revealCategory.
    if (window.getComputedStyle(hideMe).display === "none"){
        revealCategory(category)
    }
    else{
        hideMe.style.display = "none";
    }
    
}

function revealCategory(category){
    
    hider = document.getElementById(category);
    hider.style.display = "block";
}

//Used to reveal all category columns
function revealAll(){
    hider1 = document.getElementById("sport_section");
    hider2 = document.getElementById("culture_section");
    hider3 = document.getElementById("other_section");

    hider1.style.display = "block";
    hider2.style.display = "block";
    hider3.style.display = "block";
}

//Experimental function. Requires refresh after being used due to buttons not working.
function reorder(order){ 
    
    //Sport Events
    xhttpReq = new XMLHttpRequest(); //An object used to request the data from php that runs on the server-side
    xhttpReq.onreadystatechange = function() {//ready state
        if (this.readyState == 4 && this.status == 200) {//readyState 4 = Request finished, reponse ready, status 200 = ok
            document.getElementById("sport_section").innerHTML = this.responseText;//Gets the HTML as a string.

        }
    };
    xhttpReq.open("POST", "ajaxOrderEvents.php", true);//Pass on data using POST.
	xhttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhttpReq.send("category=" + 'sport' +"&order=" + order);

    //Culture Events
	xhttpReq = new XMLHttpRequest();
    xhttpReq.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("culture_section").innerHTML = this.responseText;

        }
    };
    xhttpReq.open("POST", "ajaxOrderEvents.php", true);
	xhttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhttpReq.send("category=" + 'culture' +"&order=" + order);

    //Other Events
	xhttpReq = new XMLHttpRequest();
    xhttpReq.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("other_section").innerHTML = this.responseText;

        }
    };
    xhttpReq.open("POST", "ajaxOrderEvents.php", true);
	xhttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhttpReq.send("category=" + 'other' +"&order=" + order);
}