<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <div class="row">

        <?php

        $json_string = 'https://script.google.com/macros/s/AKfycbxBrpcaPl4KBOl1m2PZdtp6WCTGSm_L1p0Vk_ADcf9UFje69cj2qP3-AQ0_FWbXbX4HgA/exec';
        $jsondata = file_get_contents($json_string);
        $obj = json_decode($jsondata, TRUE);

        $arrayObj = count($obj);

        for ($i = 0; $i < $arrayObj; $i++) {
            $obj[$i]['no'];
            $obj[$i]['tanggal'];
            $obj[$i]['nama'];

            $dataPelanggan = array(
                'tanggal'           => $obj[$i]['tanggal'],
                'nama_customer'     =>  $obj[$i]['nama']
            );

            $this->M_CRUD->insertData($dataPelanggan, 'data_sheet');
        }

        ?>

    </div>


</body>


</html>