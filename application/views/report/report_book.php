<!-- .page-title-bar -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
<header class="page-title-bar">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?=base_url()?>"><span class="fa fa-home"></span> Admin Panel</a>
      </li>
      <li class="breadcrumb-item">
        <a href="<?=base_url('reporting')?>">Laporan</a>
      </li>
      <li class="breadcrumb-item active">
        <a class="text-muted">Laporan Buku</a>
      </li>
    </ol>
  </nav>
  <h1 class="page-title"> Laporan </h1>
</header>
<!-- Reporting buku -->
<ul nav class="nav nav-tabs">
  <li class="nav-item"><a class="nav-link" href="<?= base_url('reporting/index') ?>">Summary</a></li>
  <li class="nav-item"><a class="nav-link" href="<?= base_url('reporting/index_baru') ?>">Naskah Baru</a></li>
  <li class="nav-item"><a class="nav-link" href="<?= base_url('reporting/index_ulang') ?>">Cetak Ulang</a></li>
  <li class="nav-item"><a class="nav-link" href="<?= base_url('reporting/index_draft') ?>">Laporan Draft</a></li>
  <li class="nav-item"><a class="nav-link active" href="<?= base_url('reporting/index_books') ?>">Laporan Buku</a></li>
  <li class="nav-item"><a class="nav-link" href="<?= base_url('reporting/index_author') ?>">Laporan Penulis</a></li>
  <li class="nav-item"><a class="nav-link" href="<?= base_url('reporting/index_hibah') ?>">Laporan Hibah</a></li>
</ul>
<!-- Reporting buku -->
<!-- /.page-title-bar -->
<br />

<div class="form-group row">
  <div class="col-8 col-md-10 mb-1">
    <div align="right">
      <label for="" class="col-sm-4 col-form-label"><h6><i class="fa fa-filter"></i>  Filter :</h6></label>
    </div>
  </div>
  <div class="col-4 col-md-2  mb-4">
    <?= form_open('', ['method' => 'GET']) ?>
    <?= form_dropdown('droptahunbuku', getYearsBook(), $this->input->get('droptahunbuku'), 'onchange="this.form.submit()" id="droptahunbuku" class="form-control custom-select d-block" title="Filter tahun"') ?>
    <?= form_close() ?>
  </div>
</div>

<div class="form-group row">
  <div class="col-8 col-md-12 mb-2">
    <div align="right">
      <div class="col-4 col-md-2 mb-4">
        <a href="<?=base_url('book/') ?>" class="btn btn-primary" target="_blank" >View  <i class="fa fa-eye"></i>
        </a>
      </div>
    </div>
  </div>
</div>

<div align="center">
  <h4>UGM Press</h4>
  <h5>Laporan Grafik Jumlah Buku Perbulan</h5>
</div>

<!-- graph for book -->

<canvas id="myChart" width="500" height="170"></canvas>
<script>
var tahun = $('#droptahunbuku').val();
$.post("<?php echo base_url();?>Reporting/getBook?droptahunbuku="+tahun,
function(data){
  var obj = JSON.parse(data);
  console.log(obj);
  var tampil = [];
  for(var i=1;i<=12;i++){
    obj.count[i];
    tampil.push(obj.count[i]);
  };

  var ctx = $("#myChart");
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul",
      "Aug", "Sep", "Oct", "Nov", "Des"],
      datasets: [{
        label: 'Laporan Buku',
        data: tampil,
        backgroundColor: [
          'rgba(54, 162, 235, 1)',
          'rgba(198, 198, 198, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(208, 222, 98, 1)',
          'rgba(98, 222, 206, 1)',
          'rgba(171, 98, 222, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)'
        ],
        borderColor: [
          'rgba(54, 162, 235, 1)',
          'rgba(198, 198, 198, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(208, 222, 98, 1)',
          'rgba(98, 222, 206, 1)',
          'rgba(171, 98, 222, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      legend: {
        display : false,
      },
      title:{
        display: true,
        text : 'Jumlah Data',
        fontSize : 15,
        fontFamily :'Helvetica Neue',
        fontColor : 'black',
        fontStyle : 'bold',
        position : 'left',
        padding : 15,
      },
      scales: {
        yAxes: [{
          gridLines :{
            display : true
          },
          ticks: {
            fontFamily :'Helvetica Neue',
            fontSize : 14,
            fontStyle :'',
            fontColor : 'black',
            beginAtZero:true
          }
        }],
        xAxes : [{
          gridLines : {
            display : false
          },
          ticks: {
            fontFamily :'Helvetica Neue',
            fontSize : 13,
            fontColor : 'black',
            beginAtZero:true
          }
        }],

      },

      layout:{
        padding: {
          left:50,
          right:85,
          top:10,
          bottom:50,
        }
      }
    }
  });
});
</script>
