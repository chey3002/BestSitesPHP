<div class="row">
    <div class="col-md-10">
        <div class="row mt-3">
            <?php
            if (count($dataToView["data"]["data"]) > 0) {
                foreach ($dataToView["data"]["data"] as $site) {
                    ?>
                    <div class="col-md-6 mb-3">
                        <div class="card border border-secondary h-100">
                            <div class="card rounded p-3">
                                <!-- Rellenar los datos del sitio -->
                                <div class="row">
                                    <div class="col-md-4 d-flex justify-content-center align-middle">
                                        <img class="object-fit-cover border rounded img-thumbnail img-fluid" style="width:100px; height:100px" src="<?php echo $site['image_url']; ?>" alt="<?php echo $site['title']; ?>">
                                    </div>
                                    <div class="col-md-8">
                                        <h4><?php echo $site['title']; ?></h4>
                                        <p><?php echo $site['description']; ?></p>
                                        <p><?php echo $site['average_rating']; ?></p>
                                        <p><?php echo $site['category']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="alert alert-info">
                    Actualmente no existen notas.
                </div>
                <?php
            }
            ?>
        </div>
    </div>

    <div class="d-none d-md-block col-md-2">
        <div class="row mt-3">
            <h1>TOP 5</h1>
            <?php
            if (count($dataToView["data"]["topFive"]) > 0) {
                foreach ($dataToView["data"]["topFive"] as $site) {
                    ?>
                    <div class="col-md-12 mb-3">
                        <div class="card border border-secondary">
                            <div class="card rounded p-3">
                                <!-- Rellenar los datos del sitio -->
                                <div class="row">
                                    <img class="object-fit-cover border rounded img-thumbnail img-fluid" style="width:100%; height:100px" src="<?php echo $site['image_url']; ?>" alt="<?php echo $site['title']; ?>">
                                    <h5><?php echo $site['title']; ?></h5>
                                    <p><?php echo $site['average_rating']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>
