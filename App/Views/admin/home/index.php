 <!-- Content Wrapper. Contains page content -->

 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0">Dashboard</h1>
             </div><!-- /.col -->
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="<?= DOCUMENT_ROOT ?>/admin/home">Home</a></li>
                     <li class="breadcrumb-item active">Dashboard</li>
                 </ol>
             </div><!-- /.col -->
         </div><!-- /.row -->
     </div><!-- /.container-fluid -->
 </div>
 <!-- /.content-header -->

 <!-- Main content -->
 <section class="content">
     <div class="container-fluid">
         <!-- Small boxes (Stat box) -->
         <div class="row">
             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-info">
                     <div class="inner">
                         <h3><?= count($data["cakes"]) ?></h3>
                         <p>New Cakes</p>
                     </div>
                     <div class="icon">
                         <i class="fas fa-pizza-slice"></i>
                     </div>
                     <a href="<?= DOCUMENT_ROOT ?>/admin/cakes" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>
             <!-- ./col -->
             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-success">
                     <div class="inner">
                         <h3><?= count($data["orders"]) ?></h3>
                         <p>Orders</p>
                     </div>
                     <div class="icon">
                         <i class="nav-icon fas fa-edit"></i>
                     </div>
                     <a href="<?= DOCUMENT_ROOT ?>/admin/orders" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>
             <!-- ./col -->
             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-warning">
                     <div class="inner">
                         <h3><?= count($data["users"]) ?></h3>

                         <p>User Registrations</p>
                     </div>
                     <div class="icon">
                         <i class="fas fa-user-plus"></i>
                     </div>
                     <a href="<?= DOCUMENT_ROOT ?>/admin/customers" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>
             <!-- ./col -->
             <div class="col-lg-3 col-6">
                 <!-- small box -->
                 <div class="small-box bg-danger">
                     <div class="inner">
                         <h3><?= count($data["category"]) ?></h3>

                         <p>Categories</p>
                     </div>
                     <div class="icon">
                         <i class="nav-icon fas fa-th"></i>
                     </div>
                     <a href="<?= DOCUMENT_ROOT ?>/admin/categories" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                 </div>
             </div>
             <!-- ./col -->
         </div>
         <!-- /.row -->
     </div><!-- /.container-fluid -->
 </section>
 <!-- /.content -->