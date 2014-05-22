<link rel="stylesheet" href="<?php echo base_url(); ?>css/style_table_p.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-latest.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-for-table.js"></script>

<script type="text/javascript">
$(function() {
        $("#tablesorter-demo").tablesorter({sortList:[[0,0]], widgets: ['zebra']});
        $("#options").tablesorter({sortList: [[0,0]], headers: { 3:{sorter: false}, 4:{sorter: false}}});
});
</script>

<?php $this->load->view('includes/physician_menu'); ?>
<div class="search" style="background-color: #b8a186; padding-left: 120px;">

</div>
<div align="center" class="page_hedding"><?=$page_heading; ?></div>
<div align="center"><? if($this->session->flashdata('msg') != '') { ?><h4 class="alert_success"><?=$this->session->flashdata('msg')?></h4> <? } ?></div>
<div class="contant">
    <table id="tablesorter-demo" class="tablesorter" border="0" cellpadding="0" cellspacing="1">
        <thead>
            <tr>
                <th class="header">Document Name</th>
                <th class="header">Uploaded By</th>
                <th class="header">Uploaded Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($downloads as $download): ?>
                <tr>
                    <td><a href="<?php echo base_url(); ?>uploads/<?= $download->documentname; ?>" target="_blank"><?= $download->documentname; ?></a></td>
                    <td><?= $download->uploadedby; ?></td>
                    <td><?= $download->uploadeddate; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="footer">Indika & Thara</div>
