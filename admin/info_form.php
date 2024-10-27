<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <?php
        if ($_GET['info'] == "add") {
        ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Tambah Informasi</h5>
                        <div class="card-body">
                            <form action="?p=action&info=add" method="post">
                                <div>
                                    <label for="defaultFormControlInput" class="form-label">Informasi</label>
                                    <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Tech" aria-describedby="defaultFormControlHelp" name="text_content" />
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <button type="submit" class="btn btn-primary">Tambah Category</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            // Jika user mengedit kategori
        } elseif ($_GET['info'] == "edit") {
            $kategori  = $kon->query("SELECT * FROM text_snippets WHERE id ='$_GET[id]' ");
            $key = mysqli_fetch_array($kategori);
        ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Edit Informasi</h5>
                        <div class="card-body">
                            <form action="?p=action&info=edit" method="post">
                                <div><!-- Tambahkan input hidden untuk mengirimkan id kategori -->
                                    <input type="hidden" name="id" value="<?= $key['id'] ?>" />
                                </div>
                                <div>
                                    <label for="defaultFormControlInput" class="form-label">Informasi</label>
                                    <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Tech" aria-describedby="defaultFormControlHelp" name="text_content" value="<?= $key['text_content'] ?>" />
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>
    </div>
    <div class="content-backdrop fade"></div>
</div>