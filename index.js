window.onload=function(){
    document.getElementById("registerButton").addEventListener("click", function() {
         document.getElementById("form-container").classList.add("is-active");
    });
    
      document.getElementById("loginButton").addEventListener("click", function() {
         document.getElementById("form-container").classList.remove("is-active");
    });
}