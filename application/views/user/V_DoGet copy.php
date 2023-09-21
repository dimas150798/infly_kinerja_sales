<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <div id="myData"></div>
    <script>
        fetch('https://script.google.com/macros/s/AKfycbxBrpcaPl4KBOl1m2PZdtp6WCTGSm_L1p0Vk_ADcf9UFje69cj2qP3-AQ0_FWbXbX4HgA/exec')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                appendData(data);
            })
            .catch(function(err) {
                console.log('error: ' + err);
            });

        function appendData(data) {
            var mainContainer = document.getElementById("myData");
            for (var i = 0; i < data.length; i++) {
                var div = document.createElement("div");
                div.innerHTML = 'Nama: ' + data[i].nama;
                mainContainer.appendChild(div);
            }
        }
    </script>

    <script>
        fetch('https://script.google.com/macros/s/AKfycbxBrpcaPl4KBOl1m2PZdtp6WCTGSm_L1p0Vk_ADcf9UFje69cj2qP3-AQ0_FWbXbX4HgA/exec')
            .then(res => res.json())
            .then(data => console.log(data));
    </script>
</body>


</html>