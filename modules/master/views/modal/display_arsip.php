<div class="table-responsive">
    <table class="table table-bordered">
        <tbody>
            <tr class="bg-light-info">
                <td colspan="2" class="text-center"><b>DATA ARSIP</b></td>
            </tr>
            <tr>
                <td style="width : 150px"><b>Kode</b></td>
                <td><span class="text-primary"><?= $result->code; ?></span></td>
            </tr>
            <tr>
                <td style="width : 150px"><b>Nama</b></td>
                <td><?= $result->name; ?></td>
            </tr>
            <tr>
                <td style="width : 150px"><b>Box Arsip</b></td>
                <td><?= $result->box_arsip; ?></td>
            </tr>
            <tr>
                <td style="width : 150px"><b>Lokasi</b></td>
                <td><span class="text-primary"><?= $result->location_code; ?></span> | <?= $result->location; ?></td>
            </tr>
            <tr>
                <td style="width : 150px"><b>Kategori</b></td>
                <td><span class="badge badge-info"><?= $result->category; ?></span></td>
            </tr>
            <tr>
                <td style="width : 150px"><b>Keterangan</b></td>
                <td><?= $result->description; ?></td>
            </tr>
        </tbody>
    </table>

    <iframe
        src="./vendor/pdfjs/web/viewer.html?file=../../../data/arsip/<?= $result->file ?>"
        width="100%" height="600px">
    </iframe>

    
</div>