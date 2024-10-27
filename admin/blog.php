<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <!-- Filter Section -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <h5 class="card-header">Filter My Blog</h5>
      <div class="p-3">
        <form method="get" action="">
          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="filterTitle" class="form-label">Judul</label>
              <input type="text" id="filterTitle" name="filterTitle" class="form-control" placeholder="Cari berdasarkan judul">
            </div>
            <div class="col-md-4 mb-3">
              <label for="filterCategory" class="form-label">Kategori</label>
              <input type="text" id="filterCategory" name="filterCategory" class="form-control" placeholder="Cari berdasarkan kategori">
            </div>
            <div class="col-md-4 mb-3">
              <label for="filterTag" class="form-label">Tag</label>
              <input type="text" id="filterTag" name="filterTag" class="form-control" placeholder="Cari berdasarkan tag">
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Cari</button>
        </form>
      </div>
    </div>
    <hr class="my-5" />

    <!-- Button to Add New Post -->
    <div class="my-3 text-center">
      <a href="?p=blog_form&blog=add" class="btn btn-success btn-lg btn-block">+ Tambah Post Baru</a>
    </div>
    <!-- / Content -->

    <div class="row">
      <?php
      // Query to fetch filtered posts
      $query = $kon->query("SELECT * FROM posts ORDER BY id_post DESC");
      // Displaying posts
      foreach ($query as $key) {
      ?>
        <div class="col-sm-6 col-lg-4 mb-4">
          <div class="card">
            <img class="card-img-top" src="../assets/img/uploads/<?= $key['images'] ?>" alt="Card image cap" />
            <div class="card-body">
              <a href="?p=blog_preview&id=<?= $key['id_post'] ?>" class="card-title"><?= $key['tittle'] ?></a>
              <p class="card-text"><small class="text-muted">Created at <?= $key['created_at'] ?></small></p>
              <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
              <div class="d-flex justify-content-between">
                <a href="?p=blog_form&blog=edit&id=<?= $key['id_post'] ?>" class="btn btn-outline-warning btn-sm"><i class="bx bx-edit-alt"></i></a>
                <button data-bs-target="#deleteBlogModal<?= $key['id_post'] ?>" data-bs-toggle="modal" class="btn btn-danger" type="button"><i class="bx bx-trash-alt"></i></button>
              </div>
            </div>
          </div>
        </div>

        <!-- Delete Blog Modal -->
        <div class="modal fade" id="deleteBlogModal<?= $key['id_post'] ?>" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="deleteBlogModalLabel<?= $key['id_post'] ?>">Hapus Blog</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus blog "<strong><?= $key['tittle'] ?></strong>"?</p>
                <p class="text-muted">Tindakan ini tidak dapat dibatalkan.</p>
              </div>
              <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a href="action.php?blog=delete&id=<?= $key['id_post'] ?>" class="btn btn-danger">Hapus</a>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
  <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->