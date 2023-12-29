<footer class="footer footer-static footer-light navbar-border navbar-shadow">
    <div class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">2023 &copy; Copyright || DMS</span>

    </div>
</footer>

<!-- BEGIN VENDOR JS-->
<script src="<?php echo base_url(); ?>assets/theme-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="<?php echo base_url(); ?>assets/theme-assets/vendors/js/charts/chartist.min.js"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN CHAMELEON  JS-->
<script src="<?php echo base_url(); ?>assets/theme-assets/js/core/app-menu-lite.js"></script>
<script src="<?php echo base_url(); ?>assets/theme-assets/js/core/app-lite.js"></script>
<!-- END CHAMELEON  JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="<?php echo base_url(); ?>assets/theme-assets/js/scripts/pages/dashboard-lite.js"></script>
<!-- END PAGE LEVEL JS-->

<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>


<script>
    setUpDownloadPageAsImage();

    function setUpDownloadPageAsImage() {
        document.getElementById("download-topsales").addEventListener("click", function() {
            // Ganti document.body dengan selector elemen yang ingin Anda simpan
            html2canvas(document.querySelector('.topsales')).then(function(canvas) {
                console.log(canvas);
                simulateDownloadImageClick(canvas.toDataURL(), 'top-sales.png');
            });
        });
    }

    function simulateDownloadImageClick(uri, filename) {
        var link = document.createElement('a');
        if (typeof link.download !== 'string') {
            window.open(uri);
        } else {
            link.href = uri;
            link.download = filename;
            accountForFirefox(clickLink, link);
        }
    }

    function clickLink(link) {
        link.click();
    }

    function accountForFirefox(click) { // wrapper function
        let link = arguments[1];
        document.body.appendChild(link);
        click(link);
        document.body.removeChild(link);
    }
</script>

<script>
    setUpDownloadPageAsImage();

    function setUpDownloadPageAsImage() {
        document.getElementById("download-perbulan").addEventListener("click", function() {
            // Ganti document.body dengan selector elemen yang ingin Anda simpan
            html2canvas(document.querySelector('.perbulan')).then(function(canvas) {
                console.log(canvas);
                simulateDownloadImageClick(canvas.toDataURL(), 'terminasi-perbulan.png');
            });
        });
    }

    function simulateDownloadImageClick(uri, filename) {
        var link = document.createElement('a');
        if (typeof link.download !== 'string') {
            window.open(uri);
        } else {
            link.href = uri;
            link.download = filename;
            accountForFirefox(clickLink, link);
        }
    }

    function clickLink(link) {
        link.click();
    }

    function accountForFirefox(click) { // wrapper function
        let link = arguments[1];
        document.body.appendChild(link);
        click(link);
        document.body.removeChild(link);
    }
</script>

<script>
    setUpDownloadPageAsImage();

    function setUpDownloadPageAsImage() {
        document.getElementById("download-pertahun").addEventListener("click", function() {
            // Ganti document.body dengan selector elemen yang ingin Anda simpan
            html2canvas(document.querySelector('.pertahun')).then(function(canvas) {
                console.log(canvas);
                simulateDownloadImageClick(canvas.toDataURL(), 'terminasi-pertahun.png');
            });
        });
    }

    function simulateDownloadImageClick(uri, filename) {
        var link = document.createElement('a');
        if (typeof link.download !== 'string') {
            window.open(uri);
        } else {
            link.href = uri;
            link.download = filename;
            accountForFirefox(clickLink, link);
        }
    }

    function clickLink(link) {
        link.click();
    }

    function accountForFirefox(click) { // wrapper function
        let link = arguments[1];
        document.body.appendChild(link);
        click(link);
        document.body.removeChild(link);
    }
</script>
</body>

</html>