<!-- Modal -->
<div class="modal fade" id="editGun" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Gun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id='newGunForm' name='newGunForm'>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="gunName" class="form-label">Gun Name:</label>
                                <input type="text" class="form-control" name="gunName" placeholder="Gun Name">
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="selectBasePistol" class="form-label">Base Pistol:</label>
                            <select class="form-select" name='selectBasePistol'>
                                <?php
                                while ($selectBasePistol = mysqli_fetch_assoc($resBasePistol)) {
                                ?>
                                    <option value=<?= $selectBasePistol['id'] ?>><?= $selectBasePistol['name'] ?></option>
                                <?php
                                }
                                ?>

                            </select>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="selectBarrel" class="form-label">Barrel:</label>
                                <select class="form-select" name='selectBarrel'>
                                    <?php
                                    while ($selectBarrel = mysqli_fetch_assoc($resBarrel)) {
                                    ?>
                                        <option value=<?= $selectBarrel['id'] ?>><?= $selectBarrel['name'] ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="selectMagazine" class="form-label">Magazine:</label>
                                <select class="form-select" name='selectMagazine'>
                                    <?php
                                    while ($selectMagazine = mysqli_fetch_assoc($resMagazine)) {
                                    ?>
                                        <option value=<?= $selectMagazine['id'] ?>><?= $selectMagazine['name'] ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="selectReceiver" class="form-label">Receiver:</label>
                                <select class="form-select" name='selectReceiver'>
                                    <?php
                                    while ($selectReceiver = mysqli_fetch_assoc($resReceiver)) {
                                    ?>
                                        <option value=<?= $selectReceiver['id'] ?>><?= $selectReceiver['name'] ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="selectSights" class="form-label">Sights:</label>
                                <select class="form-select" name='selectSights'>
                                    <?php
                                    while ($selectSights = mysqli_fetch_assoc($resSights)) {
                                    ?>
                                        <option value=<?= $selectSights['id'] ?>><?= $selectSights['name'] ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>

                    </div>

                </form>



                <div class="row">
                    <div class="col-12">
                        <h5>Gun Stats:</h5>
                    </div>
                </div>
                <div class="col-3">
                    <label id='accuracyLabel'>Accuracy: </label> <span id="accuracyTotal"></span>
                </div>
                <div class="col-3">
                    <label id="capacityLabel">Capacity: </label> <span id="capacityTotal"></span>
                </div>
                <div class="col-3">
                    <label id="damageLabel">Damage: </label> <span id="damageTotal"></span>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id='saveGun'>Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('.form-select').change(function() {
            $.ajax({
                type: "POST",
                url: "processes/class.php",
                data: $('#newGunForm').serialize() + '&action=updateBase',
                dataType: 'json',
                success: function(data) {
                    $("#accuracyTotal").html(data.totalAccuracy);
                    $("#damageTotal").html(data.totalDamage);
                    $("#capacityTotal").html(data.totalCapacity);
                }
            });
        });

        $('#saveGun').click(function() {
            $.ajax({
                type: "POST",
                url: "processes/class.php",
                data: $('#newGunForm').serialize() + '&action=saveGun',
                dataType: 'json',
                success: function(data) {
                    $('#gunsTable').html();
                    $('#addGunModal').modal('hide');
                },
            });
        });

        $('.modal').on('hidden.bs.modal', function(e) {
            $(this).find('form').trigger('reset');
        });
    });
</script>