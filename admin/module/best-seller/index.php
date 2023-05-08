<div class="col-lg-12 main-chart">

						<ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Prosuk Paling Laku Terjual</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- <i class="fas fa-table mr-1"></i> -->
                               Top Products <i class="glyphicon glyphicon-fire" ></i>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Penjualan</th>
                                               
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                            <?php 
                                                $db = new database();
                                                $query = $db->tampil_data("SELECT * FROM data_barang INNER JOIN best_seller ON data_barang.kode_barang=best_seller.kode_barang
                                                                        ORDER BY jumlah DESC");
                                                $nomor = 1;
                                                if($query) {
                                                   foreach($query as $data_barang) {	
                                                    
                                            ?>
                                                
                                                <tr>
                                                    <td><?= $nomor; ?></td>
                                                    <td><?= $data_barang['kode_barang']; ?></td>                                                
                                                    <td><?= $data_barang['nama_barang']; ?></td>
                                                    <td><?= $data_barang['jumlah']; ?></td>
                                                </tr>

                                            <?php 
                                                        $nomor++;
                                                    }
                                                }	
                                            ?>
                                                                    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
						