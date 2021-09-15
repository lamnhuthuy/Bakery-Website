 <aside class="position-fixed main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="<?= DOCUMENT_ROOT ?>/admin/home" class="brand-link">
         <img src="<?= PUB ?>/img/logo.png" alt="Greek's Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">Greek's Bakery</span>
     </a>
     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="<?= PUB ?>/upload/userAvatar/<?= $_SESSION["admin"]["avatar"] ?>" class="img-circle elevation-2" alt="User Image">
             </div>
             <div class="info">
                 <a href="#" class="d-block"><?= $_SESSION["admin"]["name"] ?></a>
             </div>
         </div>
         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                 <?php foreach (ADMIN_SIDEBAR as $index => $value) : ?>
                     <li class="nav-item">
                         <a href="<?= $value["link"] ?>" class="nav-link <?= strtolower($GLOBALS["currentRoute"]) === $value["name"] ? "active" : "" ?>">
                             <i class="<?= $value["icon"] ?>"></i>
                             <p class="ml-3">
                                 <?= $value["title"] ?>
                             </p>
                         </a>
                     </li>
                 <?php endforeach ?>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>